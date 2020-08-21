<?php
    session_start();
    include 'bootcss.php';
    include_once 'navbar.php';
    include 'connection.php';

//if loged in then go to account else go to login
    if(!empty($_SESSION['ses_email']) ){
        $email = $_SESSION['ses_email'];
        $sql= "SELECT * FROM USER_DATA WHERE EMAIL= '$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount()>0){
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                if(empty($_REQUEST['edit']) && empty($_REQUEST['submitFile']) && empty($_REQUEST['editComment']) ){
?>

<form action="" method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2 col-md-6 offset-md-3">
                
                <div class="bg-warning  rounded">
                    <div class="container text-center">
                        <br>
                        <h4>Account</h4>
                        <div class="row">
                            <div class="col-8 offset-2">     
                                <div class="card" style="width: 100%;">
                                    <div class="image-fluid">
                                    <?php if(!empty($result['USER_IMAGE'])){?>
                                        <img src="/assignment/profile_pic/<?php echo $result['USER_IMAGE']?>" class="card-img-top" alt="Profile Picture">
                                    <?php } else {?>
                                        <img src="https://cdn.onlinewebfonts.com/svg/img_569205.png" class="card-img-top" alt="Profile Picture">
                                    <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php
                                                echo $_SESSION['first_name']." ".$_SESSION['last_name'];
                                            ?>
                                        </h5>

                                        <?php if(!empty($result['USER_BIO'])){?>
                                            <p class="card-text"><?php echo $result['USER_BIO']; ?></p>
                                        <?php } else {?>
                                            <p class="card-text">Edit Your Biodata</p>
                                        <?php }?>

                                    </div>
                                    <ul class="list-group list-group-flush">

                                        <?php if(!empty($result['PHONE'])){?>
                                            <li class="list-group-item"><?php echo $result['PHONE']; ?></li>
                                        <?php } else {?>
                                            <li class="list-group-item">Phone No</li>
                                        <?php }?>

                                        <?php if(!empty($result['DOB'])){?>
                                            <li class="list-group-item"><?php echo $result['DOB']; ?></li>
                                        <?php } else {?>
                                            <li class="list-group-item">Date Of Birth</li>
                                        <?php } ?>
                                    </ul>
                                    <div class="form-group">
                                        <div class="card-body">
                                            <button type="submit" name="edit" value="1" class="btn btn-info">Edit</button>
                                            <button type="submit" name="post_comment" value="postComment" class="btn btn-info">Post Comment</button>
                                            <button type="submit" name="timeline" value="timeline" class="btn btn-info">Timeline</button>
                                            <button type="submit" name="delete" value="1" class="btn btn-info">Delete Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            <br>

                <div class="bg-info rounded">
                    <div class="container text-center">
                        <h4>Recent Posts</h4>
                        <div class="form-group">
<?php
                            $sql1 = "SELECT * FROM POST WHERE EMAIL='$email' ORDER BY TIME_DATE DESC";
                            $stmt1 = $conn->prepare($sql1);
                            $stmt1->execute();
                            while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="media">
                                <div class="media-left">
                                    <img src="/assignment/profile_pic/<?php echo $result['USER_IMAGE']?>" class="media-object" style="width:100px">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $result['NAME']?></h4>
                                    <p><?php echo $result['COMMENT']?></p>
                                        <button class="rounded" name="editComment" value="<?php echo $result['ID']; ?>" style='font-size:100%;color:green'>Edit <i class='fas fa-edit'></i></button>
                                        <button class="rounded" name="deleteComment" onclick="return confirm('Do you want to DELETE the post? ');" value="<?php echo $result['ID']; ?>" style='font-size:100%;color:red'>Delete <i class='fas fa-trash'></i></button>
                                    <hr>
                                </div>
                            </div>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 
<!-- Account info displaying end -->

<?php } if(!empty($_REQUEST['edit'])){ ?>
<!-- edit section start-->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 offset-2 col-md-6 offset-md-3">
                        <div class="bg-warning">
                            <div class="container text-center">
                                <br>
                                <div class="container">
                                <h5>Update Your Profile</h5>
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-6 text-center">
                                                <input type="file" name="uploadfile" id="" required>
                                            </div>
                                        </div>
                                        <div>
                                            <input class="form-control" type="number" name="ph_no" id="" placeholder="Phone No" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="date" name="date" placeholder="Date of Birth" id="" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea placeholder="Write About Yourself..." name="bio_data" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="2"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- Edit section End -->

<?php
                }
            } 
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('You don't have account. Sign Up now.');";
            echo "window.location='signup.php';";
            echo "</script>";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('You Are Loged Out.Log In Again.');";
        echo "window.location='login.php';";
        echo "</script>";
    }
// Image uploading/updating Section
    /* if(!empty($_REQUEST['submitFile'])){
        $filename = $_FILES["uploadfile"]["name"];
        $_SESSION['ses_img'] = $filename;
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = 'profile_pic/'.$filename;
        move_uploaded_file($tempname,$folder);
    } */
//data updating section
    if(!empty($_REQUEST['save']) && !empty($_SESSION['ses_email'])) {
        //file update start
        $filename = $_FILES["uploadfile"]["name"];
        $_SESSION['ses_img'] = $filename;
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = 'profile_pic/'.$filename;
        move_uploaded_file($tempname,$folder);
        //file update end

        $email = $_SESSION['ses_email'];
        $img_name = $_SESSION['ses_img'];
        $ph = $_REQUEST['ph_no'];
        $dob = $_REQUEST['date'];
        $bio = $_REQUEST['bio_data'];
        
        $sql= "UPDATE USER_DATA SET PHONE='$ph',DOB ='$dob',USER_BIO = '$bio',USER_IMAGE = '$img_name' where EMAIL ='$email' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
            echo "<script type='text/javascript'> alert('Successfully Updated.');
            window.location='account.php';
            </script>";
        } else {
            echo "Update Failed";
        }
    } else {
        if(empty($_SESSION['ses_email'])){
            header('location:login.php');
        } else {
            $_REQUEST['edit'] =1;
        }
    }
?>
<!-- Account delete Section     -->
<script>
    function myFunction() {
    var txt;
    var c = confirm("Do you want to DELETE your account ??");
    alert(c);
        // if (cofirmation==false) {
        //     txt = "Account does not deleted.";
        // } else {
        //     <?php
        //         $sql1= "DELETE FROM USER_DATA WHERE EMAIL='$email' ";
        //         $stmt1 = $conn->prepare($sql1);
        //         //$stmt1->execute();
        //         session_unset();
        //         session_destroy();
        //     ?>
        //     txt = "Account deleted successfully.";
        // }
    //alert(txt);
    //window.location='account.php';
    }
</script>
        
<?php
    if(!empty($_REQUEST['delete'])){
        $sql1= "DELETE FROM USER_DATA WHERE EMAIL='$email' ";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        session_unset();
        session_destroy();
    }

    if(!empty($_REQUEST['post_comment'])){
        echo "<script type='text/javascript'>";
        echo "window.location='postcomment.php';";
        echo "</script>";
    }

    if(!empty($_REQUEST['editComment']) || !empty($_REQUEST['submitUpdatedComment']) ){
        
        if(!empty($_REQUEST['editComment'])){
            $_SESSION['ses_id'] = $_REQUEST['editComment'];
            $id = $_SESSION['ses_id'];
        } else {
            $id = $_SESSION['ses_id'];
        }
        $sql2 = "SELECT * FROM POST WHERE ID='$id' ";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();

        if($stmt2->rowCount()>0 && empty($_REQUEST['submitUpdatedComment'])){
            while($result = $stmt2->fetch(PDO::FETCH_ASSOC)){
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
                                        <textarea name="updateComment" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="4"><?php echo $result['COMMENT']; ?></textarea>
                                    </div>
                                <div class="text-center">
                                    <button type="submit" value="submit" name="submitUpdatedComment" class="btn btn-success">Update</button>
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
        }

        if(!empty($_REQUEST['submitUpdatedComment'])){
            $comment = $_REQUEST['updateComment'];
            $sql2 = "UPDATE POST SET COMMENT='$comment' WHERE ID='$id' ";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();
            $row = $stmt2->rowCount();
            //unset($_SESSION['ses_id']);
// problem with javascript alert
            if($stmt2->rowCount()==1){
                echo "<script type='text/javascript'>
                    alert('Comment updated.');
                    </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Comment Update Failed.');
                    <script>";
            }
        }
    }

    if(!empty($_REQUEST['timeline'])){
        echo "<script type='text/javascript'>";
        echo "window.location='index.php';";
        echo "</script>";
    }

    if(!empty($_REQUEST['deleteComment'])){
        $id=$_REQUEST['deleteComment'];
        echo $id;
        $sql1= "DELETE FROM POST WHERE ID='$id'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $sql3= "DELETE FROM COMMENT_REPLY WHERE PARENT_ID='$id'";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute();
    }
    
    include 'bootjs.php';

?>


