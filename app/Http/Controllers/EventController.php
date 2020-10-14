<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use \Illuminate\Support\Facades\DB;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()) {
        //     $bookedAll = Auth::user()->events->all();
        //     $events = Event::orderBy('event_date', 'asc')->get();
        //     return view('events', ['events' => $events, 'bookedAll' => $bookedAll]);
        // } else {
        $booked = DB::table('event_user')->select('event_id', DB::raw('count(*) as seats_booked'))->groupBy('event_id');
        $events = DB::table('events')->leftJoinSub($booked, 'booked', function ($join) {$join->on('events.id', '=', 'booked.event_id');})->get();
        // $events = Event::orderBy('event_date', 'asc')->get();
        return view('events', ['events' => $events]);
        // }
        // return response()->json($events);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, $eventId)
    {
        $booked = Auth::user()->events->contains($eventId) ? 1 : 0;
        $eventSelected = Event::find($eventId);

        return view('booking', ['eventSelected' => $eventSelected, 'booked' => $booked]);
    }

    public function booking(Request $request)
    {
        $user = Auth::user();
        $user->events()->attach($request->eventId);
        return "Vous êtes inscrit";
    }

    public function showMyEvents()
    {
        $myEvents = Auth::user()->events->all();

        return response()->json($myEvents);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
