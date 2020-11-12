<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use \Illuminate\Support\Facades\DB;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Repositories\EventUserRepository;


class EventController extends Controller
{
    public function __construct()
    {
        $this->eventUser = new EventUserRepository();
    }
    /**
     * Display a listing of the events with the number of booked seats.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventUser->eventsIndexWithNbBooked();
        // if (Auth::user()) {
        //     $bookedAll = Auth::user()->events->all();
        //     $events = Event::orderBy('event_date', 'asc')->get();
        //     return view('events', ['events' => $events, 'bookedAll' => $bookedAll]);
        // } else {
        return view('events', ['events' => $events]);
    }

    // public function isEventBookedByAuth($eventId) {
    //     $isBooked = $this->eventUser->isEventBookedByAuth($eventId);
    //     return $isBooked;
    // }

    /**
     * Show a specified event to the auth user and indicates if he has already booked it.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, $eventId)
    {
        $eventSelected = $this->eventUser->showEvent($eventId);
        $booked = $this->eventUser->isEventBookedByAuth($eventId);
        return view('booking', ['eventSelected' => $eventSelected, 'booked' => $booked]);
    }

    /**
     * Book an event for the auth user.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request)
    {
        $eventBooking = $this->eventUser->eventBooking($request);
        return $eventBooking;
    }

    /**
     * Show the user all the events he has booked, in his profile page.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function showMyEvents()
    {
        $myEvents = $this->eventUser->userEvents();
        return $myEvents;
    }

    /**
     * For Admin : Show the listing of all the users registered for an event.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function showListEvent($eventId)
    {
        $usersList = $this->eventUser->usersListForEvent($eventId);
        return $usersList;
    }

    /**
     * For Admin : Display a listing of all the past events.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexPast()
    {
        $showPastEvents = $this->eventUser->showPastEvents();
        return $showPastEvents;
    }

    /**
     * Display a listing of all the future events for admin management.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexFuture()
    {
        $showFutureEvents = $this->eventUser->showFutureEvents();
        return $showFutureEvents;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|min:2|max:60',
            'event_date' => 'required|date',
            'begin_time' => 'required',
            'end_time' => 'required',
            'event_description' => 'required|min:2|max:500',
            'seats' => 'required|max:200',
            'price' => 'required|max:2000',
            'picture' => 'image|mimes:png,jpg,jpeg,gif,svg|nullable',
        ]);

        $storeEvent = $this->eventUser->storeNewEvent($request);

        //to reload event list in admin panel via emit
        if($storeEvent) {
            return $this->indexFuture();
        } else {
            return response()->json(['error' => "L'évènement n'a pas pu être créé"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|min:2|max:60',
            'event_date' => 'required|date',
            'begin_time' => 'required',
            'end_time' => 'required',
            'event_description' => 'required|min:2|max:500',
            'seats' => 'required|max:200',
            'price' => 'required|max:2000'
        ]);

        $updateEvent = $this->eventUser->updateEvent($event);

        if($updateEvent) {
            return response()->json(['confirm' => "L'évènement a été modifié"]);
        } else {
            return response()->json(['error' => "L'évènement n'a pas pu être modifié"]);
        }

    }

    /**
     * Remove future and past events.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroyFutureEvent(Event $event, $eventId)
    {
        $eventToDelete = Event::find($eventId);
        if($eventToDelete->event_picture !== 'eventsPictures/logoEvent.png') {
            Storage::disk('local')->delete('public/'.$eventToDelete->event_picture); //delete the related picture except if it's the default event picture
        };
        $deleteEvent = $eventToDelete->delete();

        if($deleteEvent) {
            return $this->indexFuture();
        } else {
            return response()->json(['error' => "L'évènement n'a pas pu être supprimé"]);
        }
    }

    public function destroyPastEvent(Event $event, $eventId)
    {
        $eventToDelete = Event::find($eventId);
        if($eventToDelete->event_picture !== 'eventsPictures/logoEvent.png') {
            Storage::disk('local')->delete('public/'.$eventToDelete->event_picture); //delete the related picture except if it's the default event picture
        };
        $deleteEvent = $eventToDelete->delete();

        if($deleteEvent) {
            return $this->indexPast();
        } else {
            return response()->json(['error' => "L'évènement n'a pas pu être supprimé"]);
        }
    }
}
