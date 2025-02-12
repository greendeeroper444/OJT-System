<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class emailController extends Controller
{
    private $mail;


    public function __construct()
    {

        require ROOT . '/public/PHPMailer/src/Exception.php';
        require ROOT . '/public/PHPMailer/src/PHPMailer.php';
        require ROOT . '/public/PHPMailer/src/SMTP.php';


        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = 1; // Enable verbose debug output
        $this->mail->isSMTP(); // Send using SMTP
        $this->mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        $this->mail->Username = 'ortega.iancezar@dnsc.edu.ph';
        $this->mail->Password = 'wsjcaelcxaptxzvj';
        $this->mail->SMTPSecure = 'ssl'; // Enable implicit TLS encryption
        $this->mail->Port = 465; // TCP port to connect to
    }

    public function sendEmail($emailData)
    {


        extract($emailData);

        $emailBody  = $this->bodyText($emailData);

        if ($userType == 'client') {
            try {
                // logic in sending email to admin
                $this->mail->setFrom($email, "Requestor");
                $this->mail->addAddress(PIO_EMAIL);
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $emailBody;
                $this->mail->send();
            } catch (Exception $e) {
                $message = "Failed to process request";
            }
        } else {
            try {
                $this->mail->setFrom('ortega.iancezar@dnsc.edu.ph', 'DNSC PIO Office');
                $this->mail->addAddress($email);
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $emailBody;
                $this->mail->send();
            } catch (Exception $e) {
                $message = "Failed to process request";
            }
        }
    }


    public function bodyText($emailData)
    {
        extract($emailData);



        //Adding request   
        if ($statusText == 'Add Request') {

            if ($type == "PIO" || $type == "PHOTO") {
                $emailBody = <<<EOT
                            A new request has been submitted by a $recipient for the event $activityName.

                            Please review the details of the request below:
                            Request ID: $userID
                            Event Name: $activityName
                            Event Date: $activityDuration
                            Submitted On: $Submitted
                            Status: Pending
                            
                            Thank you for your attention to this matter.
                            
                        EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }

            if ($type == "POSTING") {
                $emailBody = <<<EOT
                        A new request has been submitted by a $recipient for the POSTING titled $postTitle.

                        Please review the details of the request below:
                        Request ID: $userID
                        Submitted On: $Submitted
                        Status: Pending
                        
                        Thank you for your attention to this matter.
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }
        }

        //Admin approve request   
        if ($statusText == 'Approved') {

            if ($type == "PIO" || $type == "PHOTO") {
                $emailBody = <<<EOT
                    Dear $recipient,
                    
                    We hope this email finds you well.
                    
                    We are writing to inform you that your request submitted on $requestCreated has been Approved. Below are the details of your request:
                    
                    Request ID: $reqId
                    Event Name: $eventName
                    Event Date: $eventDuration
                    Submitted On: $requestCreated
                    Status: Approved
                                
                    Thank you for using our PReS Public Information Office Request Management System. We appreciate your patience and cooperation.
                    
                    Best regards,
                    
                    DNSC PIO
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }

            if ($type == "POSTING") {
                $emailBody = <<<EOT
                Dear $recipient,

                DNSC PIO has approved the Posting Information.
                
                Please find the details of the approved request below:
                Request ID: $reqId
                Posting title: $title
                Submitted On: $requestCreated
                Status: Approved
                
                Thank you for your attention to this matter.
                
                Best regards,
                DNSC PIO
                EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }
        }

        //Admin upload output 
        if ($statusText == 'Completed') {
            $emailBody = <<<EOT
                    Dear $recipient,
                    
                    We hope this email finds you well.
                    
                    We are writing to inform you that your request submitted on $requestCreated has been Completed. Below are the details of your request:
                    
                    Request ID: $reqId
                    Event Name: $eventName
                    Event Date: $eventDuration
                    Submitted On: $requestCreated
                    Status: Completed
                                
                    Thank you for using our PReS Public Information Office Request Management System. We appreciate your patience and cooperation.
                    
                    Best regards,
                    
                    DNSC PIO
                EOT;

            $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
            $emailBody = nl2br($emailBody);
        }



        //Admin Complete output 
        if ($statusText == 'File Uploaded') {


            if ($userType == "client") {
                $emailBody = <<<EOT
                                     
                    We would like to inform you that the output for a request has been uploaded. Below are the request information:
                    
                    Request ID: $reqId
                    Title: $title
                    Submitted On: $requestCreated
                    Status: Pending
                    
                    Best regards,
                    
                    DNSC PIO
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }

            if ($userType == "admin") {
                $emailBody = <<<EOT
                    Dear $recipient,
                    
                    We hope this email finds you well.
                    
                    We are pleased to inform you that the output for your request has been successfully uploaded. Below are the details of your request:
                    
                    Request ID: $reqId
                    Event Name: $eventName
                    Event Date: $eventDuration
                    Submitted On: $requestCreated
                    Status: Approved
                    
                    You can access the uploaded output by logging into your account and navigating to the corresponding request page. If you encounter any issues or need further assistance, please feel free to contact us.
            
                    Please be reminded that the output is subject to your review and approval. We appreciate your patience and cooperation.
            
                    Thank you for using our PReS Public Information Office Request Management System. We appreciate your patience and cooperation.
                    
                    Best regards,
                    
                    DNSC PIO
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }
        }

        //Requestor request for revision
        if ($statusText == 'Revision request') {

            if ($userType == "client") {
                $emailBody = <<<EOT
                    $recipient wants some revisions to the output request for the event $eventName.

                    Please review the updated details of the request below:
                    Request ID:  $reqId
                    Event Name: $eventName
                    Event Date:  $eventDuration

                    Status: Approved
                    
                    Thank you for your attention to this matter.
                EOT;
                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }

            if ($userType == "admin") {
                $emailBody = <<<EOT
                        Dear $recipient,

                        DNSC PIO wants some revisions to the posting request $title.
                        
                        Please review the updated details of the request below:
                        Request ID: $reqId
                        Posting Title: $title
                        Submitted On: $requestCreated
                        Status: Pending
                        
                        Thank you for your attention to this matter.
                        
                        Best regards,
                        DNSC PIO
                EOT;
                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }
        }

        //Requestor Edited Request
        if ($statusText == 'Request Edited') {

            if ($type == "PIO" || $type == "PHOTO") {
                $emailBody = <<<EOT
                    $recipient  has made revisions to the request for the event $activityName.

                    Please review the UPDATED details of the request below:
                    Request ID: $reqId
                    Event Name: $activityName
                    Event Date: $eventDuration 
                    Updated On: $updateOn
                    Status: Pending
                                    
                    OLD request details:
                    Request ID: $reqId
                    Event Name: $oldEventName
                    Event Date: $oldDate
                    Status: Pending
                            
                    Thank you for your attention to this matter.
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }

            if ($type == "POSTING") {
                $emailBody = <<<EOT
                    $recipient  has made revisions for the PHOTO request $title

                        Please review the UPDATED details of the request below:
                        Request ID: $reqId
                        Event Name: $title
                        Updated On: $updateOn
                        Status: Pending
                                        
                        OLD request details:
                        Request ID: $reqId
                        Event Name: $oldTitle
            
                        Status: Pending
                                
                        Thank you for your attention to this matter.
                    EOT;

                $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
                $emailBody = nl2br($emailBody);
            }
        }

        #Requestor approved request
        if ($statusText == 'Request Approved') {

            $emailBody = <<<EOT
                    $recipient has approved the output for the event $eventName.

                    Please find the details of the approved request below:
                    Request ID: $reqId
                    Event Name: $eventName
                    Event Date: $eventDuration 
                    Submitted On: $requestCreated
                    Status: Approved
                    
                    Thank you for your attention to this matter.
                EOT;

            $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
            $emailBody = nl2br($emailBody);
        }



        #Admin approved user
        if ($statusText == 'Approve user') {

            $emailBody = <<<EOT
                Dear $recipient,

                We are pleased to inform you that your user account has been approved by the administrator.
                
                You can now access the full features of our PReS Public Information Office Request Management System.
                
                Thank you for choosing our services.
                
                Best regards,
                DNSC PIO
                EOT;

            $emailBody = '<div style="color: black;">' . $emailBody . '</div>';
            $emailBody = nl2br($emailBody);
        }







        return $emailBody;
    }
}
