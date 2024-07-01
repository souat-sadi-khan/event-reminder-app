# Laravel Event Reminder App

Welcome to my project! This is a brief overview of what my project does. The system includes functionalities to schedule events, send email reminders to external recipients, and import events from CSV files.

[Demo URL](https://app.souatsadikhan.com/)

## Table of Contents

1. [Features](###Features)
2. [Technical Requirements](###Technical Requirements)
3. [Installation and Setup](#Installation and Setup) 

### Features

1. Event Management
    - Create, update, and delete events
    - Manage event details including title, start date, start time, end date, end time, notes, and completion status
    - Assigned unique reminder IDs to events
2. Email Reminders
    - Schedule and send email reminders for events to external recipients
    - Customized email content to include event details.
    - Used Laravel's mail and scheduling features to automate reminder emails at specific times
3. CSV Import
    - Import event data from CSV files
    - Validate and store imported events in the database
    - Provided a user-friendly interface for CSV file uploads
4. Calendar Integration
    - Integrated with FullCalendar to display events in a calendar view.
    - Added custom view buttons for enhanced calendar functionality.
5. User Interface
    - Provided a clean and intuitive user interface for managing events and viewing the calendar
    - Included forms for event creation, updating, deletion, and CSV import
6. Filtering and Searching
    - Filtered events by date and status (upcoming, completed, overdue).
    - Search events by title or other attributes.
7. Scheduling and Queues
    - Used Laravel's task scheduling to send email reminders at specific times.
    - Ensure scalability and reliability with queued email sending.

### Technical Requirements

- Backend: Laravel Framework v5.6 (PHP v7.4)
- Frontend: Blade Templates, FullCalendar (JavaScript), jQuery
- Database: MySQL, IndexDB
- Email Service: Laravel Mail (SMTP)
- File Handling: Laravel Excel (maatwebsite/excel package

### Installation and Setup

1. Clone the Repository
    ```sh
    git clone <repository-url>
    cd event-reminder-system
    ```
2. Install Dependencies:
    ```sh
    composer install
    ```

3. Environment Configuration
    - Copy .env.example to .env and configure database and mail settings

4. Database Migration
    ```sh
    php artisan migrate
    ```
5. Run the Application
    ```sh
    php artisan serve
    ```
6. Configure the Cron Job
To ensure that the Laravel scheduler runs regularly, you need to configure a cron job on your server. This cron job should call Laravel's scheduler every minute.
Open your server's crontab configuration by running:
    ```sh
        crontab -e
    ```
    Add the following line to the crontab file:
    ```sh
        * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    ```
    Replace /path-to-your-project with the path to your Laravel project.



