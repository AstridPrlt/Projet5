<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'event_description', 'event_date', 'begin_time', 'end_time', 'seats', 'price', 'category', 'event_picture'
    ];


    public function users() {
        return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
    }
}
