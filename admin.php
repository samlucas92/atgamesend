<?php
    $con = mysqli_connect("localhost", "root","pass","articlegame");
    session_start();
    
?>
<html>
<head>
    <title>A.G.E Admin Portal</title> 
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,100italic,100' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body background="img/kindajean.png">
    <div class="container admin-menu">
        <div class="admin-menu-echo">
            <?php
                if(isset($_SESSION['name'])){

                    echo "Hello, ", $_SESSION['name'], ", welcome to the A.G.E administrator portal!";
                    $name = $_SESSION['name'];              
                    $sql = mysqli_query($con,"SELECT * FROM users WHERE name='$name'");
                    while($row = mysqli_fetch_array($sql)){

                        $name = $row['name'];
                        $password = $row['password'];
                        $first = $row['firstname'];
                        $last = $row['lastname'];
                        $postcount = $row['postcount'];
                        $pic = $row['pic'];


            ?>
            <?php
                $postsatus;
                if($postcount == 0){
                    $poststatus = "You must be new around here!";
                }else if($postcount == 1){
                    $poststatus = "Congratulations on your first post!";
                }else if($postcount < 10){
                    $poststatus = "Already a pro journalist? That was easy.";
                }else if($postcount < 25){
                    $poststatus = "Wow, thats more than Chris Ramsell";
                }else if($postcount < 50){
                    $poststatus = "No one can accuse you of lack of commitment";
                }else if($postcount < 100){
                    $poststatus = "Repetitive Strain Injury anyone?";
                }else if($postcount < 150){
                    $poststatus = "Better order another takeaway";
                }else if($postcount > 150){
                    $poststatus = "At Games End legend! You have done us proud!";
                }
            ?>
        </div>
    
        <div class="container">
            <div class="col-lg-12 admin-menu-content">
                <div class="container">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <img src="img/age.png" width="250" height="200">
                        </div>
                        <div class="col-md-8">
                            <table style="margin-top:3%">

                            <tr><td class="title">You are logged in as&nbsp;<?php echo $first," ", $last, " "; ?></td></tr>
                            <tr><td colspan="1" style="padding-top:10px;">You have made:&nbsp;<?php echo $postcount; ?>&nbsp;posts so far!</td>
                            <td rowspan="4" style="text-align:right;"><?php echo '<img src="data:image/jpeg;base64,' .base64_encode( $pic ) . '" width ="100" height = "100" />';?>
                            </td></tr>
                            <tr><td colspan="1" ><?php echo "Commitment status:" ?></td></tr>
                            <tr><td colspan="1" ><?php echo $poststatus ?></td></tr>

                            </table>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="col-lg-12">
                        <div class="col-md-4 admin-menu-items">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="post.php"><img src="img/archive44.png"></a>
                                </div>
                                <div class="panel-footer"><label>New article</label></div>
                            </div>
                        </div>

                        <div class="col-md-4 admin-menu-items">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="edit.php"><img src="img/edit26.png"></a> 
                                </div>
                                <div class="panel-footer"><label>Edit article</label></div>
                            </div>
                        </div>

                        <div class="col-md-4 admin-menu-items">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="logout.php"><img src="img/door9.png"></a> 
                                </div>
                                <div class="panel-footer"><label>logout</label></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
         
        }else{
            echo '<a href="login.php">Login</a>' ," to view this page";
        }
    ?>
</body>
</html>