<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Spatie\GoogleCalendar\Event;
use Spatie\GoogleCalendar\Event;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\ConferenceData;
use Google\Service\Calendar\ConferenceSolutionKey;
use Google\Service\Calendar\CreateConferenceRequest;
use App\Http\Requests\CreateMeetingRequest;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createMeeting(CreateMeetingRequest $request)
    {

        $start_time = Carbon::parse($request->input('start_time'),'Africa/Cairo');
        $end_time = $start_time->addHour();


        $event = new Event;
        $event->name = $request->input('meeting_title');
        $event->description = $request->input('meeting_description');
        $event->startDateTime = $start_time;
        $event->endDateTime = $end_time;
        $event->addAttendee(['email' => $request->input('doctor_email')]);
        $event->addAttendee(['email' => $request->input('patient_email')]);
        $conference = new \Google_Service_Calendar_ConferenceData();
        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('randomString123');
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData = $conference;
        $newEvent = $event->save();
        return response()->json(['meeting_link' => $newEvent->hangoutLink]);








        // // $start_time = Carbon::parse('2023-04-27 12:30:00','Africa/Cairo');
        // // $end_time = $start_time->addHour();


        // $event = new Event;
        // $event->name = "Hammad Testing Title";
        // $event->description = "Hammad Testing Description";
        // // $event->startDateTime = $start_time;
        // // $event->endDateTime = $end_time;

        // $event->startDateTime = Carbon::now();
        // $event->endDateTime = Carbon::now()->addHour();
        // $event->addAttendee(['email' => 'dev.mhammad@gmail.com']);
        // $event->addAttendee(['email' => 'ahmedbadr200121@gmail.com']);

        // $conference = new \Google_Service_Calendar_ConferenceData();
        // $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        // $conferenceRequest->setRequestId('randomString123');
        // $conference->setCreateRequest($conferenceRequest);
        // $event->setConferenceData = $conference;
        // $newEvent = $event->save();
        // // dd($newEvent);
        // return response()->json(['meeting_link' => $newEvent->hangoutLink]);


    }
}
