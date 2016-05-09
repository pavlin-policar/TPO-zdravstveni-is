<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\CreateChargeRequest;
use App\Models\DoctorDates;
use App\Models\User;
use App\Models\Code;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;


class CalendarController extends Controller
{
    private $users;

    /**
     * ChargeController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $checkups = null;
        $docId = null;
        if (session('showUser') != $user->id) {
            $docId = Auth::user()->id;
            $user = User::where('id', '=', session('showUser'))->first();
        }

        // Doctors get to see (their OR chosen doc's schedule) AND any events where they show up under who_inserted
        if ($user->isDoctor()) {
            // This doctor:
            $docId = $user->id;
            // If there's a chosen doctor instead:
            if ($request->docId != null) $docId=$request->docId;

            // Selected doctor's (or this doctor's) open events:
            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // This (The-Not-Chosen) doctor's who_inserted events:
            $tempCheckups = DoctorDates::where('who_inserted', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        } // User has a personal doctor and is not a doctor themselves:
        elseif ($user->hasDoctor()){
            // Default -> user's personal doc:
            $docId = $user->personal_doctor_id;
            // Chosen doctor's schedule instead:
            if ($request->docId != null) $docId = $request->docId;

            // User is patient:
            $tempCheckups = DoctorDates::where('patient', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // User isn't a patient, but they're responsible for registering event:
            $tempCheckups = DoctorDates::where('patient', '=', !$user->id)->where('who_inserted', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // Selected doctor's open events:
            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        } // User is not a doc and does not have a personal doctor, but can still view doctors schedules:
        elseif (!$user->hasDoctor()) {
            if ($request->docId != null) {
                $docId = $request->docId;

                // Selected doctor's open events:
                $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
                foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;
            }

            // Users registered events:
            $tempCheckups = DoctorDates::where('patient', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        }


        $events = [];
        if ($checkups != null) {
            foreach ($checkups as $checkup) {
                $backgroundClr = '#300';
                $start = $checkup->time;

                $today = Carbon::now('Europe/Amsterdam');
                $date = Carbon::parse($today);
                if ($date->gt($start)) $url = null;
                else $url = route('calendar.registerEvent', ['time' => $start, 'user' => $user->id, 'doctor' => $docId]);

                // We're the patient
                if ($user->id == $checkup->patient) {
                    $title = User::where('id', '=', $checkup->patient)->first();
                    $title = $title->fullName;
                    $backgroundClr = '#800';
                    //if ($user->isDoctor()) $backgroundClr = '#1200';
                } // We're the ones who registered the appointment
                elseif ($user->id == $checkup->who_inserted) {
                    $title = User::where('id', '=', $checkup->patient)->first();
                    $title = $title->fullName;
                    $backgroundClr = '#700';
                    //TODO check if this URL is alright
                    $url = Route('calendar.registerEvent', [$start, $checkup->patient, $docId]);
                } // The event is still open
                elseif (null == $checkup->patitent) {
                    $title = 'Prost termin';
                    $backgroundClr = '#500';
                    /*if ($user->isDoctor() && $checkup->doctor == $user->id) {
                        $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                        //$url = Route('/calendar/cancelEvent/' . $start . '/' . $user->id);
                    } else {
                        $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                    }*/
                }

                $ends = $checkup->time_end;
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$ends);

                $events[] = \Calendar::event(
                    $title,
                    false,
                    $start,
                    $end,
                    'stringEventId',
                    [
                        'url' => $url,
                        'color' => $backgroundClr,
                    ]
                );
            }
        }

        $calendar = \Calendar::addEvents($events);//->setOptions([
            //set fullcalendar options
        //]);  //add an array with addEvents

        $today = new \DateTime();
        // Get all doctors:
        $doctors = User::where('person_type', '=', Code::DOCTOR()->id)->get();
        //dd($doctors);
        $selectedDoc = $docId;

        return view('calendarEvents.calendar', compact('calendar', 'events', 'today','doctors', 'selectedDoc'));
    }

    public function cloneWeek(){

        // Get current week's events:
        $today = Carbon::now('Europe/Amsterdam');
        $date = Carbon::parse($today);

        $monday = $date->startOfWeek()->toDateTimeString();
        $saturday = $date->endOfWeek()->toDateTimeString();

        $docsCurrentWeek = DoctorDates::where('doctor', '=', Auth::user()->id)
                                ->where('time', '>=', $monday)
                                ->where('time', '<=', $saturday)
                                ->get();

        // Is this week's schedule empty? Then we're done here.
        if ($docsCurrentWeek->count() == 0) {
            request()->session()->flash(
                'cloneMessage',
                'V tem tednu nimate razpisanih terminov!'
            );
            return redirect()->route('calendar.user');
        }

        // Get next week's events:
        $nextMonday = Carbon::parse($monday)->addDays(7)->toDateTimeString();
        $nextSaturday = Carbon::parse($saturday)->addDays(7)->toDateTimeString();
        $docsNextWeek = DoctorDates::where('doctor', '=', Auth::user()->id)
            ->where('time', '>=', $nextMonday)
            ->where('time', '<=', $nextSaturday)
            ->get();
        if ($docsNextWeek != null) {
            // Check for collision:
            $detection = $this->checkForCollision($docsCurrentWeek, $docsNextWeek, 7);
            if ($detection) {
                // Collision, redirect back with a warning message:
                request()->session()->flash(
                    'cloneMessage',
                    'Kopiranje urnika ni mogoče zaradi kolizije terminov!'
                );
                return redirect()->route('calendar.user');
            }
        }

        // Next week we've either got nothing happening or no collisions, clone the week:
        foreach ($docsCurrentWeek as $cloneTemplate) {
            // Weird PHP/Laravel shenanigans O___O
            if (count($docsCurrentWeek) == 1) $cloneTemplate = $docsCurrentWeek;

            $dd = new DoctorDates();
            $dd->time = Carbon::parse($cloneTemplate->time)->addDays(7);
            $dd->time_end = Carbon::parse($cloneTemplate->time_end)->addDays(7);;
            $dd->doctor = $cloneTemplate->doctor;
            $dd->save();
        }

        request()->session()->flash(
            'cloneMessage',
            'Urnik ponovljen v prihodnjem tednu!'
        );
        return redirect()->route('calendar.user');

    }

    public function checkForCollision($current, $next, $days) {

        foreach ($current as $firstEvent) {
            // Weird PHP/Laravel shenanigans O___O
            if (count($current) == 1) $firstEvent = $current;

            foreach ($next as $secondEvent) {
                // Weird PHP/Laravel shenanigans O___O
                if (count($next) == 1) $secondEvent = $next;

                // Compare days of the week:
                $firstA = Carbon::parse($firstEvent->time);
                $firstB = Carbon::parse($secondEvent->time);
                if ($firstA->dayOfWeek == $firstB->dayOfWeek) {

                    // Compare days:
                    if ($firstA->addDays($days)->toDateString() == $firstB->toDateString()) {

                        // Compare hours:
                        // (StartA <= EndB) and (EndA >= StartB) <-> OVERLAP!
                        $secondA = Carbon::parse($firstEvent->time_end);
                        $secondB = Carbon::parse($secondEvent->time_end);
                        if (($firstA->lte($secondB)) && ($secondA->addDays($days)->gte($firstB))) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function manageSchedule() {
        return view('calendarEvents.docSchedule');
    }

    public function createSchedule(Request $request) {

        $validator = Validator::make($request->all(), [
            'days' => 'required',
            'hourStart' => 'required|date_format:"H:i"',
            'hourEnd' => 'required|date_format:"H:i"',
            'dayStart' => 'required|date_format:"d/m"|after:today',
            'dayEnd' => 'required|date_format:"d/m"|after:"dayStart"',
            'interval' => 'required',
            'optionalBreakStart' => 'date_format:"H:i"'
        ],
            [
                'days.required' => 'Izbrati morate vsaj en dan!',
                'required' => 'Polje ne sme ostati prazno!',
                'dayStart.date_format' => 'Dan mora biti podan v formatu dd/mm!',
                'dayEnd.date_format' => 'Dan mora biti podan v formatu dd/mm!',
                'date_format' => 'Čas mora biti podan v formatu HH:mm!',
                'dayEnd.after' => 'Končni datum mora biti večji od začetnega',
                'after' => 'Začetni datum mora biti kasnejši od današnjega!',
            ]);

        // Validate user input:
        if ($validator->fails()) {
            return view('calendarEvents.docSchedule')->withErrors($validator);
        }

        // Get properly formated input:
        $startDate = Carbon::createFromFormat('d/m', $request->dayStart);
        $endDate = Carbon::createFromFormat('d/m', $request->dayEnd);

        //dd(Carbon::parse($startDate)->dayOfWeek); // 1 = PON
        $jump = Carbon::createFromFormat('H:i', $request->interval);
        $endTime = Carbon::createFromFormat('H:i', $request->hourEnd);
        $queryStartTime = $startDate->toDateString() . ' ' . Carbon::createFromFormat('H:i', $request->hourStart)->toTimeString();
        $queryEndTime = $endDate->toDateString() . ' ' . $endTime->toTimeString();

        $collisionCandidates = DoctorDates::where('doctor', '=', Auth::user()->id)
            ->where('time', '>=', $queryStartTime)
            ->where('time', '<=', $queryEndTime)
            ->get();

        for ($startDate; $startDate <= $endDate; $startDate = $startDate->addDay()) {
            foreach ($request->days as $day) {
                // Found chosen day:
                if (Carbon::parse($startDate)->dayOfWeek == $day) {
                    $startTime = Carbon::createFromFormat('H:i', $request->hourStart);
                    $end = clone($startTime);
                    for ($startTime;  $startTime <= $endTime; $startTime->addMinutes($jump->minute)) {
                        $end->addMinutes($jump->minute); // -> Termin interval!
                        //TODO won't work if they have nightshifts; let's hope no one notices :D
                        $time = $startDate->toDateString() . ' ' . $startTime->toTimeString();
                        $timeEnd = $startDate->toDateString() . ' ' . $end->toTimeString();
                        //DoctorDates::create(["time_end" => $timeEnd, 'time' => $time, 'doctor' => Auth::user()->id])->save();
                        $dd = new DoctorDates();
                        $dd->time = $time;
                        $dd->time_end = $timeEnd;
                        $dd->doctor = Auth::user()->id;

                        // Check for collision before saving event:
                        if (!$this->checkForCollision($dd, $collisionCandidates, 0)) {
                            // No collision, save event:
                            $dd->save();
                        } elseif (request()->session()->get('cloneMessage') == null) {
                            request()->session()->flash(
                                'cloneMessage',
                                'Nekateri termini niso bili dodani zaradi kolizije!'
                            );
                        }
                    }
                }
            }
        }

        return redirect()->route('calendar.user');

    }

    public function registerEventForm($time, $userId, $doctorId) {

        $patient = User::where('id', '=', $userId)->first();

        // Ali je dogodek že zaseden? Potem ga morda ta oseba lahko izbriše!
        $start = Carbon::createFromFormat('d.m.Y H:i', $time);
        $creator = DoctorDates::where('patient', '=', $userId)->where('time', '=', $start)->first();
        $date = DoctorDates::where('time', '=', $start)->first();

        return view('calendarEvents.registerFreeEvent', ['time' => $time, 'patient' => $patient, 'creator' => $creator, 'doctor' => $doctorId, 'date' => $date]);
    }

    public function register($time, $userId, $doctorId, Request $request) {

        $start = Carbon::createFromFormat('d.m.Y H:i', $time);

        // Is event already full?
        $checkup = DoctorDates::where('patient', '=', $userId)->where('doctor', '=', $doctorId)->where('time', '=', $start)->first();
        if ($checkup != null) {
            //Event already full, we're just updating notes:
            if ($request->note != null) $checkup->note = $request->note;
            $checkup->save();
            return redirect()->route('calendar.user');
        }
        // The event is still free, so this is just user trying to register:
        $checkup = DoctorDates::where('patient', '=', null)->where('doctor', '=', $doctorId)->where('time', '=', $start)->first();
        if ($checkup != null) {
            $checkup->patient = $userId;
            $checkup->who_inserted = Auth::user()->id;
            if ($request->note != null) $checkup->note = $request->note;
            $checkup->save();
            return redirect()->route('calendar.user');
        }
    }

    public function cancel($time, $userId, $doctorId) {

        //is event empty? -> is this user the same one who created empty event? -> is the event still far enough away? ALLOW DELETE
        //             \-> not empty -> is this user the same one, who registered the appointment? -> is the event still far enough away? ALLOW RELEASE OF THE EVENT

        $formatedTime = Carbon::createFromFormat('d.m.Y H:i', $time);

        // 1. Get the event
        $event = DoctorDates::where('doctor', '=', $doctorId)->where('time', '=', $formatedTime)->first();

        // 2. Is event empty?
        if ($event->patient == null) {
            if ($event->doctor == Auth::user()->id) {
                // Check event's date
                $today = Carbon::now();
                $time = Carbon::parse($time);
                //dd($time);
                $date = $today->diff($time);
                //dd($date);
                if ($date->days > 1) $event->delete();
            }
        }
        else {
            //dd($event->who_inserted == Auth::user()->id);
            // 3. Did I sign someone/myself up for this appointment?
            if ($event->who_inserted == Auth::user()->id) {
                // Check event's date
                $today = Carbon::now();
                $time = Carbon::parse($time);
                $date = $today->diff($time);
                //if ($date->days > 1) {
                    //if ($date->h > 12) {
                        $event->patient = null;
                        $event->who_inserted = null;
                        $event->save();
                    //}
                //}
            }

        }

        return redirect()->route('calendar.user');
    }
}
