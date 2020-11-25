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
use Mockery\Undefined;

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

        if (Auth::user()) { //if a user is authentified, check if he has some future events booked -> return an array of these events id
            $authEvents = $this->eventUser->authEventIds();
            if(empty($authEvents)) { //if no events booked by this user
                $authEvents = json_encode("Pas d'évènement");
            }
            return view('events', ['events' => $events, 'authEvents' => $authEvents]);
        } else {
            $authEvents = json_encode("Pas d'évènement");
            return view('events', ['events' => $events, 'authEvents' => $authEvents]);
        }

    }

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
     * When user book and pay an event, it add the payment_intent in event_user db in case of refund
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingPaymentInt(Request $request, $eventId)
    {
        $bookingToUpdate = DB::table('event_user')->where('event_id', $eventId)->where('user_id', Auth::user()->id)->update(['payment_intent' => $request->pi]);

        if($bookingToUpdate) {
            return response()->json($bookingToUpdate);
        } else {
            return response()->json(['error' => "Problème avec payment_intent"]);
        }
    }

    public function cancelBooking($eventId)
    {
        $eventBookingToCancel = $this->eventUser->eventBookingToCancel($eventId);
        return $eventBookingToCancel;
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
        return response()->json($myEvents);
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
            'event_date_time' => 'required',
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
    public function edit($eventId)
    {
        $editEvent = $this->eventUser->editEvent($eventId);
        return response()->json($editEvent);
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
            'event_date_time' => 'required',
            'event_date' => 'required|date',
            'begin_time' => 'required',
            'event_description' => 'required|min:2|max:500',
            'seats' => 'required|max:200',
            'price' => 'required|max:2000'
        ]);

        $updateEvent = $this->eventUser->updateEvent($event);

        //to reload event list in admin panel via emit
        if($updateEvent) {
            return $this->indexFuture();
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
        //delete booking in event_user table for the given event
        $eventToDelete->users()->detach();

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

        //delete the related picture except if it's the default event picture
        if($eventToDelete->event_picture !== 'eventsPictures/logoEvent.png') {
            Storage::disk('local')->delete('public/'.$eventToDelete->event_picture);
        };
        //delete booking in event_user table for the given event
        $eventToDelete->users()->detach();

        $deleteEvent = $eventToDelete->delete();

        if($deleteEvent) {
            return $this->indexPast();
        } else {
            return response()->json(['error' => "L'évènement n'a pas pu être supprimé"]);
        }
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

}
