<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.event_reminder')
            ->subject('Event Reminder: ' . $this->event->title)
            ->with([
                'title' => $this->event->title,
                'start_date' => $this->event->start_date,
                'start_time' => $this->event->start_time,
                'end_date' => $this->event->end_date,
                'end_time' => $this->event->end_time,
                'notes' => $this->event->notes,
            ]);
    }
}
