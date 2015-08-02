<?php
    $con = mysqli_connect("localhost", "root","pass","articlegame");
    session_start();

?>

<html>

<head>
    <title>At Games End</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,100italic,100' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    
</head>
    
<body>
    <?php
        $var_value = $_GET['id'];
    ?> 
    <div class="container" >
        <div class="col-md-2">
            <img src="img/age.png" height="150" width="200">
        </div>
        <div class="col-md-2" style="line-height:100px">
        </div>
        <div class="col-md-2" style="line-height:100px">

        </div>
        <div class="col-md-2" style="line-height:100px">

        </div>
        <div class="col-md-2" style="line-height:100px">

        </div>
        <div class="col-md-1" style="line-height:100px">
            
        </div>
        <div class="col-md-1" style="line-height:100px">
            
        </div>


    </div>
    
    <nav class="navbar navbar-default">
        <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item hvr-underline-reveal ">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="nav-item-active">
                        <a href="news.php">News</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="#videos">Videos</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="podcast">Podcast</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    
    
    </nav>
    
    <!--End of the navigation template for index.php-->
    
    <?php

                    
    $sql = mysqli_query($con,"SELECT * FROM articledata WHERE id='$var_value'");
    while($row = mysqli_fetch_array($sql)){
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $content2 = $row['content2'];
        $content3 = $row['content3'];
        $content4 = $row['content4'];
        
        $image2 = $row['image2'];
        $image3 = $row['image3'];
        $image2cap = $row['image2cap'];
        $image3cap = $row['image3cap'];
        
        $category = $row['category'];
        $creator = $row['creator'];
        $datetime = strtotime($row['timestamp']);
        $date = date('d-m-Y',$datetime);
        $time = date('Gi.s',$datetime);


    ?>
    <section class="content">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <h3><?php echo $title; ?></h3>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-md-12">
                            <p><?php echo $content; ?></p>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $image2 ) . '" width ="500" height = "400" />';?>
                                <p><?php echo $image2cap; ?></p>
                            </div>
                            <div class="col-lg-6">
                                <p><?php echo $content2; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <p><?php echo $content3; ?></p>
                            </div>
                            <div class="col-lg-6">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $image3 ) . '" width ="500" height = "400" />';?>
                                <p><?php echo $image3cap; ?></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p><?php echo $content4; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>

</body>

</html>