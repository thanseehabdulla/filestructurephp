<?php

$dir = $_POST['path'];

//$dir ='/opt/lampp/htdocs/phplist/nrm/nrm1/newfile';






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

        $data[] = array('icon' => $icon, 'name' => $files1[$i]);


    }
    $base = basename($dir);
    $data[] = array('path' => $dir,'base'=> $base);



//returns data as JSON format
    echo json_encode($data);
}
else {
    $icon = "<img src='images/folder.png' style='width:25px'/>";
    $data[] = array('icon' => 'icon', 'name' => '..');
    $base = basename($dir);
    $data[] = array('path' => $dir . '/..','base'=> $base);



}

?>