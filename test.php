<?php
session_start();
    echo "<pre>";
    print_r($_SESSION);
    print_r($_REQUEST);
?>

<?php
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

            $sql1 = "SELECT * FROM POST ORDER BY TIME_DATE DESC";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute();
            while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="media container">
                <div class="media-left">
                    <img src="/assignment/profile_pic/<?php echo $result['USER_IMAGE']?>" class="media-object" style="width:100px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $result['NAME']?></h4>
                    <div class="media-right">
                        <small class="media-heading">Posted On: <?php echo $result['TIME_DATE']?></small>
                    </div>
                    <p><?php echo $result['COMMENT']?></p>
                    <div class="row form-froup">
                        <textarea placeholder="Reply here..." name="postReply" class=" col-10 form-control rounded" id="exampleFormControlTextarea1" rows="1"></textarea>
                        <a href="" class="col-2">
                            <i class='fas fa-arrow-circle-right'name="reply" value="reply" style='font-size:35px;color:blue'></i>
                        </a>
                    </div>
                    <hr>
                </div>
            </div>

    <?php } ?>

        </div>
    </div>

</div>

<!-- Nested media object -->
<div class="media">
        <div class="media-left">
          <img src="img_avatar2.png" class="media-object" style="width:45px">
        </div>
        <div class="media-body">
          <h4 class="media-heading">John Doe <small><i>Posted on February 19, 2016</i></small></h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

</body>
</html>

<?php
    include 'bootjs.php';
?>