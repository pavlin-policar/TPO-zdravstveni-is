<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\CreateChargeRequest;
use App\Models\DoctorDates;
use App\Models\User;
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

    public function index()
    {
        $user = Auth::user();
        $checkups = null;
        if ($user->isDoctor()) {
            $checkups = DoctorDates::where('doctor', '=', $user->id)->get();
            //doctorChecks!!!
            //patientChecks!!!
        }
        elseif ($user->hasDoctors()){
            $checkups = DoctorDates::where('patient', '=', $user->id)->get();
            $checkups += DoctorDates::where('doctor', '=', $user->personal_doctor_id)->where('patient', '=', null)->get();
        }
        
        $events = [];

        foreach ($checkups as $checkup) {

            //TODO discard events before today's date

            $backgroundClr = '#300';
            $url = '#';
            $start = $checkup->time;
            //TODO zaenkrat imamo kar privzeti interval, lahko popravimo
            $end = $start->addMinutes(30); 

            if ($user->id == $checkup->patient) {
                $title = $checkup->patient;
                $backgroundClr = '#800';
                if ($user->isDoctor()) $backgroundClr = '#1200';
                $url = Route('calendar.cancelEvent', [$start, $user->id]);
            }
            elseif (null == $checkup->patitent) {
                $title = 'Prost termin';
                $backgroundClr = '#500';
                //TODO fix URLs
                if ($user->isDoctor()) $url = Route('calendar.cancelEvent', [$start, $user->id]); //$url = Route('/calendar/cancelEvent/' . $start . '/' . $user->id);
                else $url = Route('/calendar/registerEvent/' . $start . '/' . $user->id); //view('calendar.registerEvent'); //Route('calendar.registerEvent', ['method' => 'POST', $user->id, $start]);
            }
            else $title = 'Zaseden termin';

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

        //dd(Route('calendar.registerEvent', ['time=0020', 'user=2']));

        /*// TESTNI DOGODKI:

        $events[] = \Calendar::event(
            $title = "Valentine's Day - pacient 1234, redni pregled", //event title
            false, //full day event?
            new \DateTime('2016-05-2 10:00:00'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-2 10:30:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            $title = "Prost termin", //event title
            false, //full day event?
            new \DateTime('2016-05-3 10:00:00'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-3 10:30:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            $title = "Prost termin", //event title
            false, //full day event?
            new \DateTime('2016-05-3 10:30:00'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-3 11:0:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            $title = "Prost termin", //event title
            false, //full day event?
            new \DateTime('2016-05-3 11:00:00'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-3 11:30:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            $title = "Pacient 1234, redni pregled", //event title
            false, //full day event?
            new \DateTime('2016-05-4 10:00'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-4 10:30'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId', //optionally, you can specify an event ID
            [
                'url' => Route('calendar.registerEvent', ['0020', '2']),
                'color' => '#800',
            ]
        );
        $events[] = \Calendar::event(
            $title = "Pacient 1234, redni pregled", //event title
            false, //full day event?
            new \DateTime('2016-05-4 10:30'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-4 11:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId', //optionally, you can specify an event ID
            [
                'url' => route('calendar.user'),
            ]
        );
        $events[] = \Calendar::event(
            $title = "Pacient 1234, redni pregled", //event title
            false, //full day event?
            new \DateTime('2016-05-4 11:30'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-05-4 12:00'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId', //optionally, you can specify an event ID
            [
                'url' => route('calendar.user'),
            ]
        );*/

        $calendar = \Calendar::addEvents($events);//->setOptions([ //set fullcalendar options
            //]);  //add an array with addEvents

        $today = new \DateTime();
        return view('calendarEvents.calendar', compact('calendar', 'events', 'today'));
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
            //'interval' => 'required|date_format:"H:i"',
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
        //$jump = Carbon::parse($request->interval); //$request->interval;

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
                    for ($startTime;  $startTime <= $endTime; $startTime=$startTime->addMinutes(30)) {
                        //TODO add optional lunch break
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
    
    public function cancel($time, $user) {

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

    public function registerEventForm($time, $user) {
        return view('calendarEvents.registerFreeEvent', ['time' => $time, 'user' => $user]);
    }

    public function register($time, $user) {

        $docDates = new DoctorDates();
        $checkups = $docDates->checks();
        dd($checkups);

        foreach ($checkups as $checkup) {
            if ($checkup->start == $time) {
                $checkup->patient = $user;
                
                //TODO How to add notes?
                $checkup->note = null;

                $checkup->save();
                break;
            }
        }

        return redirect()->route('calendar.user');
    }
}
