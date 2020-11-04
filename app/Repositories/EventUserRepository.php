<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class EventUserRepository {

    public function booked()
    {
        $booked = DB::table('event_user')->select('event_id', DB::raw('count(*) as seats_booked'))->groupBy('event_id');

        return $booked;
    }
}
