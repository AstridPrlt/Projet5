<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function categories() {
        return $this->belongsTo(Category::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
