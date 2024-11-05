<?php
$directory = '/images/'; // Replace with your image directory path
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');
$file_parts = array();
$ext = '';
$title = '';
$i = 0;

$dir_handle = @opendir($directory) or die("There is an error with your image directory!");

while ($file = readdir($dir_handle)) {
    if($file == '.' || $file == '..') continue;
    
    $file_parts = explode('.', $file);
    $ext = strtolower(array_pop($file_parts));

    if(in_array($ext, $allowed_types)) {
        echo '<div class="slide" style="display: none;"><img src="'.$directory.$file.'" alt="'.$file.'"></div>';
        $i++;
    }
}

closedir($dir_handle);
?>

