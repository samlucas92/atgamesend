<?php
    $con = mysqli_connect("localhost", "root","pass","articlegame");
    session_start();

    $page_sql = "SELECT COUNT(id) FROM articledata";
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
                $newer = 'pagination-new';
                $new_page = ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Newer articles <span aria-hidden="true">&rarr;</span> ';

            }

        //render the target page number
        $paginationCtrls .= ''.$pagenum.' &nbsp; ';
        //render clickable links that appear on the right of target number
        //check if we are not on last page and then generate next
        if($pagenum != $last){
            $next = $pagenum + 1;
            $older = 'pagination-prev';

            $older_page = ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><span aria-hidden="true">&larr;</span>Older articles ';
        }
    }
    $list = '';
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
                    <li class="nav-item-active">
                        <a href="#news">News</a>
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
    <section class="content-large">
        <div class="col-sm-12">
            
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 >Recent News</h3>
                    <?php

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