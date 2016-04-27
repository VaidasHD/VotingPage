<?php

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vote</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Caveat+Brush|Caveat|Chonburi|Itim|Tillana|Arya|Amita|Kurale|Roboto+Mono|Lateef|Modak|Dekko|Ranga|Suranna|Timmana|Lakki+Reddy|Ravi+Prakash|Gurajada|Dhurjati|Kalam|Sarpanch|Rozha+One|Khand|Rajdhani|Teko|Rubik+One|Rubik+Mono+One|Fira+Mono|Alegreya+Sans+SC|Lily+Script+One|Pathway+Gothic+One|Gabriela|Patrick+Hand+SC|Kavoon|Fruktur|Wendy+One|Denk+One|Elsie|Grand+Hotel|New+Rocker|Snowburst+One|Freckle+Face|Vampiro+One|Hanalei|Hanalei+Fill|Margarine|Purple+Purse|Croissant+One|Oleo+Script+Swash+Caps|Risque);

        canvas {background: url("Activation_Valence.png")}
    </style>
</head>
<body style="background-color: beige">

<h1 align="center">Modelling Emotion to Typography</h1>
<div style="text-align: center">
    <p id="wizard">Grumpy wizards make toxic brew for the evil Queen and Jack</p>
</div>
<div id="div1" style="text-align: center">
    <canvas id="myCanvas" width="401" height="401"> </canvas>
    <script>
        var fonterinos = ["Caveat Brush", "Caveat", "Chonburi", "Itim", "Tillana", "Arya", "Amita", "Kurale", "Roboto Mono", "Lateef", "Modak", "Dekko", "Ranga", "Suranna", "Timmana", "Lakki Reddy", "Ravi Prakash", "Gurajada", "Dhurjati", "Kalam", "Sarpanch" , "Rozha One", "Khand", "Rajdhani", "Teko", "Rubik One", "Rubik Mono One", "Fira Mono", "Alegreya Sans SC", "Lily Script One", "Pathway Gothic One", "Gabriela", "Patrick Hand SC", "Kavoon", "Fruktur", "Wendy One", "Denk One", "Elsie", "Grand Hotel", "New Rocker", "Snowburst One", "Freckle Face", "Vampiro One", "Hanalei", "Hanalei Fill", "Margarine", "Purple Purse", "Croissant One", "Oleo Script Swash Caps", "Risque"];

        function getFontName(array, j) {
            var t = j;
            return array[t];
        }

        function randomFont() {
            var rn = Math.floor((Math.random()*49) );
            return rn;
        }

        document.getElementById("wizard").style.fontFamily = getFontName(fonterinos, randomFont());

        function writeMessage(canvas, message) {
            var context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height-100);
            context.font = '8pt Calibri';
            context.fillStyle = 'black';
            context.fillText(message, 10, 25);

        }
        function writeMessageClick(canvas, message) {
            var context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.font = '8pt Calibri';
            context.fillStyle = 'black';
            context.fillText(message, 10, 375);
        }
        function clicked(message) {
            var msg = message;
            return msg;
        }
        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }
        var canvas = document.getElementById('myCanvas');
        var context = canvas.getContext('2d');
        canvas.toDataURL();
        canvas.addEventListener('mousemove', function(evt) {
            var mousePos = getMousePos(canvas, evt);
            var message = 'Mouse position: ' + mousePos.x + ', ' + mousePos.y;
            writeMessage(canvas, message);

        }, false);

        canvas.addEventListener('mousedown', function(evt) {
            var mousePos = getMousePos(canvas, evt);
            var message = 'Mouse clicked: ' + mousePos.x + ', ' + mousePos.y;
            writeMessageClick(canvas, message);
        }, false);


    </script>
    <form method="post" action="database.php">
        <input name="font_ID" type="number" value= '3' readonly>
        <input name="name" type="text" value = "works"  readonly >
        <input name = "x_axis" type="hidden" value="44.5" readonly>
        <input name = "y_axis" type="hidden" value="123.125" readonly>
        <input type="submit" name="submit">
    </form>
</div>

    <?php
    $db_host = "us-cdbr-azure-west-c.cloudapp.net";
    $db_username = "b22028a64fe197";
    $db_pass = "83d01b72";
    $db_name = "Vaidotas_1207652";
 //   $db_handle = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");
    if(isset($_POST['submit'])){
       // $mysqli = new mysqli($db_host, $db_username,$db_pass,$db_name);
        $mysqli = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");
        if($mysqli){
            die("cannot conect : " . mysqli_error($mysqli));
        }
      //  mysqli_select_db($mysqli, "$db_name");
      //  $newque = "INSERT INTO fontlist (font_ID, name, x_axis, y_axis) VALUES ('{$mysqli->real_escape_string($_POST['font_ID'])}',
      //'{$mysqli->real_escape_string($_POST['name'])}', '{$mysqli->real_escape_string($_POST['x_axis'])}', '{$mysqli->real_escape_string($_POST['y_axis'])}')";
        $fontID = $_POST['font_ID'];
        $name = $_POST['name'];
        $xaxis = $_POST['x_axis'];
        $yaxis = $_POST['Y_axis'];
        $sql = "INSERT INTO fontlist (font_ID, name, x_axis, y_axis) 
                VALUES ('$fontID', '$name' , '$xaxis' , '$yaxis')";

        mysqli_query($mysqli, $sql);
        mysqli_close($mysqli);
       /* $insert = $mysqli->query($newque);

        if($insert){
            echo "success";
        } else {
            die("error : {$mysqli->errno} : {$mysqli->error}");
        }

        $mysqli->close();*/
    }
    ?>
<div id="div1">


</div>
    

</body>
</html>
