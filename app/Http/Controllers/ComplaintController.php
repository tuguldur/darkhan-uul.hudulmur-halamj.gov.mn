<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class ComplaintController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function deleteComplaintByID() {
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedComplaintID'])) {
            return "You have provided wrong Complaint ID!";
        }

        if ($postData['dataSwitch'] != 'DCDE2239') {
            return "You have made wrong action!";
        }

        $selectedComplaintID = $postData['selectedComplaintID'];

        $this->dbMan->where("id", $selectedComplaintID);
        if ($this->dbMan->delete('complaint')) {
            return "yes";
        } else {
            return "no";
        }
    }

    public function insertComplaintFormData(Request $request) {
        $backStatus = "success";

        if (!$request->isMethod("POST") || empty($request->get('contactPersonRegister')) || empty($request->get('contactPersonName')) || empty($request->get('contactPersonText'))) {
            session()->flash('contact_form_fail', "Буруу үйлдэ эсвэл хоосон мэдээлэл хийгдсэн байна!.");
            return Redirect::back();
        }

        /*
        if (intval($request->get('captchaResult')) !== (intval($request->get('firstNumber')) + intval($request->get('secondNumber')))) {
            session()->flash('contact_form_fail', 'Таны зурвас нэмэгдээгүй учир нь түлхүүр тоонуудыг нийлбэр буруу байна !.');
            return Redirect::back();
        }
        */
        
        if (strlen($request->get('contactPersonRegister')) != 12) {
            session()->flash('contact_form_fail', 'Таны регистр дугаар буруу байна !.');
            return Redirect::back();
        }
        
        $complaintIdentifierHash = sha256(rand(5, 5000) . rand(9000, 90000) . rand(1, 50000));

        $data = Array(
            'complaint_identifier' => $complaintIdentifierHash,
            'name' => $request->get('contactPersonName'),
            'person_register' => $request->get('contactPersonRegister'),
            'email' => $request->get('contactPersonEmail'),
            'complain' => $request->get('contactPersonText'),
            'last_name' => '',
            'phone' => $request->get('contactPersonPhone'),
            'submitted_date' => $this->dbMan->now(),
            'registered_at' => $this->dbMan->now()
        );

        $new_complaint_id = $this->dbMan->insert('complaint', $data);

        if ($new_complaint_id) {
            $backStatus = "success";
            $this->copyNewComplaintToUnitedComplaints($data);
        } else {
            $backStatus = "fail";
        }

        if ($backStatus == "success") {
            session()->flash('contact_form_success', 'text');
            MailController::sendComplaintEmailToStaffMail($data['name'], $data['email'], $data['phone'], $data['complain']);
        } else {
            session()->flash('contact_form_fail', 'Таны илгээсэн санал, хүсэлт, гомдлыг хүлээн авах үед алдаа гарсан.');
        }
        return Redirect::back();
    }

    private function copyNewComplaintToUnitedComplaints($data) {
        $backData = "";
        $unitedComplaintsDbMan = new MysqliDb(null, null, null, 'halamjgo_united', 3306, 'utf8');
        $data['organization_id'] = config("user_config.ORG_INDEX");
        $new_united_complaint_id = $unitedComplaintsDbMan->insert('complaints', $data);

        if ($new_united_complaint_id) {
            $backData = "санал, гомдол, хүсэлтийн нэгдсэн санд энэ зурвас нэмэгдсэн.";
        } else {
            $backData = "санал, гомдол, хүсэлтийн нэгдсэн санд энэ зурвас нэмэгдээгүй.";
        }
        return $backData;
    }

    public function actionComplaintManagerDAO(Request $request) {
        $backData = "";
        $backStatus = "";

        if (!$request->isMethod("POST")) {
            return "Complaint manager save method was wrong!";
        }

        if (empty($request->get('complaintActionTypeHidden'))) {
            return "Complaint manager save method was wrong!";
        }

        if ($request->get('complaintActionTypeHidden') == 'create') {
            $backData .= "мэргэжилтэн санал, гомдол, хүсэлт удирдлагын хэсгээс үүсгэж болохгүй.";
            $backStatus = "fail";
        } elseif ($request->get('complaintActionTypeHidden') == 'edit') {
            $data = Array(
                'name' => $request->get('complaintPersonName'),
                'email' => $request->get('complaintPersonEmail'),
                'complain' => $request->get('complaintText'),
                'phone' => $request->get('complaintPersonPhone'),
                'is_seen' => 1,
                'complain_type' => $request->get('complaintType')
            );

            $this->dbMan->where('id', $request->get('complaintID'));
            //$this->dbMan->where("lang_iso_code", Config::get("uj_config.current_app_lang"));
            if ($this->dbMan->update('complaint', $data)) {
                $backData .= "Санал, гомдол, хүсэлт амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData .= "Санал, гомдол, хүсэлт хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($request->get('complaintActionTypeHidden') == 'delete') {
            
        }

        if ($backStatus == "success") {
            MailController::sendComplaintEmailToStaffMail($request->get('complaintPersonName'), $request->get('complaintPersonEmail'), $request->get('complaintPersonPhone'), $request->get('complaintText'));
            session()->flash('contact_form_success', $backData);
        } else {
            session()->flash('contact_form_fail', $backData);
        }
        return Redirect::back();
    }

    public function loadComplaintDetailsByID() {
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedComplaintID'])) {
            return "You have provided wrong Complaint ID!";
        }

        $selectedComplaintID = $postData['selectedComplaintID'];
        $this->dbMan->where("id", $selectedComplaintID);
        $complaint = $this->dbMan->getOne('complaint');
        //$countRecords = $this->dbMan->count;

        if (empty($complaint)) {
            return array();
        } else {
            return json_encode($complaint);
        }
    }

    public function getComplaintsRequestsTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $this->dbMan->orderBy("submitted_date", "DESC");
        //$this->dbMan->orderBy("registered_at", "DESC");
        $complaints = $this->dbMan->get('complaint');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatableComplaints' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>утас</th>
                            <th>харсан</th>
                            <th>ирсэн хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $complaintId = $complaints[$i]['id'];
            $complaintName = $complaints[$i]['name'];
            $complaintRegister = $complaints[$i]['person_register'];
            $complaintPhone = $complaints[$i]['phone'];
            $complaintSeen = $complaints[$i]['is_seen'];
            $complaintDate = $complaints[$i]['submitted_date'];
            if ($complaintSeen == 1) {
                $complaintSeen = "<span class='label label-success'>шалгасан</span>";
            } else {
                $complaintSeen = "<span class='label label-warning'>шалгаагүй</span>";
            }
            $backData .= "<tr>
                            <td>{$complaintId}</td>
                            <td>{$complaintName} - {$complaintRegister}</td>
                            <td>{$complaintPhone}</td>
                            <td>{$complaintSeen}</td>
                            <td>{$complaintDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-complaintid='{$complaintId}' data-useraction='view' onclick='viewThisComplaint(this);'><a>харах</a></li>
                                        <li data-complaintid='{$complaintId}' data-useraction='delete' onclick='deleteThisComplaint(this);'><a>устгах</a></li>
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

}
