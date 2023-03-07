<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

class invite
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // Email Validation
    public function get_email($email, $survey_id)
    {

        $result = $this->conn->query("SELECT invitation_email FROM `invitation` WHERE invitation_email='$email' AND `Survey_id`='$survey_id'");
        $num = mysqli_fetch_array($result);
        $mail = $num['invitation_email'] ?? null;
        if ($email == $mail) {
            $_SESSION['invitemailmsg'] = 'This User has already Opted the survey!!';
            return true;
        } else {
            return false;
        }
    }

    // Insertion
    public function set_invitation_data($survey_id, $invitedby, $name, $message, $em)
    {
        $invite_key = md5($em . time());

        $url = "192.168.1.99/survey/viewsurvey.php?sid=$survey_id&invite_key=$invite_key";
        $link = "<a href='$url'>Click Here To Fill this Survey</a>";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';                                         //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                                //Enable SMTP authentication
            $mail->Username = 'adityakumar.king9120@gmail.com';                   //SMTP username
            $mail->Password = 'evhquyqavgpyvpet';                                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                    //Enable implicit TLS encryption
            $mail->Port = 465;                                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('from@example.com');
            $mail->addAddress($em); //Reciever's email

            $mail->isHTML(true);
            $mail->Subject = 'Regarding the Feedback about the product.';
            $mail->Body = @$message . " " . $link;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $result = $this->conn->query("INSERT INTO `invitation`(`Survey_id`, `Invited_by`, `Invitation_to`, `message`, `invitation_email`,`invitation_key`,`status`) VALUES ('$survey_id','$invitedby','$name','$message','$em','$invite_key','invited')");

        if ($result) {
            $_SESSION['invite_msg'] = "Succesfully invited!!";
        }
    }

    // Invited User Info
    public function invited_user_info($invitekey)
    {
        $result = $this->conn->query("SELECT Invitation_to,invitation_email,`status` FROM `invitation` WHERE invitation_key='$invitekey'");
        return $arr = mysqli_fetch_assoc($result);
    }
}