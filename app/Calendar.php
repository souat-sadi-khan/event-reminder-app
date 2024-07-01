<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'notes',
        'is_completed',
        'event_reminder_id', 
        'external_recipients',
    ];
}