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

        if ($user->isDoctor()) {
            $docId = $user->id;
            $checkups = DoctorDates::where('doctor', '=', $docId)->get();
            //TODO get selected doctor from Form::select and show that instead of the above
        }
        elseif ($user->hasDoctor()){
            $docId = $user->personal_doctor_id;
            //TODO get selected doctor from Form::select
            if ($request->doc != null) $docId = $request->doc;

            $tempCheckups = DoctorDates::where('patient', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            $tempCheckups = DoctorDates::where('patient', '=', !$user->id)->where('who_inserted', '=', $user->id)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

            $tempCheckups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();
            foreach ($tempCheckups as $tempCheckup) $checkups[] = $tempCheckup;

        }

        $events = [];
        if ($checkups != null) {
            foreach ($checkups as $checkup) {
                //dd($checkup);

                //TODO discard events before today's date

                $backgroundClr = '#300';
                $start = $checkup->time;
                $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);

                // We're the patient
                if ($user->id == $checkup->patient) {
                    $title = $checkup->patient;
                    $backgroundClr = '#800';
                    //if ($user->isDoctor()) $backgroundClr = '#1200';
                } // We're the ones who registered the appointment
                elseif ($user->id == $checkup->who_inserted) {
                    $title = $checkup->patient;
                    $backgroundClr = '#700';
                } // The event is still open
                elseif (null == $checkup->patitent) {
                    $title = 'Prost termin';
                    $backgroundClr = '#500';

                    if ($user->isDoctor() && $checkup->doctor == $user->id) {
                        $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                        //$url = Route('/calendar/cancelEvent/' . $start . '/' . $user->id);
                    } else {
                        $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                    }

                }

                //$ends = clone($start);
                //TODO read interval from DB
                //$ends->addMinutes(15);
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

        $calendar = \Calendar::addEvents($events);//->setOptions([ //set fullcalendar options
            //]);  //add an array with addEvents

        $today = new \DateTime();
        //if ($request->doc == null)

        // Get all doctors:
        $doctors = User::where('person_type', '=', Code::DOCTOR()->id)->get();
        //dd($doctors);
        $selectedDoc = $docId;

        return view('calendarEvents.calendar', compact('calendar', 'events', 'today','doctors', 'selectedDoc'));
        //View::make('calendar', compact('calendar'));
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
                'dayStart.date_format' => 'Dan mora biti podan v formatu dd/mm!',
                'date_format' => 'Čas mora biti podan v formatu HH.mm!',
                'dayEnd.after' => 'Končni datum mora biti večji od začetnega',
                'after' => 'Začetni datum mora biti kasnejši od današnjega!',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return view('calendarEvents.docSchedule')->withErrors($validator);
        }

        $startDate = Carbon::createFromFormat('d/m', $request->dayStart);
        $endDate = Carbon::createFromFormat('d/m', $request->dayEnd);
        //$startDate = Carbon::parse($request->dayStart)->toDateString();//->dayOfWeek;
        //$endDate = Carbon::parse($request->dayEnd)->toDateString();//->dayOfWeek;

        //dd(Carbon::parse($startDate)->dayOfWeek); // 1 = PON
        $jump = Carbon::createFromFormat('H:i', $request->interval);
        //dd($jump->minute);

        //$startTime = Carbon::parse($request->hourStart)->toTimeString(); //$request->hourStart;
        //$startTime = Carbon::createFromFormat('H:i', $request->hourStart);
        //$endTime = Carbon::parse($request->hourEnd)->toTimeString(); //$request->hourEnd;
        $endTime = Carbon::createFromFormat('H:i', $request->hourEnd);

        //dd($endDate);

        for ($startDate; $startDate <= $endDate; $startDate = $startDate->addDay()) {
            foreach ($request->days as $day) {
                // Found chosen day:
                if (Carbon::parse($startDate)->dayOfWeek == $day) {
                    //for ($startTime;  $startTime <= $endTime; $startTime->addHours($jump->hour)->addMinutes($jump->minute)) { <-- IGNORIRAMO, ker imamo privzeti interval 30 minut
                    //dd($startDate);
                    $startTime = Carbon::createFromFormat('H:i', $request->hourStart);
                    $end = clone($startTime);
                    for ($startTime;  $startTime <= $endTime; $startTime->addMinutes($jump->minute)) {
                        $end->addMinutes($jump->minute); // Termin interval!
                        //TODO won't work if they have nightshifts
                        $time = $startDate->toDateString() . ' ' . $startTime->toTimeString();
                        $timeEnd = $startDate->toDateString() . ' ' . $end->toTimeString();
                        //DoctorDates::create(["time_end" => $timeEnd, 'time' => $time, 'doctor' => Auth::user()->id])->save();
                        $dd = new DoctorDates();
                        $dd->time = $time;
                        $dd->time_end = $timeEnd;
                        $dd->doctor = Auth::user()->id;
                        //dd($dd);
                        $dd->save();
                    }
                }
            }
        }

        return redirect()->route('calendar.user');

    }

    public function registerEventForm($time, $user, $doctor) {
        $patient = User::where('id', '=', $user)->first();
        // Ali je dogodek že zaseden? Potem ga morda ta oseba lahko izbriše!
        $creator = DoctorDates::where('patient', '=', $user)->where('time', '=', $time)->first();
        //dd($creator);
        return view('calendarEvents.registerFreeEvent', ['time' => $time, 'patient' => $patient, 'creator' => $creator, 'doctor' => $doctor]);
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

    public function cancel($time, $user) {

        //TODO is event empty? -> is this user the same one who created empty event? -> is the event stil far enough away? ALLOW DELETE
        //TODO             \-> not empty -> is this user the same one, who registered the appointment? -> is the event still far enough away? ALLOW RELEASE OF THE EVENT

        // 1. Get the event

        // 2. Is event empty?

        // 3. Am I creator of said event?

        dd('sup');

        return redirect()->route('calendar.user');
    }
}
