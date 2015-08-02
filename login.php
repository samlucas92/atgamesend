<?php
    $con = mysqli_connect("localhost", "root","pass","articlegame");
?>
<html>
<head>
    <title>A.G.E Login</title> 
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,100italic,100' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body background="img/kindajean.png">
    <section class="content" style="padding-top:200px;">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">

                    <?php
                        if(isset($_POST['submit'])){
                            $name = $_POST['name'];
                            $pass = $_POST['password'];
                            $result = mysqli_query($con, "SELECT * FROM users WHERE name ='$name' AND password='$pass'");
                            $num = mysqli_num_rows($result);
                            if (!$result) {
                                die(mysqli_error($con)); 
                                echo "Bad Connection";
                            }else if($num == 0){
                               echo "Wrong user name or password entered!"; 
                            }else{
                                session_start();
                                $_SESSION['name'] = $name;
                                header("Location: admin.php");
                            }
                        }else{
                    ?>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <form action="login.php" method="post" class="login-form">

                            <div class="login-input-box" >
                                <img src="img/age.png" height="200" width="200" style="margin-bottom:10%">
                                Username: <input type="text" name="name" /><br />
                                Password: <input type="password" name="password" /><br />
                                <input type="submit" name="submit" value="Login!" class="login-input-button" />
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <?php
                        }
                    ?>
        </div>
        <div class="col-lg-2">
        </div>
    </section>
</body>
</html>