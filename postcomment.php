<?php
session_start();
    require "bootcss.php";
    require "connection.php";
    global $profile_pic;
    if(!empty($_SESSION["ses_email"])){
?>
<div class="text-center">
    <h2>Post What's On Your Mind</h2>
</div>
    <form action="" method="post">
    <div class="container-fluid">
      <div class="row">
          <div class="col-8 offset-2 col-md-6 offset-md-3">
              <div class="bg-warning">
                  <div class="container">
                      <br>
                        <div class="form-group">
                            <textarea placeholder="Write a comment..." name="postComment" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                      <div class="text-center">
                          <button type="submit" value="submit" name="submitComment" class="btn btn-primary">Submit</button>
                          <button type="submit" name="timeline" value="timeline" class="btn btn-primary">Timeline</button>
                      </div>
                      
                      <br>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </form>

<?php
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('You have to log in first.');";
        echo "window.location='login.php';";
        echo "</script>";
    }

    if(!empty($_REQUEST['submitComment'])){
        
    $name = $_SESSION['first_name']." ".$_SESSION['last_name'];
    $email = $_SESSION['ses_email'];
    $comment = $_REQUEST['postComment'];
    $now = date("Y-m-d h:i:sa");
    // echo $now;
    // echo $name;
    // echo $email;
    // echo $comment;
    $sql1 = "SELECT * FROM USER_DATA WHERE EMAIL='$email'";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    if($stmt1->rowCount()>0){
        while ($result1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $profile_pic = $result1['USER_IMAGE'];
        }
    }
        $sql = "INSERT INTO POST (EMAIL,NAME,TIME_DATE,COMMENT,USER_IMAGE) VALUES ('$email','$name','$now','$comment','$profile_pic')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
            echo "<script type='text/javascript'>";
            echo "alert('Successfully Posted.');";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('Failed to Post.');";
            echo "</script>";
        }
    }
    
    if(!empty($_REQUEST['timeline'])){
        echo "<script type='text/javascript'>";
        echo "window.location='index.php';";
        echo "</script>";
    }
    require "bootjs.php";
?>
 