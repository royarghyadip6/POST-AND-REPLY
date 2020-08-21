<?php
    session_start();
    include 'bootcss.php';
    include_once 'navbar.php';
    include 'connection.php';
    if(empty($_SESSION['ses_email'])){
//if section will run after submitting the login form
        if(!empty($_REQUEST["submitLogIn"])){

            // echo "<pre>";
            // print_r($_SESSION);
            $sql = "SELECT * FROM USER_DATA";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount()>0){
                while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                    if( ($_REQUEST['email']=== $row['EMAIL']) && ($_REQUEST['password']===$row['PASSWORD'])){
                        $_SESSION['first_name']=$row['FIRST_NAME'];
                        $_SESSION['last_name']=$row['LAST_NAME'];
                        $_SESSION['ses_email'] = $row['EMAIL'];
                        $_SESSION['ses_password'] = $row['PASSWORD'];
                        $_SESSION['ses_img'] = $row['USER_IMAGE'];
                        header('Location:account.php');
                    break;
                    } else {
                        header('Location:forget.php');
                    }
                }
            }

//else part will run login html page
        } else {
?>
<div class="text-center">
    <h1>Log In Form</h1>
</div>
<form action="" method="post">
  <div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-2 col-md-6 offset-md-3">
            <div class="bg-warning">
                <div class="container">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email" placeholder="Enter email id" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" value="submit" name="submitLogIn" class="btn btn-primary">Submit</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
  </div>
</form>

<?php
        }
    } else {
        header('Location:account.php');
    }
    include 'bootjs.php';
?>

