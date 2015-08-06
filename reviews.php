<?php
    if(isset($_GET['category'])){
        $cat_value = $_GET['category'];
        
    }else{
        $cat_value = "general";
    }
    $con = mysqli_connect("localhost", "root","pass","articlegame");
    session_start();
    $type = "type='review'";

    $page_sql = "SELECT COUNT(id) FROM articledata WHERE $type";
    $page_query = mysqli_query($con,$page_sql);
    $row = mysqli_fetch_row($page_query);

    $rows = $row[0];
    $page_rows = 10;
    $last = ceil($rows/$page_rows);
    $older = '';
    $newer = '';
    $older_page ='';
    $new_page = '';

    if($last < 1){
        $last = 1;
    }

    $pagenum = 1;

    if(isset($_GET['pn'])){
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);

    }
    if($pagenum < 1){
        $pagenum = 1;    
    }else if($pagenum>$last){
        $pagenum = $last;
    }
    $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows .',' .$page_rows;
    $sql = "SELECT * FROM articledata ORDER BY id DESC $limit";

    $page_query2 = mysqli_query($con,$sql);

    $pagetext = "Page <b>$pagenum<b> of <b>$last<b>";

    //render the target page number
    $paginationCtrls = ''.$pagenum.' &nbsp; ';
    //render clickable links that appear on the left of target number
    if($last != 1){
            if($pagenum > 1){
                $previous = $pagenum -1;
                $new_page = ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?category='.$cat_value.'&pn='.$previous.'">Newer articles <span aria-hidden="true">&rarr;</span> ';

            }

        //render the target page number
        $paginationCtrls .= ''.$pagenum.' &nbsp; ';
        //render clickable links that appear on the right of target number
        //check if we are not on last page and then generate next
        if($pagenum != $last){
            $next = $pagenum + 1;


            $older_page = ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?category='.$cat_value.'&pn='.$next.'"><span aria-hidden="true">&larr;</span>Older articles ';
        }
    }

    $list = '';
    if($cat_value == "Xbox"){
        $news_title = "Xbox Reviews";
    }else if($cat_value == "Playstation"){
        $news_title = "Playstation Reviews";
    }else if($cat_value == "Nintendo"){
        $news_title = "Nintendo Reviews";
    }else if($cat_value == "PC"){
        $news_title = "PC Reviews";
    }else if($cat_value == "Mobile"){
        $news_title = "Mobile Gaming Reviews";
    }else if($cat_value == "Indie"){
        $news_title = "Indie Gaming Reviews";
    }else{
        $news_title = "Reviews";
    }
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
                    <li class="nav-item hvr-underline-reveal">
                        <a href="news.php">News</a>
                    </li>
                    <li class="nav-item-active">
                        <a href="reviews.php">Reviews</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="videos.php">Videos</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="podcast.php">Podcast</a>
                    </li>
                    <li class="nav-item-after hvr-underline-reveal">
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    
    
    </nav>
    
    <!--End of the navigation template for index.php-->
    <section class="content-large">
        <div class="col-sm-12">
            <nav>
                <ul class="cat-container">
                    <li class="cat-nav">
                        <a href="reviews.php?category=general">All</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=Xbox">Xbox</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=Playstation">Playstation</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=Nintendo">Nintendo</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=PC">PC</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=Mobile">Mobile</a>
                    </li>
                    <li class="cat-nav">
                        <a href="reviews.php?category=Indie">Indie</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 ><?php echo $news_title; ?></h3>
                    <?php
                        
                        if($cat_value == "Xbox"){
                            $cats = "(category='Xbox' OR category='Xbox One' OR category='Xbox 360')";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else if($cat_value == "Playstation"){
                            $cats = "(category='Playstation' OR category='PS2' OR category='PS3' OR category='PS4' OR category='PSP' OR category='PS vita')";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else if($cat_value == "Nintendo"){
                            $cats = "(category='Nintendo' OR category='Wii' OR category='DS' OR category='2DS' OR category='3DS')";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else if($cat_value == "PC"){
                            $cats = "category='PC'";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else if($cat_value == "Mobile"){
                            $cats = "category='Mobile'";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else if($cat_value == "Indie"){
                            $cats = "category='Indie'";
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $cats AND $type ORDER BY id DESC $limit");
                        }else{
                            $page_query2 = mysqli_query($con,"SELECT * FROM articledata WHERE $type ORDER BY id DESC $limit");
                        }
                        while($row = mysqli_fetch_array($page_query2, MYSQLI_ASSOC)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $content = $row['content'];
                            $preview = substr($row['content'],0,300);
                            $category = $row['category'];
                            $creator = $row['creator'];
                            $datetime = strtotime($row['timestamp']);
                            $thumbnail = $row['image1'];
                            $date = date('d-m-Y',$datetime);
                            $time = date('Gi.s',$datetime);
                        
                    ?>
                    <?php
                        if($category == "Xbox" || $category == "Xbox One" || $category == "Xbox 360"){
                            $colourCat ="xbox";//green
                            $textCat ="#000000";
                        }else if($category == "PS2" || $category == "PS3" || $category == "PS4" || $category == "PSP" || $category == "PS vita" || $category == "Playstation"){
                            $colourCat ="playstation";//blue
                            $textCat ="#000000";
                            
                        }else if($category == "Wii" || $category == "DS" || $category == "3DS" || $category == "2DS"|| $category == "Nintendo"){
                            $colourCat ="nintendo";//White
                            $textCat ="#ADADAD";                            
                        }else if($category == "PC"){
                            $colourCat ="pc";//Black
                            $textCat ="#FFFFFF";                           
                        }else if($category == "Mobile"){
                            $colourCat ="mobile mobile-text";//Silver
                            $textCat ="#006400";                            
                        }else if($category == "Indie"){
                            $colourCat ="indie";     
                            $textCat ="#000000";                            
                        }else{
                            $colourCat ="general"; 
                            $textCat ="#000000";                           
                        }
                            
                    ?>
                    <table class="table-index" style="margin-bottom:1%">
                    <tr><td style="padding-right:8px" rowspan="4"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $thumbnail ) . '" width ="170" height = "150" 
                    />';?></td></tr>
                    <tr><td class="norm-table-title title"><a href="article.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></td><td class="cat-table-category category <?php 
                    echo $colourCat; ?>" style="color:<?php echo $textCat; ?>"><?php echo $category; ?></td></tr>
                    <tr><td colspan="2" class="content" style="padding-top:10px;"><?php echo $preview; ?>...<a href="#">read more</a></td></tr>
                    <tr><td colspan="2" class="timestamp"><?php echo "Posted by: ",$creator, " on ", $date; ?></td></tr>
                    <hr>
                    </table>
                    <?php
                        }
                    ?>
                    <br><br>
                    <nav>
                      <ul class="pager">
                        <li class="previous <?php echo $older;?>" ><?php echo $older_page; ?></a></li>
                        
                        <li class="next <?php echo $newer;?>" ><?php echo $new_page; ?></a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</body>

</html>