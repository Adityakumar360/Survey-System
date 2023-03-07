<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

class user
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // User Information Which Are Active
    public function activeuserinfo()
    {
        return $result = $this->conn->query("SELECT * FROM users WHERE `status`='Active'");

    }

    // Login Credientials
    public function get_mail_login($email)
    {
        try {
            $mailresult = $this->conn->query("SELECT user_email FROM users WHERE user_email='$email'");
            $res = mysqli_num_rows($mailresult);

            if ($res > 0) {
                return $mailresult;
            } else {
                throw new Exception("<div class='mydiv alert alert-warning' role='alert'>
            <b>Email Not Registered!</b>
            </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Login Succesfull
    public function login_successfull($email, $pass)
    {
        try {
            $result = $this->conn->query("SELECT * FROM users WHERE user_email='$email' AND `password`='$pass'");
            $num = mysqli_fetch_assoc($result);

          

            if ($num > 0) {

                $_SESSION['id'] = $num['user_id'];
                $_SESSION['user_mail'] = $num['user_email'];
                $_SESSION['user_name'] = $num['user_name'];
                $_SESSION['user_contactno'] = $num['Phone_No'];
                $_SESSION['user_gender'] = $num['Gender'];
                $_SESSION['user_type'] = $num['Type'];
                $_SESSION["logged_in"] = true; 

                $_SESSION['msg'] = "Logged In Successfully !";

                // header('Location:../dashboard.php');
                return $num;
            } else {
                throw new Exception("<div class='mydiv alert alert-danger' role='alert'>
                <b>Invalid Password. Please try again!</b>
                </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // User Credentials
    public function get_mail_user($email)
    {
        $mailresult = $this->conn->query("SELECT user_email FROM users WHERE user_email='$email'");
        $num = mysqli_fetch_array($mailresult);
        $mail = $num['user_email'] ?? null;
        if ($email == $mail) {
            $_SESSION['usermailmsg'] = 'Email Already Exist';
        } else {
            return $mailresult;
        }
    }

    // Creating New User
    public function set_user($category, $name, $gender, $email, $phone)
    {
        function password_generate($chars)
        {
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            return substr(str_shuffle($data), 0, $chars);
        }
        $pass = password_generate(7);

        $message = "Your Login Credientials Are as follow:<br>
        Username=$email<br>
        Password=$pass";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'adityakumar.king9120@gmail.com'; //SMTP username
            $mail->Password = 'evhquyqavgpyvpet'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('adityakumar@gmail.com');
            $mail->addAddress($email); //Reciever's email

            $mail->isHTML(true);
            $mail->Subject = 'Regarding Login Credentials.';
            $mail->Body = @$message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $pass = sha1(trim($pass));

        $userresult = $this->conn->query("INSERT INTO `users` (`Type`, `user_id`, `user_name`, `Gender`, `user_email`, `password`, `Phone_No`,`status`) VALUES ('$category', NULL, '$name','$gender', '$email', '$pass', '$phone','Active')");
        if ($userresult) {

            $_SESSION['usermsg'] = "User Added Successfully !";
            return $userresult;
            header("Location:../user/user.php");
        } else {
            $_SESSION['usernotmsg'] = "Unable To Add User !";
        }
    }

    // User Information with respect to their id
    public function fetch_data_id($user_id)
    {
        return $result = $this->conn->query("SELECT * FROM users WHERE `user_id`='$user_id'");
    }

    // Updating User
    public function update_info($user_id, $category, $name, $email, $gender, $phone)
    {
        $result = $this->conn->query("UPDATE `users` SET `Type`='$category',`user_name`='$name',`user_email`='$email',`Gender`='$gender',`Phone_No`='$phone'  WHERE `user_id`='$user_id'");
        if ($result) {
            $_SESSION['userupdatemsg'] = "User Information Successfully Updated!";
            echo "<script>
            window.location.href='userlist.php';
            </script>";
            return $result;
        } else {
            echo "<script>alert('Failed to updated Data ')</script>";
        }
    }

    // User Deletion
    public function delete_user($user_id)
    {
        return $result = $this->conn->query("UPDATE `users` SET `status`='Inactive' WHERE `user_id`='$user_id'");
         
    }

    // Access Password
    public function get_pass($email, $pass)
    {
        $result = $this->conn->query("SELECT `password` FROM users WHERE user_email='$email'");
        $arr = mysqli_fetch_array($result);
        $oldpass = $arr['password'];
        if ($oldpass == $pass) {
            return $result;
        } else {
            $_SESSION['wrongpassmsg'] = 'Incorrect Old Password';
            header("location:../user/profile.php");
        }
    }

    // Change Password
    public function change_pass($email, $pass)
    {
        $result = $this->conn->query("UPDATE `users` SET `password`='$pass' WHERE user_email='$email'");
        if ($result) {
            $_SESSION['passmsg'] = 'Password Changed Successfully';
            header("location:../user/profile.php");
            return $result;
        } else {
            echo "<script>alert('Failed to updated Password ');
            window.location.href='../user/profile.php';
            </script>";
        }
    }

    // Update profile
    public function update_profile($user_id, $name, $email, $contact_no)
    {
        $result = $this->conn->query("UPDATE `users` SET `user_name`='$name' , `user_email`='$email',`Phone_No`='$contact_no' WHERE `user_id`='$user_id'");
        if ($result) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_mail'] = $email;
            $_SESSION['user_contactno'] = $contact_no;

            $_SESSION['profilemsg'] = 'Details Updated Successfully ';
            echo "<script>location = location.href;</script>";
            return $result;
        } else {
            echo "Unsuccessfull to update profile";
        }
    }
}
?>