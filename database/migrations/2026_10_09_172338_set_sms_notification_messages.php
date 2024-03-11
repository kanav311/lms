<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetSmsNotificationMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\SmsTemplate::insert([

            [
                'id'=>'1',
                'name'=>'Upcoming class reminder (physical location)',
                'description'=>'This message is sent to students to remind them when a class is scheduled to hold.',
                'message'=>'Reminder! The [SESSION_NAME] class \'[SESSION_NAME]\' holds on [CLASS_DATE]. Venue: [CLASS_VENUE] . Starts: [CLASS_START_TIME] . Ends: [CLASS_END_TIME]',
                'default'=>'Reminder! The [SESSION_NAME] class \'[SESSION_NAME]\' holds on [CLASS_DATE]. Venue: [CLASS_VENUE] . Starts: [CLASS_START_TIME] . Ends: [CLASS_END_TIME]',
                'placeholders'=>'
                <ul>
                <li>[CLASS_NAME] : The name of the class</li>
                <li>[CLASS_DATE] : The class date</li>
                <li>[SESSION_NAME] : The name of the session the class is attached to</li>
                <li>[CLASS_VENUE] : The venue of the class</li>
                <li>[CLASS_START_TIME] : The start time for the class</li>
                <li>[CLASS_END_TIME] : The end time for the class</li>
                </ul>
                '
            ],


            [
                'id'=>'2',
                'name'=>'Upcoming class reminder (online class)',
                'description'=>'This message is sent to students to remind them when an online class is scheduled to open.',
                'message'=>'Reminder! The [COURSE_NAME] class \'[CLASS_NAME]\' starts on  [CLASS_DATE]',
                'default'=>'Reminder! The [COURSE_NAME] class \'[CLASS_NAME]\' starts on  [CLASS_DATE]',
                'placeholders'=>'
                <ul>
                <li>[CLASS_NAME] : The name of the class</li>
                <li>[CLASS_DATE] : The class date</li>
                <li>[COURSE_NAME] : The name of the session the class is attached to</li>
                </ul>
                '
            ],


            [
                'id'=>'3',
                'name'=>'Upcoming Test reminder',
                'description'=>'This message is sent to users when there is an upcoming test in a session/course they are enrolled in',
                'message'=>'Reminder: The \'[SESSION_NAME]\' test \'[TEST_NAME]\' opens on [OPENING_DATE] and closes on [CLOSING_DATE]',
                'default'=>'Reminder: The \'[SESSION_NAME]\' test \'[TEST_NAME]\' opens on [OPENING_DATE] and closes on [CLOSING_DATE]',
                'placeholders'=>'
                <ul>
                <li>[TEST_NAME] : The name of the test</li>
                <li>[TEST_DESCRIPTION] : The description of the test</li>
                <li>[SESSION_NAME] : The name of the session or course the test is attached to</li>
                <li>[OPENING_DATE] : The opening date of the test</li>
                <li>[CLOSING_DATE] : The closing date of the test</li>
                <li>[PASSMARK] : The test passmark e.g. 50%</li>
                <li>[MINUTES_ALLOWED]: The number of minutes allowed for the test</li>
                </ul>
                '
            ],


            [
                'id'=>'4',
                'name'=>'Online Class start notification',
                'description'=>'This message is sent to students when a scheduled online class opens',
                'message'=>'Please be reminded that the class \'[CLASS_NAME]\' for the course \'[COURSE_NAME]\' has started. <br/>
Visit this link to take this class now: [CLASS_URL]',
                'default'=>'Please be reminded that the class \'[CLASS_NAME]\' for the course \'[COURSE_NAME]\' has started. <br/>
Visit this link to take this class now: [CLASS_URL]',
                'placeholders'=>'
                <ul>
                <li>[CLASS_NAME] : The name of the class</li>
                <li>[CLASS_URL] : The url of the class</li>
                <li>[COURSE_NAME] : The name of the course the class belongs to</li>
                </ul>
                '
            ],


            [
                'id'=>'5',
                'name'=>'Homework reminder',
                'description'=>'This message is sent to students reminding them when a homework is due',
                'message'=>'Please be reminded that the homework \'[HOMEWORK_NAME]\' is due on [DUE_DATE].
Please click this link to submit your homework now: [HOMEWORK_URL]',
                'default'=>'Please be reminded that the homework \'[HOMEWORK_NAME]\' is due on [DUE_DATE].
Please click this link to submit your homework now: [HOMEWORK_URL]',
                'placeholders'=>'
                <ul>
                <li>[NUMBER_OF_DAYS] : The number of days remaining till the homework due date e.g. 1,2,3</li>
                <li>[DAY_TEXT] : The \'day\' text. Defaults to \'day\' if [NUMBER_OF_DAYS] is 1 and \'days\' if greater than 1.</li>
                <li>[HOMEWORK_NAME] : The name of the homework</li>
                <li>[HOMEWORK_URL] : The homework url</li>
                <li>[HOMEWORK_INSTRUCTION] : The instructions for the homework</li>
                <li>[PASSMARK] : The passmark for the homework</li>
                 <li>[DUE_DATE] : The homework due date</li>
                <li>[OPENING_DATE] : The homework opening date</li>

                </ul>
                '
            ],


            [
                'id'=>'6',
                'name'=>'Course closing reminder',
                'description'=>'Warning email sent to enrolled students about a course that will close soon.',
                'message'=>'Please be reminded that the course \'[COURSE_NAME]\' closes on [CLOSING_DATE].
Please click this link to complete the course now: [COURSE_URL]',
                'default'=>'Please be reminded that the course \'[COURSE_NAME]\' closes on [CLOSING_DATE].
Please click this link to complete the course now: [COURSE_URL]',
                'placeholders'=>'
                <ul>
                <li>[COURSE_NAME] : The name of the course</li>
                <li>[COURSE_URL] : The course URL</li>
                <li>[CLOSING_DATE] : The closing date for the course</li>
                 <li>[NUMBER_OF_DAYS] : The number of days remaining till the closing date e.g. 1,2,3</li>
                <li>[DAY_TEXT] : The \'day\' text. Defaults to \'day\' if [NUMBER_OF_DAYS] is 1 and \'days\' if greater than 1.</li>

                </ul>
                '
            ],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
