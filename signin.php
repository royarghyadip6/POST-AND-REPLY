<?php
session_start();
include 'bootcss.php';
include_once 'navbar.php';
include 'connection.php';


if(empty($_SESSION['ses_email']) && empty($_SESSION['ses_password'])){
    if(!empty($_REQUEST['submit'])){
    //Database details
        $db_host = "localhost";
        $db_name = "USER_DB";
        $db_user = "root";
        $db_password = "";

    //signup.html form output
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $cpassword = $_REQUEST['c_password'];
       
    // Random TOKEN generation
        $token = bin2hex(random_bytes(30));

    // Both Password Match Then 
        if($password === $cpassword){

            // CHECKING FOR EXISTING EMAIL
            $sql_query1= "SELECT * FROM USER_DATA WHERE EMAIL=':email'";
            $stmt1 = $conn->prepare($sql_query1);
            $stmt1->bindParam(':email',$email);
            $stmt1->execute();
            $out = $stmt1->rowCount();
            //IF OUT=0 THEN MAIL DOES NOT EXIST THEN GOES FOR NEXT CONDITION
            //IF OUT=1 THEN MAIL EXIST THEN ELSE PART WILL RUN

            if($out === 0){
                //IF MAIL DOES NOT EXIST THEN NEW DATA OF SIGN UP FORM WILL BE INSERTED
                $sql_query2 = "INSERT INTO USER_DATA (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD,TOKEN,STATUS) VALUE (:firstname,:lastname,:email,:password,:token,'inactive')";
                $stmt2 = $conn->prepare($sql_query2);
                $stmt2->bindParam(':firstname',$firstname);
                $stmt2->bindParam(':lastname',$lastname);
                $stmt2->bindParam(':email',$email);
                $stmt2->bindParam(':password',$password);
                $stmt2->bindParam(':token',$token);
                $stmt2->execute();
                $out1 = $stmt2->rowCount();
                // IF OUT1 =1 THEN DATA INSERTED SUCCESSFULLY
                // IF OUT1 =0 THEN DATA INSERTION FAILED
                if($out1 === 1){
                    $to_mail = $email;
                    $subject = "Email Verification Link";
                    $body = "Hi $firstname, verification link of your account is http://localhost/abc/verify.php?token=".$token;
                    $headers= 'From:abc';

                    if(mail($to_mail,$subject,$body,$headers)){
                        echo "Email Successfully Sent To ".$to_mail;
                    } else{
                        echo "Email Sending Failed To ".$to_mail;
                    }
                }
            } else {
                //IF MAIL EXIST THEN HAVE TO CREATE NEW ACCOUNT
                echo "Account Exists. Create new account.";
            }
        } else {
            // IF PASSWORD DOES NOT MATCH THEN THIS PART WILL RUN
            echo "Password Does Not Match.";
        }
    /* 
        function sent_link($email,$firstname,$token){
            $to_mail = $email;
            $subject = "Email Verification Link";
            $body = "Hi $firstname, verification link of your account is <br>http://localhost/abc/verify.php?token=".$token;
            $headers= 'From:abc';

            if(mail($to_mail,$subject,$body,$headers)){
                echo "Email Successfully Sent To ".$to_mail;
            } else{
                echo "Email Sending Failed To ".$to_mail;
            }
        } */
        // $_SESSION['email'] = 'abc';
        // echo $_SESSION['email'];
    }
} else { 

?>
    <script>
        location.replace("account.php");
    </script>

<?php
    }
?>

<?php
    if(empty($_REQUEST['submit'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Navbar CSS CDN Start-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Navbar CSS CDN End-->
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
</head>
<body>
        <?php include_once 'navbar.php'; ?>

    <div class="container-fluid bg-success text-center a-margin">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card a-padding" >
                    <form action="" method="POST" >
                    <h1>
                        Create an Account
                    </h1>
                    <p>Sign up with your social media account or email address</p>
                    <div class="form-row">
                        <div class="col-3"></div>
                        <a href="http://facebook.com" class="col-2 btn btn-light " ><img src="/abc/Image/Facebook_icon.png" height="20px" alt="facebook"></a>
                        <a href="https://twitter.com" class="col-2 btn btn-light "><img src="/abc/Image/twitter.png" height="20px" alt="twitter"></a>
                        <a href="https://www.instagram.com/?hl=en" class="col-2 btn btn-light "><img src="/abc/Image/instagram_PNG10.png" height="20px" alt="instagram"></a>
                        <div class="col-3"></div>
                    </div>
                        <div class="container">
                        <div class="dropdown-divider"></div>
                            <div class="form-group row">
                                <div class="col-6 text-center">
                                    <input id="fname" class="text-center form-control" type="text" placeholder="FIRST NAME" name="firstname" required><br>
                                </div>
                                <div class="col-6 text-center">
                                    <input id="lname" class="text-center form-control" type="text" placeholder="LAST NAME" name="lastname" required><br>
                                </div>
                            </div>
                            <input id="email" class="text-center form-control" type="email" placeholder="MAIL ID" name="email" required><br>
                            <input id="pass" class="text-center form-control" type="password" placeholder="PASSWORD" name="password" required><br>
                            <input id="c_pass" class="text-center form-control" type="password" placeholder="CONFIRM PASSWORD" name="c_password" required><br><br>
                            <button class="btn btn-primary" type="submit" name="submit" value="submit">Sign Up</button>
                        </div>
                    </form>
                    <br>
                    <p>Already have an Account? <b><a href="login.php">Log In</a></b></p>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

</body>
</html>

<?php
    }
    include 'bootjs.php';
?>
