<?php

namespace App\Console\Commands;

use App\Calendar;
use Carbon\Carbon;
use App\Mail\EventReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send event reminder emails to external recipients';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = Calendar::where('start_date', Carbon::today()->toDateString())
            ->where('start_time', '>=', Carbon::now()->toTimeString())
            ->get();

        foreach ($events as $event) {
            $recipients = explode(',', $event->external_recipients); // Assuming external_recipients is a comma-separated list of email addresses
            foreach ($recipients as $email) {
                Mail::to(trim($email))->send(new EventReminderMail($event));
            }
        }

        $this->info('Event reminders sent successfully!');
    }
}
