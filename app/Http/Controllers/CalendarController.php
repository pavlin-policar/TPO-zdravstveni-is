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

        // TODO Differentiate data: doctor VS user (title for doc gives user and their input)
        // TODO Maybe display current users events separately, with option to cancel them
        // TODO Add event functionality (addClick with AJAX?)

        $user = Auth::user();
        $userType = $user->person_type;

        $docDates = new DoctorDates();
        $checkups = $docDates->checks();
        //dd($checkups);
        
        $events = [];

        // Uporabniški dogodki:
        foreach ($checkups as $checkup) {
            $backgroundClr = '#300';
            if ($user == $checkup->patient) {
                echo $title = $checkup->patient;
                echo $backgroundClr = '#800';
                //$url = LINK TO CANCEL APPOINTMENT?
            }
            else $title = 'Zaseden termin';

            echo $start = $checkup->time;
            echo $end = $start + '00:30';

            echo $note = $checkup->note;
            echo $doctor = $checkup->doctor;

            $events[] = \Calendar::event(
                $title,
                false,
                $start,
                $end,
                'stringEventId',
                [
                    'url' => '#',
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

        /*
         * {
                "title":"Free Pizza",
                "allday":"false",
                "description":"<p>This is just a fake description for the Free Pizza.</p><p>Nothing to see!</p>",
                "start":moment().subtract('days',14),
                "end":moment().subtract('days',14),
                "url":"http://www.mikesmithdev.com/blog/coding-without-music-vs-coding-with-music/"
            },
         */

        $calendar = \Calendar::addEvents($events);//->setOptions([ //set fullcalendar options
            //'lang' => 'sl',
            //]);  //add an array with addEvents

        $today = new \DateTime();
        return view('calendar', compact('calendar', 'events', 'today'));
        //View::make('calendar', compact('calendar'));
    }


    /**
     * Add the relation between two users to the database.
     *
     * @param User $user1
     * @param User $user2
     * @param $relationId
     */
    protected function createRelation(User $user1, User $user2, $relationId)
    {
        // add relation to pivot table
        $user1->relationships()->sync([$user2->id => ['relation_id' => $relationId]]);
        // define the inverse
        $user2->relationships()->sync([$user1->id => ['relation_id' => $relationId]]);
    }

}
