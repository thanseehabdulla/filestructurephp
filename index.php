<html>

<head>
    <title>NRM</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>


<nav style="z-index:25;position:fixed;width:100%;overflow:hidden;top:0px"
     class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" style="color: white;cursor:pointer;" onclick="redirect('/')">NRM </a>


    <div id="breadcrumbshref">
        <a style="color: white;cursor:pointer;" onclick="redirect('/')">Home</a>
    </div>


</nav>


<div style="text-align:center">
    <h1 style="text-transform: uppercase;" id="pathname2"><?php

        $basepath = getcwd();
        $path = basename(__DIR__);
        //        echo $path;

        ?>

    </h1>


</div>


<?php
$dir;

$dir = '/opt/lampp/htdocs/phplist/nrm';

$files2 = scandir($dir, 1);


?>

<div id="table1" style="margin-top:80px">
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

                echo $dir ?>','<?php echo $files ?>' )">

                    <td>

                        <?php
                        $size = filesize($dir);
                        echo $icon . "  " . $files1[$i] ?>


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


    function fileclick(path, filename) {

        // alert(JSON.stringify(path));
        // $("#mytable").remove();
        dynamictable2(path, filename);


    }


    function dynamictable2(path, filename) {

        $.ajax({
            type: 'POST',
            url: 'getdata.php',
            dataType: "json",
            data: {path: path, filename: filename},
            success: function (data) {


                var dynamicHtml = "";
                var base = data[data.length - 1].path;
                var dirpath = "/opt/lampp/htdocs/phplist/nrm/";
                var dirpath2 = "/opt/lampp/htdocs/phplist/nrm"
                console.log(base)

                dynamicHtml += "<table id='mytable' class='table table-hover' border='1' style='width:100%'>";
                for (var i = 0; i < data.length - 1; i++) {
                    var newpath = data[data.length - 1].path + '/' + data[i].name;

                    if (data[i].name !== '.' && !(data[i].name === '..' && (base === dirpath || base === dirpath2))) {

                        dynamicHtml += "<tr class='table-secondary' onclick='fileclick(\"" + newpath.toString() + "\" )'><td>";
                        dynamicHtml += data[i].icon;
                        dynamicHtml += "  " + data[i].name;
                        dynamicHtml += "</td></tr>";
                    }
                }

                dynamicHtml += "</table>";

                $("#table1").html(dynamicHtml);


                var pathd = ""

                var seperateHome = base.split(dirpath)[1]
                var pathParts;
                try {
                    pathParts = seperateHome.split("/");
                } catch (e) {
                    pathParts = "";
                }

                pathd += "<a style='color: white;cursor:pointer;' onclick='redirect(\"/\")'>Home</a>";
                var realPath = dirpath;
                for (var i = 0; i < pathParts.length; i++) {

                    if (pathParts[i] === '..') {
                        i++;

                    } else {
                        realPath += pathParts[i] + "/";

                        pathd += "<a style='color: white;cursor:pointer;' onclick='redirect(\"" +realPath + "\")'>=>" + pathParts[i] + "</a>"
                        console.log( realPath);
                    }

                }

                // pathd += "<a style='color: white;cursor:pointer;' onclick='redirect(\""+seperateHome+"\")'><br/>"+seperateHome+"</a>"

                $("#breadcrumbshref").html(pathd)

            }

        })

    }


    function redirect(path) {
        var paths = path
        if (path === '/') {
            var base = '/opt/lampp/htdocs/phplist/nrm';

            dynamictable2(base);
            var pathd = "";
            pathd += "<a style='color: white;cursor:pointer;' onclick='redirect(\"/\")'>Home</a>";
            $("#breadcrumbshref").html(pathd)
        } else {
            dynamictable2(path);

        }


    }

</script>
<!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed;bottom:0px;right:0px">-->
<!--    <a class="navbar-brand" href="#" style="text-align: center">NRM@2018</a>-->


</nav>
</body>
</html>