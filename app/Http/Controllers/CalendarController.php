<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarScheduleRequest;
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
        // Types of users:
        $nurse = null;
        $doc = null;
        $patient = null;

        // Elevated user type?
        if (Auth::user()->isDoctor() || Auth::user()->isNurse()) {
            $doc = Auth::user();
            if (session('showUser') != $doc->id) {
                $patient = User::where('id', '=', session('showUser'))->first();
            }
        }
        else {
            $patient = Auth::user();
            if ($patient->hasDoctor()) $doc = $patient->personal_doctor_id;
        }

        //dd($nurse);
        //dd($doc);
        //dd($patient);

        // QUERY BUILDING
        $appointments = null;

        // 1. Cases for doctor or nurse
        // 1.1 is $patient null? -> Y: doctor is a normal patient; $patient = $doc; schedule options logic in blade via isNurse and showDoc!!
        //						 -> N: doctor working on a patient; build query here?
        if ($doc != null) {
            if ($request->docId != null) $docId = $request->docId;
            else {
                $docId = $doc->id;
                // Query doc's who_inserted appointments (MINUS below query), where doc isn't patient
                // UNLESS docId has been chosen in dropdown list
                if ($patient == null) {
                    $results = DoctorDates::where('who_inserted', '=', $docId)->orWhere('doctor', '=', $docId)->whereNotNull('patient')->whereNotIn('patient', [$docId])->get();
                    foreach ($results as $result) $appointments[] = $result;
                } else {
                    // Query doc's scheduled breaks:
                    $results = DoctorDates::where('doctor', '=', $docId)->where('note', '=', 'odmor')->get();
                    foreach ($results as $result) $appointments[] = $result;
                }

            }
            // Query doc's scheduled appointments (ONLY open ones) UNLESS docId has been chosen in dropdown list:
            $results = DoctorDates::where('doctor', '=', $docId)->whereNull('patient')->get();
            foreach ($results as $result) $appointments[] = $result;

            if ($patient == null) $patient = $doc;
        }

        // 2. Cases for patient
        // No need for conditional, $patient won't ever be null by this point
        // Query patient's appointments:
        $results = DoctorDates::where('patient', '=', $patient->id)->get();
        foreach ($results as $result) $appointments[] = $result;

        //dd($appointments);


        // EVENT CREATION

        // Variables:
        // note
        // time
        // time_end
        // doctor
        // patient
        // who_inserted
        // Fullcalendar specific variables: title, color, url

        // Types of events:
        // break
        // open appointment
        // full appointment

        $events = [];
        if ($appointments != null) {
            foreach ($appointments as $checkup) {

                // 1. Default values
                $backgroundClr = '#50000';
                $start = $checkup->time;
                $ends = $checkup->time_end;
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$ends);
                $url = route('calendar.registerEvent', ['time' => $start, 'user' => $checkup->patient, 'doctor' => $doc->id]);
                if ($checkup->patient != null) $title = User::where('id', '=', $checkup->patient)->first()->fullName;

                // 2. Cases
                //TODO

                // Break:
                if ($checkup->note == 'odmor') {
                    $title = 'Odmor';
                    $backgroundClr = '#364';
                    if (session('showUser') != $doc->id) $url = null;
                    elseif ($checkup->who_inserted == $doc->id || ($nurse != null && $checkup->who_inserted == $nurse->id)) {
                        $url = route('calendar.registerEvent', ['time' => $start, 'user' => $checkup->doctor, 'doctor' => $checkup->who_inserted]);
                    }

                }

                // Full appointment:
                if ($checkup->patient != null && $checkup->patient != $patient->id) {
                    $backgroundClr = "#904";
                    $url = route('calendar.registerEvent', ['time' => $start, 'user' => $patient->id, 'doctor' => $checkup->doctor]);
                }
                else if ($checkup->patient == $patient->id) {
                    $backgroundClr = "#099";
                    $url = route('calendar.registerEvent', ['time' => $start, 'user' => $patient->id, 'doctor' => $checkup->doctor]);
                }


                // Open appointment:
                if ($checkup->patient == null) {
                    $title = "Prost termin";
                    $url = route('calendar.registerEvent', ['time' => $start, 'user' => $patient->id, 'doctor' => $checkup->doctor]);
                }

                // 3. Date comparison
                // We only allow accessing the event, if the day of event hasn't passed yet:
                $today = Carbon::now('Europe/Amsterdam');
                $date = Carbon::parse($today);
                if ($date->gt($start)) $url = null;

                // 4. Build event
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
            'eventHeight' => '2',
        ]);  //add an array with addEvents

        $today = new \DateTime();
        // Get all doctors:
        $doctors = User::where('person_type', '=', Code::DOCTOR()->id)->get(); //->prepend('flavourText', '');
        if ($request->docId != null) $selectedDoc = $request->docId;
        else $selectedDoc = $docId;

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

        //dd($next);
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

    public function createSchedule(CalendarScheduleRequest $request) {
        // Get properly formated input:
        $startDate = Carbon::createFromFormat('Y-m-d', $request->dayStart);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->dayEnd);

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
            request()->session()->flash(
                'cloneMessage',
                'Opombe posodobljene!'
            );
            return redirect()->route('calendar.user');
        }

        // Doctor can set you up with another appointment, even if you have one or ten already:
        if (!Auth::user()->isDoctor()) {
            $event = DoctorDates::where('patient', '=', $userId)->first();
            if ($event != null && $event->count > 0) {
                request()->session()->flash(
                    'cloneMessage',
                    'Naenkrat se lahko naročite samo na en termin! Za več naročil se obrnite na svojega osebnega doktorja.'
                );
                return redirect()->route('calendar.user');
            }
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
            if ($date->days > 0 || ($date->h >= 12 && $date->days = 0)) {
                //dd($date);
                $event->patient = null;
                $event->who_inserted = null;
                $event->note = null;
                $event->save();
            } else {
                //dd($date);
                request()->session()->flash(
                    'cloneMessage',
                    'Dogodka ne morete sprositi/izbrisati!'
                );
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
