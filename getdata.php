<?php

$dir = $_POST['path'];

//$dir ='/opt/lampp/htdocs/phplist/nrm';

if (!empty($_POST['path'])) {
//   if(true){
    $data = array();
    $files1 = scandir($dir);


    for ($i = 0; $i < count($files1); $i++) {
        if (is_dir($dir . '/' . $files1[$i])) {
            $icon = "<img src='images/folder.png' style='width:25px'/>";
        } else {
            $icon = "<img src='images/icon.png' style='width:25px'/>";
        }


        $files = $files1[$i];

        $data[] = array('icon'=>$icon,'name'=>$files1[$i]);


    }

    $data[]=array('path'=>$dir);

//returns data as JSON format
    echo json_encode($data);
}


?>