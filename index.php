<?php
    session_start();
    include 'bootcss.php';
    include_once 'navbar.php';
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    
<div class="container">
    <div class="container-fluid text-center">
        <br>
        <h2 class="text-center">RECENT POSTS</h2>
        <br>
        <div style="background-color:#36d8d0;" class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

    <?php
        //if(empty($_SESSION['ses_email'])){
            $sql1 = "SELECT * FROM POST ORDER BY TIME_DATE DESC";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute();
            while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="media container">
                <div class="media-left">
                    <img src="/assignment/profile_pic/<?php echo $result['USER_IMAGE']?>" class="media-object" style="width:50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $result['NAME']?></h4>
                    <div class="media-right">
                        <small class="media-heading">Posted On: <?php echo $result['TIME_DATE']?></small>
                    </div>
                    <p><?php echo $result['COMMENT']?></p>
                    <?php
                        $id = $result['ID'];
                        $sql2 = "SELECT * FROM COMMENT_REPLY WHERE PARENT_ID = '$id' ";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->execute();

                        if($stmt2->rowCount()>0){
                            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <!-- Nested media object -->
                            <br>
                            <div class="media">
                                <div class="media-left">
                                    <img src="/assignment/profile_pic/<?php echo $row['IMAGE']?>" class="media-object" style="width:45px">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $row['NAME']; ?> <small><i>Posted on: <?php echo $row['DATE_TIME']; ?></i></small></h4>
                                    <p><?php echo $row['COMMENT'];?></p>
                                </div>
                            </div>
                        <?php
                            }
                        }
                    ?>
                    <form action="" method="post">
                        <div class="row form-group">
                            <textarea placeholder="Reply here..." name="postComment" class=" col-10 form-control rounded" id="exampleFormControlTextarea1" rows="1"></textarea>
                            
                            <button class="rounded" name="submitReply" value="<?php echo $result['ID']; ?>" style='font-size:100%;color:blue'><i class='fas fa-arrow-circle-right' style='font-size:35px;'></i></button>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
            

    <?php } ?>

        </div>
    </div>

</div>

</body>
</html>

<?php
//}
    // echo $_REQUEST['postComment'];
    // echo $_REQUEST['submitReply'];
    
    if(!empty($_REQUEST['postComment']) && !empty($_REQUEST['submitReply'])){
        if(!empty($_SESSION['ses_email'])){
            $id1 = $_REQUEST['submitReply'];
            $name = $_SESSION['first_name']." ".$_SESSION['last_name'];
            $comment = $_REQUEST['postComment'];
            $now = date("Y-m-d h:i:sa");
            $image = $_SESSION['ses_img'];
            $sql3 ="INSERT INTO COMMENT_REPLY (PARENT_ID,NAME,COMMENT,DATE_TIME,IMAGE) VALUES('$id1','$name','$comment','$now','$image') ";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->execute();
            if($stmt3->rowCount()>0){
                echo "<script type='text/javascript'>";
                echo "alert('Comment Posted.');";
                echo "window.location='index.php';";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('Failed to Comment.');";
                echo "window.location='index.php';";
                echo "</script>";
            }
        } else {
        echo "<script type='text/javascript'>";
        echo "alert('You are a GUEST. To comment you have to log in.');";
        echo "window.location='login.php';";
        echo "</script>";
        }
    }
    include 'bootjs.php';
?>