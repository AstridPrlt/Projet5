<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Event;
use App\Http\Controllers\PaymentController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Image;
use Intervention\Image\Facades\Image;

class EventUserRepository {

    public function eventsIndexWithNbBooked()
    {
        //request to know how many seats are already booked for each event
        $booked = DB::table('event_user')->select('event_id', DB::raw('count(*) as seats_booked'))->groupBy('event_id');
        //request to retrieve all events with number of seats already booked
        $events = DB::table('events')->where('event_date_time','>', NOW())->leftJoinSub($booked, 'booked', function ($join) {$join->on('events.id', '=', 'booked.event_id');})->orderBy('event_date_time', 'asc')->get();

        return $events;
    }

    public function showEvent($eventId)
    {
        $eventSelected = Event::find($eventId);
        return $eventSelected;
    }

    public function isEventBookedByAuth($eventId)
    {
        $isBooked = Auth::user()->events->contains($eventId) ? 1 : 0;
        return $isBooked;
    }

    public function eventBooking(Request $request)
    {
        $user = Auth::user();
        $user->events()->attach($request->eventId);
        $bookingInfo = DB::table('event_user')->where('event_id', $request->eventId)->where('user_id', Auth::user()->id)->get();

        if(isset($request->pi)) {
            $addPaymentIntent = DB::table('event_user')->where('event_id', $request->eventId)->where('user_id', Auth::user()->id)->update(['payment_intent' => $request->pi]);
            $bookingInfo = DB::table('event_user')->where('event_id', $request->eventId)->where('user_id', Auth::user()->id)->get();
        }

        return $bookingInfo;
    }

    public function eventBookingToCancel($eventId)
    {
        $user = Auth::user();
        //delete the booking in event_user
        $user->events()->detach($eventId);
        return "Inscription annulée";
    }

    public function userEvents()
    {
        $showMyEvents = Auth::user()->events->all();
        return $showMyEvents;
    }

    public function authEventIds()
    {
        $authEvents = DB::table('event_user')->where('user_id', Auth::user()->id)->pluck('event_id');
        return $authEvents;
    }

    public function usersListForEvent($eventId)
    {
        //find all the lines related to the given event is the pivot table
        $list = DB::table('event_user')->where('event_id', $eventId);
        //retrieve then the users indicated on the above lines
        $usersOnList = DB::table('users')->joinSub($list, 'list', function ($join) {$join->on('users.id', '=', 'list.user_id');})->select('name', 'email')->get();

        return response()->json($usersOnList);
    }

    public function showPastEvents()
    {
        $pastEvents = Event::where('event_date_time','<', NOW())->orderBy('event_date_time', 'desc')->get();
        return response()->json($pastEvents);
    }

    public function showFutureEvents()
    {
        $futureEvents = Event::where('event_date_time','>', NOW())->orderBy('event_date_time', 'asc')->get();
        return response()->json($futureEvents);
    }

    public function storeNewEvent(Request $request)
    {
        if($request->file('picture')){
            $eventPicture = $request->file('picture')->store('eventsPictures', 'public');//store the new picture
            $image = Image::make(Storage::get('public/'.$eventPicture))->fit(300, 200)->encode(); //resize the new picture
            Storage::put('public/'.$eventPicture, $image); //then save it
        } else {
            $eventPicture = null;
        };

        $eventCreated = Event::create([
            'category' => $request->category,
            'title' => $request->title,
            'event_date_time' => $request->event_date_time,
            'event_date' => $request->event_date,
            'begin_time' => $request->begin_time,
            'end_time' => $request->end_time,
            'event_description' => $request->event_description,
            'seats' => $request->seats,
            'price' => $request->price,
            'event_picture' => $eventPicture
        ]);

        // $eventCreated = Event::create($request->all());

        return $eventCreated;
    }

    public function editEvent($eventId)
    {
        $eventToUpdate = Event::find($eventId);
        return $eventToUpdate;
    }

    public function updateEvent(Event $event)
    {
        $eventToModify = Event::find($event->id);

        $eventToModify->category = request('category');
        $eventToModify->title = request('title');
        $eventToModify->event_date_time = request('event_date_time');
        $eventToModify->event_date = request('event_date');
        $eventToModify->begin_time = request('begin_time');
        $eventToModify->event_description = htmlspecialchars(request('event_description'));
        $eventToModify->seats = request('seats');
        $eventToModify->price = request('price');

        $eventToModify->save();

        return $eventToModify;
    }

}
