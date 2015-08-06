<?php
    $con = mysqli_connect("localhost", "root","pass","articlegame");
    session_start();
    $name = $_SESSION['name'];
    $sql = mysqli_query($con,"SELECT * FROM users WHERE name='$name'");
    while($row = mysqli_fetch_array($sql)){
        $first = $row['firstname'];
        $last = $row['lastname'];
    }
?>
<html>
<head>
   <title>A.G.E Admin Portal</title> 

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    
</head>
<body>
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
    
    <nav class="navbar navbar-default" >
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
                    <li class="nav-item-active">
                        <a>Home</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a>News</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a>Reviews</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a>Videos</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a>Podcast</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a>Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    
    
    </nav>
    
    <!--End of the navigation template for index.php-->
    
    <?php

        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $content2 = $_POST['content2'];
            $content3 = $_POST['content3'];
            $content4 = $_POST['content4'];
            
            $category = $_POST['category'];
            $type = $_POST['type'];
            $firstimgcap = $_POST['image2cap'];
            $secondimgcap = $_POST['image3cap'];
            
            $thumbnail = $_FILES['image1']['tmp_name'];
            $firstimg = $_FILES['image2']['tmp_name'];
            $secondimg = $_FILES['image3']['tmp_name'];
            

            $creator = $first . " " . $last;
            if(!isset($thumbnail) || !isset($firstimg) ||!isset($secondimg)){
                echo "File upload failed";
            }else{
                $image = addslashes (file_get_contents($_FILES['image1']['tmp_name']));
                $image_name = addslashes ($_FILES['image1']['name']);
                $image_size = getimagesize($_FILES['image1']['tmp_name']);

                $image2 = addslashes (file_get_contents($_FILES['image2']['tmp_name']));
                $image_name2 = addslashes ($_FILES['image2']['name']);

                $image3 = addslashes (file_get_contents($_FILES['image3']['tmp_name']));
                $image_name3 = addslashes ($_FILES['image3']['name']);


                if($image_size == FALSE){
                    echo "That is not an image";
                }else{
                    
                    mysqli_query($con, 
                            "INSERT INTO articledata (title, content, content2, content3, content4, creator, category, image1, image2, image3, image2cap, image3cap, type)
                            VALUE('$title', '$content', '$content2', '$content3', '$content4', '$creator', '$category','$image',
                            '$image2','$image3','$firstimgcap','$secondimgcap','$type')"
                    )or die(mysqli_error($con));
                    
                    
                    mysqli_query($con,
                        "UPDATE users 
                        SET postcount = postcount + 1
                        WHERE name = '".$name."'
                    ");
                    
                    echo "Article has been posted! Click <a href = 'post.php'> here</a> to submit more or <a href='admin.php'>go back</a> ";
                }
            }



        }else{

    ?>
    <section class="content">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="post.php" method="post" enctype="multipart/form-data">

                            <legend>New article</legend>
                            <div class="col-lg-12">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <p><label class="field">Title: </label><input type="text" name="title" /></p><br />
                                </div>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-md-12">
                                    <p><label class="field">Content1: </label><textarea class="post-input-box-content" name="content" ></textarea></p><br />
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        First Image: <input type="file" name="image2" /><br />
                                        <p style="text-align:left;"><label class="field">First image caption: </label><input type="text" name="image2cap" /></p><br />
                                    </div>
                                    <div class="col-lg-6">
                                        <p><label class="field">Content2: </label><textarea class="post-input-box-content" name="content2" ></textarea></p><br />
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <p><label class="field">Content3: </label><textarea class="post-input-box-content" name="content3" ></textarea></p><br />
                                    </div>
                                    <div class="col-lg-6">
                                        Second Image: <input type="file" name="image3" /><br />
                                        <p style="text-align:left;"><label class="field" >Second image caption: </label><input type="text" name="image3cap" /></p><br />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p><label class="field">Content4: </label><textarea class="post-input-box-content" name="content4" ></textarea></p><br />
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-6" style="text-align:left">
                                    Category: <select name="category">
                                                <option value="Xbox">Xbox</option>
                                                <option value="Xbox 360">Xbox 360</option>
                                                <option value="Xbox One">Xbox One</option>
                                    
                                                <option value="Playstation">Playstation</option>
                                                <option value="PS2">PS2</option>
                                                <option value="PS3">PS3</option>
                                                <option value="PS4">PS4</option>
                                                <option value="PSP">PSP</option>
                                                <option value="PS vita">PS vita</option>
                                    
                                                <option value="Nintendo">Nintendo</option>
                                                <option value="Wii">Wii</option>
                                                <option value="DS">DS</option>                                    
                                                <option value="3DS">3DS</option>                                    
                                                <option value="2DS">2DS</option>
                                    
                                                <option value="PC">PC</option>
                                    
                                                <option value="Mobile">Mobile</option>                                    
                                    
                                                <option value="Indie">Indie</option>                                    
                                                <option value="General">General</option>
                                    
                                                </select><br />
                                    Type: <select name="type">
                                                <option value="News">News</option>
                                                <option value="Review">Review</option>
                
                                    
                                                </select><br />
                                </div>
                                <div class="col-md-3"></div>
                                
                                <div class="col-md-3">Thumbnail: <input type="file" name="image1" /><br /></div>
                                <div class="col-md-6" style="text-align:right">
                                    <input type="submit" name="submit" value="Post!" />
                                </div>
                                <div class="col-md-3">

                                </div>
                                                                    
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
                    <?php
                        }
                    ?>

</body>
</html>