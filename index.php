<html>

<head>
    <title>NRM</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>

<body>

<div style="text-align:center">
    <h1 style="text-transform: uppercase;"><?php

        $basepath = getcwd();
        $path = basename(__DIR__);
        echo $path;

        ?></h1>

    <p>The directory list of folder <b style="text-transform: uppercase;"><?php echo $path; ?></b> as follows</p>
</div>

<?php
$dir;

$dir = '/opt/lampp/htdocs/phplist/nrm';

$files2 = scandir($dir, 1);

// print_r($files1);
// print_r($files2);
echo $basepath;

?>
<div id="table1">
    <table id="mytable" border="10" style="width:100%">
        <?php
        global $files;
        //    echo $dir;
        $files1 = scandir($dir);
        for ($i = 0; $i < count($files1); $i++) {
            if (is_dir($basepath . '/nrm/' . $files1[$i])) {
                $icon = "<img src='images/folder.png' style='width:25px'/>";
            } else {
                $icon = "<img src='images/icon.png' style='width:25px'/>";
            }


            $files = $files1[$i];

            ?>

            <tr onclick="fileclick('<?php

            $dir = '/opt/lampp/htdocs/phplist/nrm/' . $files;

            echo $dir ?>' )">

                <td>

                    <?php echo $icon . $files1[$i] ?>

                </td>
            </tr>
            <?php
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

                dynamicHtml+="<table id='mytable' border='10px' style='width:100%'>";
                for (var i = 0; i < data.length - 1; i++) {
                    var newpath = data[data.length - 1].path + '/' + data[i].name;
                    dynamicHtml+="<tr onclick='fileclick(\"" + newpath.toString() + "\" )'><td>";
                    dynamicHtml+=data[i].icon;
                    dynamicHtml+=data[i].name;

                    dynamicHtml+="</tr></td>";
                    dynamicHtml+="</tr></td>";
                }

                dynamicHtml+="</table>";

                $("#table1").html(dynamicHtml);
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


                document.write("<table id='mytable' border='10px' style='width:100%'>");

                for (var i = 0; i < data.length - 1; i++) {

                    var newpath = data[data.length - 1].path + '/' + data[i].name;
                    console.log(newpath)
                    document.write("<tr onclick='fileclick(\"" + newpath.toString() + "\" )'><td>");

                    document.write(data[i].icon);
                    document.write(data[i].name);

                    document.write("</tr></td>");
                    document.write("</tr></td>");
                }

                document.write("</table>")


            }

        })


    }

</script>

</body>
</html>