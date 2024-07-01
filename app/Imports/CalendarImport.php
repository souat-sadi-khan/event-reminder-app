<?php

namespace App\Imports;

use App\Calendar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CalendarImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Calendar([
            'event_reminder_id' => $this->generateEventReminderId(),
            'title' => $row[0],
            'start_date' => date('Y-m-d', strtotime($row[1])),
            'start_time' => date('H:i', strtotime($row[2])),
            'end_date' => date('Y-m-d', strtotime($row[3])),
            'end_time' => date('H:i', strtotime($row[4])),
            'notes' => $row[5],
            'is_completed' => $row[6] == 1 ? true : false,
            'external_recipients' => $row[7]
        ]);
    }

    /**
     * Generating a new event Reminder ID.
     *
     * @return \Illuminate\Http\Response
     */
    private function generateEventReminderId()
    {
        $prefix = get_option('prefix');
        $uniqueId = uniqid($prefix);

        // Ensure the ID is unique in the database
        while (Calendar::where('event_reminder_id', $uniqueId)->exists()) {
            $uniqueId = uniqid($prefix);
        }

        return $uniqueId;
    }
}
