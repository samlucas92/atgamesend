<?php
$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
$image = getImageFromDatabase($id); // your code to fetch the image

header('Content-Type: image/jpeg');
echo $image;
?>