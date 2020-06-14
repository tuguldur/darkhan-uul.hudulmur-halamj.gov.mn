<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Transport\MailgunTransport;

class MailController extends Controller {

    //

    public static function sendComplaintEmailToStaffMail($personName, $personEmail, $personPhone, $personMessage) {
        $emailBody = "";
        $EmailTo = "";
        
        $organiztionEmails = config("user_config.ORG_EMAILS");

        if (empty($organiztionEmails)) {
            $EmailTo = "info@hudulmur-halamj.gov.mn";
        } else {
            $EmailTo = $organiztionEmails[0];
        }
        
        $Subject = config("user_config.WEB_SITE_TITLE") . " - " . " шинэ э-мэйл иргэнээс хүлээж авлаа";

        $emailBody .= "Иргэний нэр: ";
        $emailBody .= $personName;
        $emailBody .= "\n";

        $emailBody .= "Иргэний э-мэйл: ";
        $emailBody .= $personEmail;
        $emailBody .= "\n";

        $emailBody .= "Иргэний утас: ";
        $emailBody .= $personPhone;
        $emailBody .= "\n";

        $emailBody .= "Иргэний захиа: ";
        $emailBody .= $personMessage;
        $emailBody .= "\n";
        
        $success = mail($EmailTo, $Subject, $emailBody, "From:" . $personEmail);

        if ($success) {
            echo "success";
        } else {
            echo "invalid";
        }
    }

    public function sendTestEmail(Request $request) {
        $mgClient = new Mailgun('key-ad051ee77c02a06edf7e708cdcccf14c');
        $domain = "sandboxb95dcd2d86d4499aac95a20a44951950.mailgun.org";

        # Make the call to the client.
        $result = $mgClient->sendMessage("$domain", array('from' => 'Mailgun Sandbox <postmaster@sandboxb95dcd2d86d4499aac95a20a44951950.mailgun.org>',
            'to' => 'xxueg_mmt <xxuegsoftware@gmail.com>',
            'subject' => 'Hello xxueg_mmt',
            'text' => 'Congratulations xxueg_mmt, you just sent an email with Mailgun!  You are truly awesome! '));
        echo($result);
        /*
          $message = "hello, all";
          Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message) {
          $message->subject('Mailgun and Laravel are awesome!');
          $message->from('no-reply@mailgun.com', 'Website Name');
          $message->to('delgerdev@gmail.com');
          });
          echo("Message was sent successfully.");
         */
    }

}
