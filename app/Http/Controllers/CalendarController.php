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

            //TODO append, somehow
            $checkups = DoctorDates::where('patient', '=', $user->id)->get();
            $checkups = DoctorDates::where('who_inserted', '=', $user->id)->get();
            $checkups = DoctorDates::where('doctor', '=', $docId)->where('patient', '=', null)->get();

        }

        $events = [];
        foreach ($checkups as $checkup) {

            //TODO discard events before today's date

            $backgroundClr = '#300';
            $start = $checkup->time;
            $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);

            //We're the patient
            if ($user->id == $checkup->patient) {
                $title = $checkup->patient;
                $backgroundClr = '#800';
                //if ($user->isDoctor()) $backgroundClr = '#1200';
            }
            elseif ($user->id == $checkup->who_inserted) {
                $title = $checkup->patient;
                $backgroundClr = '#700';
            }
            elseif (null == $checkup->patitent) {
                $title = 'Prost termin';
                $backgroundClr = '#500';

                if ($user->isDoctor() && $checkup->doctor == $user->id) {
                    $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                    //$url = Route('/calendar/cancelEvent/' . $start . '/' . $user->id);
                }
                else {
                    $url = Route('calendar.registerEvent', [$start, $user->id, $docId]);
                    //Route('/calendar/registerEvent/' . $start . '/' . $user->id);
                    //view('calendar.registerEvent');
                    //Route('calendar.registerEvent', ['method' => 'POST', $user->id, $start]);
                }

            }
            //else $title = 'Zaseden termin';

            $ends = clone($start);
            //TODO read interval from DB
            $ends->addMinutes(15);

            $events[] = \Calendar::event(
                $title,
                false,
                $start,
                $ends,
                'stringEventId',
                [
                    'url' => $url,
                    'color' => $backgroundClr,
                ]
            );
        }

        //dd(Route('calendar.registerEvent', ['time=0020', 'user=2']));
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

        //TODO double check times, maybe use clone?
        for ($startDate; $startDate <= $endDate; $startDate = $startDate->addDay()) {
            foreach ($request->days as $day) {
                // Found chosen day:
                if (Carbon::parse($startDate)->dayOfWeek == $day) {
                    //for ($startTime;  $startTime <= $endTime; $startTime->addHours($jump->hour)->addMinutes($jump->minute)) { <-- IGNORIRAMO, ker imamo privzeti interval 30 minut
                    //dd($startDate);
                    $startTime = Carbon::createFromFormat('H:i', $request->hourStart);
                    for ($startTime=$startTime->subMinutes($jump->minute);  $startTime <= $endTime; $startTime=$startTime->addMinutes($jump->minute)) {
                        //$end = $startTime->addHours($jump->hour)->addMinutes($jump->minute); <-- IGNORIRAMO, ker imamo privzeti interval 30 minut
                        $time = $startDate->toDateString() . ' ' . $startTime->toTimeString();
                        DoctorDates::create(['time' => $time, 'doctor' => Auth::user()->id ])->save();
                    }
                    //break;
                }
            }
        }

        return redirect()->route('calendar.user');

    }

    public function registerEventForm($time, $user, $doctor) {
        $patient = User::where('id', '=', $user)->first();

        // Ali je dogodek že zaseden? Potem ga morda ta oseba lahko izbriše!
        $creator = DoctorDates::where('patient', '=', $user)->where('time', '=', $time)->first();

        return view('calendarEvents.registerFreeEvent', ['time' => $time, 'patient' => $patient, 'creator' => $creator, 'doctor' => $doctor]);
    }

    public function register($time, $userId) {

        //TODO everything -> differentiate between user and doctor
        //TODO            -> format time, registering user, and registered patient
        //TODO            -> find corresponding event in DB, add missing details, save, and redirect back to Calendar
        //TODO            -> allow only one registered event per user per doctor

        //Does even already have a user? -> YES, save notes and return to calendar view
        //                               ->  NO, save patient and notes, return to calendar view

        //We get patient's ID and time of event, who_registered comes from Auth::user()->id
        

        // Current user:
        $user = Auth::user();

        // Is event already full?
        $checkups = DoctorDates::where('patient', '=', $user->id)->get();
        if ($checkups != null) {
            //TODO event already exists, we're just updating notes and returning at the end
        }

        // The event is still free, so this is user trying to register:
        //TODO how fo we know which doctor this is, since user can change a different one?
        $checkups = DoctorDates::where('time', '=', $time)->where('patient', '=', null)->get();


        $events = [];

        foreach ($checkups as $checkup) {
            if ($checkup->start == $time) {
                $checkup->patient = $user;
                

                $checkup->note = null;

                $checkup->save();
                break;
            }
        }

        return redirect()->route('calendar.user');
    }

    public function cancel($time, $user) {

        //TODO differentiate between user and doctor
        //TODO allow doc to kill empty events
        //TODO only allow people who registered events to also cancel them (needs DB fix first)
        $docDates = new DoctorDates();
        $checkups = $docDates->checks();
        //dd($checkups);

        foreach ($checkups as $checkup) {
            if ($checkup->time == $time) {
                $checkup->patient = null;
                $checkup->note = null;

                $checkup->save();
                break;
            }
        }

        return redirect()->route('calendar.user');
    }
}
