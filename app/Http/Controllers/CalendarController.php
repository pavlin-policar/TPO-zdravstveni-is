<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateChargeRequest;
use App\Models\DoctorDates;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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
            $end = $start->addMinutes(30);

            if ($user->id == $checkup->patient) {
                $title = $checkup->patient;
                $backgroundClr = '#800';
                //TODO fix URLs
                $url = Route('calendar.cancelEvent', ['method' => 'POST', $user->id, $start]);
                //$url = Route('/calendar/cancelEvent/' . $start . '/' . $user->id, ['method' => 'POST']);
            }
            elseif (null == $checkup->patitent) {
                $title = 'Prost termin';
                $backgroundClr = '#500';
                //TODO fix URLs
                if ($user->isDoctor()) $url = Route('calendar.cancelEvent', [$user->id, $start]);
                else $url = Route('calendar.registerEvent', ['method' => 'POST', $user->id, $start]);
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

        // TESTNI DOGODKI:

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
                'url' => route('calendar.user'),
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
        );

        $calendar = \Calendar::addEvents($events);//->setOptions([ //set fullcalendar options
            //]);  //add an array with addEvents

        $today = new \DateTime();
        return view('calendarEvents.calendar', compact('calendar', 'events', 'today'));
        //View::make('calendar', compact('calendar'));
    }

    public function manageSchedule() {
        dd(Auth::user()->id);
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
