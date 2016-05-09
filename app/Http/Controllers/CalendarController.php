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
        $actualUser = Auth::user();
        $checkups = null;
        $docId = null;
        if ($request->docId != null) $docId = $request->docId;
        $selectedDoc = $docId;

        // Session user is not the same as logged user:
        if (session('showUser') != $actualUser->id) {
            //$docId = Auth::user()->id;
            $actualUser = User::where('id', '=', session('showUser'))->first();
        }

        // Doctors get to see [their OR chosen doc's schedule] AND any events where they show up under who_inserted
        if ($actualUser->isDoctor()) {
            // This doctor, if no other has been chosen:
            if ($request->docId == null) {
                $docId = $actualUser->id;

                // This (The-Not-Chosen) doctor's who_inserted events show up only on his schedule:
                $tempCheckups = DoctorDates::where('who_inserted', '=', $actualUser->id)->get();
                foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

                // I'm the doc, and someone else registered event:
                $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('who_inserted', '!=', $docId)->whereNotNull('who_inserted')->get();
                foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;
            }

            // Selected doctor's (or this doctor's) open events:
            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        } // User has a personal doctor and is not a doctor themselves:
        elseif ($actualUser->hasDoctor()){
            // Actual user's personal doc, if no other has been chosen:
            if ($request->docId == null) $docId = $actualUser->personal_doctor_id;

            // User is patient:
            $tempCheckups = DoctorDates::where('patient', '=', $actualUser->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // User isn't a patient, but they're responsible for registering event:
            $tempCheckups = DoctorDates::where('who_inserted', '=', $actualUser->id)->where('patient', '!=', $actualUser->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // Selected or personal doctor's open events:
            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        } // User is not a doc and does not have a personal doctor, but can still view doctors schedules:
        else {
            // Selected doctor's open events:
            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // User's registered events:
            $tempCheckups = DoctorDates::where('patient', '=', $actualUser->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            // User's who_inserted events, where they're not the patient:
            $tempCheckups = DoctorDates::where('who_inserted', '=', $actualUser->id)->where('patient', '!=', $actualUser->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;
        }

        //dd($checkups);

        $events = [];
        if ($checkups != null) {
            foreach ($checkups as $checkup) {
                $backgroundClr = '#50000';
                $start = $checkup->time;

                if (!$actualUser->hasDoctor() && !$actualUser->isDoctor()) {
                    $docId = $checkup->doctor;
                }

                // We only allow accessing the event, if the day of event hasn't passed yet:
                $today = Carbon::now('Europe/Amsterdam');
                $date = Carbon::parse($today);
                if ($date->gt($start)) $url = null;
                else $url = route('calendar.registerEvent', ['time' => $start, 'user' => $actualUser->id, 'doctor' => $docId]);

                // Our break! \o/
                if ($checkup->note == 'odmor') {
                        $title = 'Odmor';
                        $backgroundClr = '#364';
                        if ($actualUser->id == $checkup->who_inserted) {
                            $url = route('calendar.registerEvent', ['time' => $start, 'user' => $actualUser->id, 'doctor' => $docId]);
                        } else {
                            $url = null;
                        }
                } // We're the patient
                elseif ($actualUser->id == $checkup->patient) {
                    $title = User::where('id', '=', $checkup->patient)->first();
                    $title = $title->fullName;
                    $backgroundClr = '#904';
                } // We're the ones who registered the appointment
                elseif ($actualUser->id == $checkup->who_inserted && $checkup->patient != 0) {
                    $title = User::where('id', '=', $checkup->patient)->first();
                    $title = $title->fullName;
                    $backgroundClr = '#099';
                    $url = route('calendar.registerEvent', ['time' => $start, 'user' => $checkup->patient, 'doctor' => $docId]);
                } // We're the ones who created open appointment:
                elseif ($actualUser->id == $checkup->doctor && $actualUser->id != $checkup->who_inserted && $checkup->who_inserted != null) {
                    $title = User::where('id', '=', $checkup->patient)->first();
                    //dd($title);
                    $title = $title->fullName;
                    $backgroundClr = '#099';
                    $url = route('calendar.registerEvent', ['time' => $start, 'user' => $checkup->who_inserted, 'doctor' => $docId]);
                } // The event is still open
                elseif (null == $checkup->patitent) {
                    $title = 'Prost termin';
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

        $calendar = \Calendar::addEvents($events)->setOptions([
            //set fullcalendar options
            'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'left' => 'month,agendaWeek,agendaDay',
            ],
            'minTime' => '06:00',
            'eventLimit' => true,
            'defaultView' => 'agendaWeek',
            'allDaySlot' => false,
            'eventTextColor' => 'white',
        ]);  //add an array with addEvents

        $today = new \DateTime();
        // Get all doctors:
        $doctors = User::where('person_type', '=', Code::DOCTOR()->id)->get(); //->prepend('flavourText', '');

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
            'dayStart' => 'required|date_format:"d/m/Y"|after:today',
            'dayEnd' => 'required|date_format:"d/m/Y"|after:"dayStart"',
            'interval' => 'required',
        ],
            [
                'days.required' => 'Izbrati morate vsaj en dan!',
                'required' => 'Polje ne sme ostati prazno!',
                'dayStart.date_format' => 'Datum podan v napačnem formatu!',
                'dayEnd.date_format' => 'Datum podan v napačnem formatu!',
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

        // Does this patient already have a checkup scheduled?
        //TODO

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

        $formattedTime = Carbon::createFromFormat('d.m.Y H:i', $time);
        $today = Carbon::now('Europe/Amsterdam');
        $date = Carbon::parse($today);

        // 1. Get the event
        $event = DoctorDates::where('doctor', '=', $doctorId)->where('time', '=', $formattedTime)->first();

        // 2. Is event empty?
        if (($event->patient == null) && ($event->doctor == Auth::user()->id)) {
                $event->delete();
        }
        elseif (($event->patient != null) && ($event->who_inserted == Auth::user()->id)) {
            // 3. Did I sign someone/myself up for this appointment?

            // Check event's date
            $date = $today->diff($formattedTime);
            //dd($date);
            if ($date->days > 0 || ($date->hours >= 12 && $date->days = 0)) {
                //dd($date);
                $event->patient = null;
                $event->who_inserted = null;
                $event->note = null;
                $event->save();
            }
        } else {
            request()->session()->flash(
                'cloneMessage',
                'Dogodka ne morete sprositi/izbrisati!'
            );
        }
        return redirect()->route('calendar.user');
    }

    public function introduceBreak($time, $userId, $doctorId) {
        // Get event, set patient to -1.
        $formattedTime = Carbon::createFromFormat('d.m.Y H:i', $time);
        $breakTime = DoctorDates::where('doctor', '=', $doctorId)->where('time', '=', $formattedTime)->first();

        $breakTime->note = 'odmor';
        $breakTime->patient = $userId;
        $breakTime->who_inserted = $userId;
        //dd($breakTime);
        $breakTime->save();

        return  redirect()->route('calendar.user');
    }
}
