<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\MysqliDb;
use Illuminate\Support\Facades\Redirect;
use DateTime;

class EventController extends Controller {

    //
    private $dbMan = null;
    private $monthNamesMN = array(
        "Jan" => "1-р сар",
        "Feb" => "2-р сар",
        "Mar" => "3-р сар",
        "Apr" => "4-р сар",
        "May" => "5-р сар",
        "Jun" => "6-р сар",
        "Jul" => "7-р сар",
        "Aug" => "8-р сар",
        "Sep" => "9-р сар",
        "Oct" => "10-р сар",
        "Nov" => "11-р сар",
        "Dec" => "12-р сар"
    );

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function getEventOgTags($eventID) {
        $backData = "";
        if (empty($eventID)) {
            return "Event Id was wrong...";
        }

        $this->dbMan->where("id", $eventID);
        $this->dbMan->where("event_active", 1);
        $event = $this->dbMan->getOne('events');

        if (!empty($event)) {
            $backData .= "<meta property='og:url'                content='" . url("event/" . $event['id']) . "' />";
            $backData .= "<meta property='og:type'               content='мэдээ, мэдээлэл' />";
            $backData .= "<meta property='og:title'              content='" . $event['event_title'] . "' />";
            $backData .= "<meta property='og:description'        content='" . $event['event_title'] . "' />";
            $backData .= "<meta property='og:image'              content='" . asset("uploads/event/covers/" . $event["event_cover_img"]) . "' />";
        }

        return $backData;
    }

    public function getReadEventDetails($eventID) {
        $backData = "";

        if (empty($eventID)) {
            return "Event Id was wrong...";
        }

        $this->dbMan->where("id", $eventID);
        $this->dbMan->where("event_active", 1);
        $event = $this->dbMan->getOne('events');
        //$countRecords = $this->dbMan->count;

        if (empty($event)) {
            $backData = "<div class='basic-info'>
                        <div class='inner-box'>
                            <div class='lower-content'>
                                <div class='upper-box'>
                                    <div class='row clearfix'>
                                        <div class='column col-md-12 col-sm-12 col-xs-12'>
                                            Энэ үйл ажиллагааны мэдээлэл байхгүй эсвэл идэвхгүй байна.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            return $backData;
        }

        //$eventDatetime = new DateTime();

        $eventDate = strtotime($event['event_date']);
        $eventMonthText = date("M", $eventDate);
        $eventDayText = date("j", $eventDate);
        $newEventDate = date("Y-m-d", $eventDate);
        $eventTimeStarts = $event['event_time_starts'];
        $eventTimeEnds = $event['event_time_ends'];

        if (!empty($eventTimeStarts) && (strlen($eventTimeStarts) > 5)) {
            $eventTimeStarts = substr($eventTimeStarts, 0, 5);
        }

        if (!empty($eventTimeEnds) && (strlen($eventTimeEnds) > 5)) {
            $eventTimeEnds = substr($eventTimeEnds, 0, 5);
        }

        $eventCoverImage = $event['event_cover_img'];
        $backData = "<div class='basic-info'>
                        <div class='inner-box'>
                            <div class='image'>
                                <img src='" . config('path_config.APP_PATH') . "/uploads/event/covers/{$eventCoverImage}' alt='{$event['event_title']}' title='{$event['event_title']}'>
                            </div>
                            <div class='lower-content'>
                                <div class='upper-box'>
                                    <div class='row clearfix'>
                                        <div class='column col-md-8 col-sm-12 col-xs-12'>
                                            <!--Event Block-->
                                            <div class='event-block'>
                                                <div class='inner-box'>
                                                    <div class='date-box'>
                                                        {$eventDayText} <span>{$this->monthNamesMN[$eventMonthText]}</span>
                                                        
                                                    </div>
                                                    <h3>{$event['event_title']}</h3>
                                                    <ul class='event-info'>
                                                        <li><span class='icon fa fa-clock-o'></span>{$newEventDate} өдөр {$eventTimeStarts} - {$eventTimeEnds}</li>
                                                        <li><span class='icon fa fa-map-marker'></span>{$event['event_location']}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='social-column col-md-4 col-sm-12 col-xs-12'>
                                            <ul class='social-icon-three'>
                                                <li><strong>Facebook дээр түгээх:</strong></li>
                                                <li><a href='https://www.facebook.com/sharer/sharer.php?u=" . url("/event/" . $eventID) . "' target='_blank'><span class='fa fa-facebook'></span></a></li>
                                                <!-- <li><a href='#'><span class='fa fa-twitter'></span></a></li> -->
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='more-info'>
                        <div class='text'>
                            {$event['event_content']}
                        </div>
                    </div>

                    <div class='info-boxed'>
                        <h3>холбоо барих</h3>
                        <div class='row clearfix'>
                            <!--Info Block-->
                            <div class='info-block col-lg-4 col-md-6 col-sm-6 col-xs-12'>
                                <div class='inner-box'>
                                    <div class='icon-box'><span class='flaticon-home-1'></span></div>
                                    <div class='text'>{$event['event_location']}</div>
                                </div>
                            </div>
                            <!--Info Block-->
                            <div class='info-block col-lg-4 col-md-6 col-sm-6 col-xs-12'>
                                <div class='inner-box'>
                                    <div class='icon-box'><span class='flaticon-technology-4'></span></div>
                                    <div class='text'>{$event['event_phones']}</div>
                                </div>
                            </div>
                            <!--Info Block-->
                            <div class='info-block col-lg-4 col-md-6 col-sm-6 col-xs-12'>
                                <div class='inner-box'>
                                    <div class='icon-box'><span class='flaticon-envelope-1'></span></div>
                                    <div class='text'>{$event['event_emails']}</div>
                                </div>
                            </div>
                        </div>
                    </div>";

        return $backData;
    }

    public function deleteEventByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedEventID'])) {
            return "You have provided wrong event ID!";
        }

        if ($postData['dataSwitch'] != 'DEDC6617') {
            return "You have made wrong action!";
        }

        $selectedEventId = $postData['selectedEventID'];
        $this->dbMan->where("id", $selectedEventId);
        $columns = array("event_cover_img");
        $event = $this->dbMan->getOne('events', $columns);

        if (!empty($event)) {
            ToolsController::deleteOldCoverImageOfEvent($event['event_cover_img']);
        }

        $this->dbMan->where("id", $selectedEventId);
        if ($this->dbMan->delete('events')) {
            return "yes";
        } else {
            return "no";
        }
    }

    public function loadEventDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedEventID'])) {
            return "You have provided wrong event ID!";
        }

        $selectedEventId = $postData['selectedEventID'];
        $this->dbMan->where("id", $selectedEventId);
        $events = $this->dbMan->getOne('events');
        //$countRecords = $this->dbMan->count;

        if (empty($events)) {
            return "null";
        } else {
            return json_encode($events);
        }
    }

    public function getEventsTableHTML() {
        $backData = "";

        $this->dbMan->orderBy('event_date', 'DESC');
        $events = $this->dbMan->get('events');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>зураг</th>
                            <th>төлөв</th>
                            <th>хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $eventId = $events[$i]['id'];
            $eventTitle = $events[$i]['event_title'];
            $eventActive = $events[$i]['event_active'];
            $eventDate = $events[$i]['event_date'];
            $eventCoverImage = $events[$i]['event_cover_img'];
            $eventActive = ($eventActive == 1) ? "идэвхтэй" : "идэвхгүй";
            $backData .= "<tr>
                            <td>{$eventId}</td>
                            <td><a href='" . url("event/" . $eventId) . "' target='_blank'>{$eventTitle}</a></td>
                            <td><img src='" . config('path_config.APP_PATH') . "/uploads/event/covers/{$eventCoverImage}' style='width:50px;' /></td>
                            <td>{$eventActive}</td>
                            <td>{$eventDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-eventid='{$eventId}' data-useraction='edit' onclick='editThisEvent(this);'><a>засах</a></li>
                                        <li data-eventid='{$eventId}' data-useraction='delete' onclick='deleteThisEvent(this);'><a>устгах</a></li>
                                        <li data-eventid='{$eventId}' data-useraction='view' onclick='viewThisEvent(this);'><a>харах</a></li>
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

    public function actionEventManagerDAO(Request $request) {
        $postData = $_POST;

        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['eventManagerSaveBtn'])) {
            return "Event manager save method was wrong!";
        }

        if ($postData['eventActionTypeHidden'] == 'create') {
            $eventCoverNewFilename = "no_image.jpg";

            if ($request->hasFile('eventCoverImageFile')) {
                $eventCoverNewFilename = ToolsController::uplaodCoverImageOfEvent($_FILES['eventCoverImageFile']);
            }

            $data = Array(
                'event_title' => $postData['eventTitle'],
                'event_content' => $postData['eventContent'],
                'event_location' => $postData['eventLocation'],
                'event_phones' => $postData['eventPhones'],
                'event_emails' => $postData['eventEmail'],
                'event_active' => $postData['eventStatus'],
                'event_date' => $postData['eventDateTime'],
                'event_time_starts' => $postData['eventStartTime'],
                'event_time_ends' => $postData['eventEndTime'],
                'event_registered' => $this->dbMan->now(),
                'event_updated' => $this->dbMan->now()
            );

            if ($request->hasFile('eventCoverImageFile')) {
                $data['event_cover_img'] = $eventCoverNewFilename;
            }

            $new_event_id = $this->dbMan->insert('events', $data);

            if ($new_event_id) {
                $backData .= $new_event_id . ' дугаартай үйл ажиллагаа нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул холбоос нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['eventActionTypeHidden'] == 'edit') {
            $eventCoverNewFilename = "no_image.jpg";

            if ($request->hasFile('eventCoverImageFile')) {
                $backData .= ToolsController::deleteOldCoverImageOfEvent($postData['eventCoverImageNameHidden']);
                $eventCoverNewFilename = ToolsController::uplaodCoverImageOfEvent($_FILES['eventCoverImageFile']);
            }

            $data = Array(
                'event_title' => $postData['eventTitle'],
                'event_content' => $postData['eventContent'],
                'event_location' => $postData['eventLocation'],
                'event_phones' => $postData['eventPhones'],
                'event_emails' => $postData['eventEmail'],
                'event_active' => $postData['eventStatus'],
                'event_date' => $postData['eventDateTime'],
                'event_time_starts' => $postData['eventStartTime'],
                'event_time_ends' => $postData['eventEndTime'],
                'event_updated' => $this->dbMan->now()
            );

            if ($request->hasFile('eventCoverImageFile')) {
                $data['event_cover_img'] = $eventCoverNewFilename;
            }

            $this->dbMan->where('id', $postData['eventActionCodeHidden']);

            if ($this->dbMan->update('events', $data)) {
                $backData = "Үйл ажиллагаа амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Үйл ажиллагаа хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['eventActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getLastThreeEvents() {
        $backData = "";

        $this->dbMan->orderBy("event_date", "DESC");
        $this->dbMan->where("event_active", 1);
        $events = $this->dbMan->get('events');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $eventID = $events[$i]['id'];
            $eventTitle = $events[$i]['event_title'];
            //$eventContent = $events[$i]['event_content'];
            //$eventDate = $events[$i]['event_date'];
            $eventDate = strtotime($events[$i]['event_date']);
            $eventMonthText = date("M", $eventDate);
            $eventDayText = date("j", $eventDate);
            $eventLocation = $events[$i]['event_location'];
            $eventTimeStarts = $events[$i]['event_time_starts'];
            $eventTimeEnds = $events[$i]['event_time_ends'];

            if (!empty($eventTimeStarts) && (strlen($eventTimeStarts) > 5)) {
                $eventTimeStarts = substr($eventTimeStarts, 0, 5);
            }

            if (!empty($eventTimeEnds) && (strlen($eventTimeEnds) > 5)) {
                $eventTimeEnds = substr($eventTimeEnds, 0, 5);
            }

            $backData .= "<div class='event-block'>
                <div class='inner-box'>
                    <div class='content'>
                        <div class='date-box'>
                            {$eventDayText} <span> {$this->monthNamesMN[$eventMonthText]} </span>
                        </div>
                        <h3><a href='" . config('path_config.APP_PATH') . "/event/{$eventID}/'>{$eventTitle}</a></h3>
                        <ul class='event-info'>
                            <li title='Үйл ажиллагаа болох цаг'><span class='icon fa fa-clock-o'></span>{$eventTimeStarts} - {$eventTimeEnds}</li>
                            <li><span class='icon fa fa-map-marker'></span>{$eventLocation}</li>
                        </ul>
                    </div>
                </div>
            </div>";

            $i++;
        }

        return $backData;
    }

    public function getUpcomingEvents() {
        $backData = "";

        //$this->dbMan->where("id", $postSlugDetailView);
        $this->dbMan->orderBy("event_date", "DESC");
        $this->dbMan->where("event_active", 1);
        $events = $this->dbMan->get('events');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $eventID = $events[$i]['id'];
            $eventTitle = $events[$i]['event_title'];
            //$eventContent = $events[$i]['event_content'];
            $eventDate = $events[$i]['event_date'];
            $eventLocation = $events[$i]['event_location'];

            $backData .= "<article class='event-post'>
                <div class='date-box'>" . ToolsController::getDayName($eventDate) . " <span>" . ToolsController::getMonthName($eventDate) . "</span></div>
                <div class='text'><a href='" . config('path_config.APP_PATH') . "/event/{$eventID}/'>{$eventTitle}</a></div>
                <div class='event-location'>{$eventLocation}</div>
            </article>";

            $i++;
        }

        return $backData;
    }

}
