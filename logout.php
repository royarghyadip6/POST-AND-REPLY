<?php
    session_start();

    if(empty($_SESSION['ses_email'])){
        echo '<script type="text/javascript">'; 
        echo 'alert("You Are Already Loged Out. Log In Again To Visit Your Account.");'; 
        echo 'window.location= "login.php";';
        echo '</script>'; 
    } else {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
?>