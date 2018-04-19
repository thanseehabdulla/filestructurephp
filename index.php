<html>

<head>
    <title>NRM</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">NRM</a>
<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->


</nav>



<div style="text-align:center">
    <h1 style="text-transform: uppercase;" id="pathname2"><?php

        $basepath = getcwd();
        $path = basename(__DIR__);
        //        echo $path;

        ?>
<!--        /-->
    </h1>

<!--    <p>The directory list of folder <b style="text-transform: uppercase;" id="pathname">/</b> as follows</p>-->
</div>


<?php
$dir;

$dir = '/opt/lampp/htdocs/phplist/nrm';

$files2 = scandir($dir, 1);

// print_r($files1);
// print_r($files2);
//echo $basepath;

?>
<!--<ol class="breadcrumb">-->
<!--    <li class="breadcrumb-item active" id="breadcumcontent">Home</li>-->
<!--</ol>-->
<div id="table1">
    <table id="mytable" class="table table-hover" border="1" style="width:100%">
        <?php
        global $files;
        //    echo $dir;
        $files1 = scandir($dir);
        for ($i = 0; $i < count($files1); $i++) {

            if ($files1[$i] !== '.' && $files1[$i] !== '..') {
                if (is_dir($basepath . '/nrm/' . $files1[$i])) {
                    $icon = "<img src='images/folder.png' style='width:20px'/>";
                } else {
                    $icon = "<img src='images/icon.png' style='width:20px'/>";
                }


                $files = $files1[$i];

                ?>

                <tr class='table-secondary' onclick="fileclick('<?php

                $dir = '/opt/lampp/htdocs/phplist/nrm/' . $files;

                echo $dir ?>' )">

                    <td>

                        <?php
                        $size = filesize($dir);
                        echo $icon ."  ". $files1[$i]  ?>


                    </td>
<!--                    <td>-->
<!--                        Filesize:--><?php //echo $size ?>
<!--                    </td>-->
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>

<script>


    // $(document).ready( function () {
    //     $('#mytable').DataTable();
    // } );


    function fileclick(path) {

        // alert(JSON.stringify(path));
        // $("#mytable").remove();
        dynamictable2(path);


    }


    function dynamictable2(path) {
        $.ajax({
            type: 'POST',
            url: 'getdata.php',
            dataType: "json",
            data: {path: path},
            success: function (data) {


                var dynamicHtml = "";

                dynamicHtml += "<table id='mytable' class='table table-hover' border='1' style='width:100%'>";
                for (var i = 0; i < data.length - 1; i++) {
                    var newpath = data[data.length - 1].path + '/' + data[i].name;

                    if (data[i].name !== '.') {

                        dynamicHtml += "<tr class='table-secondary' onclick='fileclick(\"" + newpath.toString() + "\" )'><td>";
                        dynamicHtml += data[i].icon;
                        dynamicHtml += "  "+data[i].name;
                        dynamicHtml += "</td></tr>";
                    }
                }

                dynamicHtml += "</table>";

                $("#table1").html(dynamicHtml);
                var dir = data[data.length - 1].path.substring(data[data.length - 1].path.lastIndexOf('/') + 1);
                console.log(data[data.length - 1].path);
                if (dir === '..') {
                    var pathArray = (data[data.length - 1].path).split('..')
                    dir = pathArray[0].substring(pathArray[0].lastIndexOf('/'));
                }

                var base = data[data.length - 1].base;

                // document.getElementById("pathname").innerHTML = base;
                // document.getElementById("pathname2").innerHTML = base;
                // document.getElementById("breadcumcontent").innerHTML = 'Home /'+base;

            }

        })

    }


    function dynamictable(path) {
        $.ajax({
            type: 'POST',
            url: 'getdata.php',
            dataType: "json",
            data: {path: path},
            success: function (data) {


                document.write("<table id='mytable' class='table table-hover' border='10px' style='width:100%'>");

                for (var i = 0; i < data.length - 1; i++) {

                    var newpath = data[data.length - 1].path + '/' + data[i].name;
                    console.log(newpath)
                    document.write("<tr class='table-secondary' onclick='fileclick(\"" + newpath.toString() + "\" )'><td>");

                    document.write(data[i].icon);
                    document.write(data[i].name);

                    document.write("</td>");
                    document.write("</tr>");
                }

                document.write("</table>")


            }

        })


    }

</script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed;bottom:0px;right:0px">
    <a class="navbar-brand" href="#" style="text-align: center">NRM@2018</a>



</nav>
</body>
</html>