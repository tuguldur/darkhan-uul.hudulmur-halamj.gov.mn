<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;
use App\Http\Controllers\ToolsController;

class CalendarController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function loadCalendarEventDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedCalEventID'])) {
            return "You have provided wrong calendar event ID!";
        }

        $selectedCalendarEventId = $postData['selectedCalEventID'];
        $this->dbMan->where("id", $selectedCalendarEventId);
        $calendarEvent = $this->dbMan->getOne('calendar_dates');
        //$countRecords = $this->dbMan->count;

        if (empty($calendarEvent)) {
            return "{}";
        } else {
            return json_encode($calendarEvent);
        }
    }

    public function actionCalendarEventManagerDAO() {
        $postData = $_POST;

        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['calEventManagerSaveBtn'])) {
            return "Calendar event manager save method was wrong!";
        }

        if ($postData['calEventActionTypeHidden'] == 'create') {
            $data = Array(
                'cal_title' => $postData['calEventTitle'],
                'cal_date' => $postData['calEventDate'],
                'cal_url' => $postData['calEventURL'],
                'cal_type' => $postData['calEventType'],
                'cal_active' => $postData['calEventActiveStatus'],
                'cal_registered' => $this->dbMan->now()
            );

            $new_calendar_event_id = $this->dbMan->insert('calendar_dates', $data);

            if ($new_calendar_event_id) {
                $backData .= $new_calendar_event_id . ' дугаартай календар мэдээлэл нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул холбоос нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['calEventActionTypeHidden'] == 'edit') {

            $data = Array(
                'cal_title' => $postData['calEventTitle'],
                'cal_date' => $postData['calEventDate'],
                'cal_url' => $postData['calEventURL'],
                'cal_type' => $postData['calEventType'],
                'cal_active' => $postData['calEventActiveStatus']
            );

            $this->dbMan->where('id', $postData['calEventActionCodeHidden']);

            if ($this->dbMan->update('calendar_dates', $data)) {
                $backData = "Календар мэдээлэл амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Календар мэдээлэл хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['calEventActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getCalendarEventsTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $albumImages = $this->dbMan->get('calendar_dates');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>хугацаа</th>
                            <th>URL</th>
                            <th>төрөл</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $calEventId = $albumImages[$i]['id'];
            $calEventTitle = $albumImages[$i]['cal_title'];
            $calEventDate = $albumImages[$i]['cal_date'];
            $calEventURL = $albumImages[$i]['cal_url'];
            $calEventType = $albumImages[$i]['cal_type'];
            $calEventActive = $albumImages[$i]['cal_active'];

            $backData .= "<tr>
                            <td>{$calEventId}</td>
                            <td>{$calEventTitle}</td>
                            <td>{$calEventDate}</td>
                            <td><a href='{$calEventURL}' target='blank'>{$calEventURL}</a></td>
                            <td>{$calEventType}</td>
                            <td>{$calEventActive}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-caleventid='{$calEventId}' data-useraction='edit' onclick='editThisCalendarEvent(this);'><a>засах</a></li>
                                        <li data-caleventid='{$calEventId}' data-useraction='delete' onclick='deleteThisCalendarEvent(this);'><a>устгах</a></li>
                                        <li data-caleventid='{$calEventId}' data-useraction='view' onclick='viewThisCalendarEvent(this);'><a>харах</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>";
            $i++;
        }

        $backData .= "</tbody>
                </table>";

        return $backData;
    }

    public function loadCalendarDatesInJSON() {
        $this->dbMan->where("event_active", 1);
        $events = $this->dbMan->get('events');
        //$countRecords = $this->dbMan->count;

        $calendarEvents = array();
        foreach ($events as $key => $event) {
            $calendarId = $event['id'];
            $calendarDate = date('Y-m-d', strtotime($event['event_date']));

            $perEventData = array();
            $perEventData['number'] = 1;
            $perEventData['url'] = "/event/{$calendarId}/";

            $calendarEvents[$calendarDate] = $perEventData;
        }
        
        return json_encode($calendarEvents);
    }

}
