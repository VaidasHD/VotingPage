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

<div style="text-align: center">
    <p id="wizard">Grumpy wizards make toxic brew for the evil Queen and Jack</p>
</div>

<div id="div1" style="text-align: center">
    <canvas id="myCanvas" width="401" height="401"> </canvas>
    <script>
        //Array with font list with global variables
        var fonterinos = ["Caveat Brush", "Caveat", "Chonburi", "Itim", "Tillana", "Arya", "Amita", "Kurale", "Roboto Mono", "Lateef", "Modak", "Dekko", "Ranga", "Suranna", "Timmana", "Lakki Reddy", "Ravi Prakash", "Gurajada", "Dhurjati", "Kalam", "Sarpanch" , "Rozha One", "Khand", "Rajdhani", "Teko", "Rubik One", "Rubik Mono One", "Fira Mono", "Alegreya Sans SC", "Lily Script One", "Pathway Gothic One", "Gabriela", "Patrick Hand SC", "Kavoon", "Fruktur", "Wendy One", "Denk One", "Elsie", "Grand Hotel", "New Rocker", "Snowburst One", "Freckle Face", "Vampiro One", "Hanalei", "Hanalei Fill", "Margarine", "Purple Purse", "Croissant One", "Oleo Script Swash Caps", "Risque"];
        var xa ;
        var ya;
        //Functions to work with font information retrieval
        function getFontName(array, j) {
            var t = j;
            return array[t];
        }

        function randomFont() {
            var rn = Math.floor((Math.random()*49) );
            return rn;
        }
        var theNumber = randomFont(); //random font selected

        document.getElementById("wizard").style.fontFamily = getFontName(fonterinos, theNumber);

        //Functions for canvas
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
        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }
        //Function to set up values from the form to the database
        function myFunction() {
            document.getElementById("i1").setAttribute("value", theNumber)
            document.getElementById("i2").setAttribute("value", getFontName(fonterinos, theNumber))
            document.getElementById("i3").setAttribute("value", xa)
            document.getElementById("i4").setAttribute("value", ya)
        }
        //Canvas mousemove command and mousedown implementation
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
            xa = mousePos.x;
            ya = mousePos.y;
            writeMessageClick(canvas, message);
        }, false);
    </script>

    <form method="post" action="database.php">
        <input id="i1" name="font_ID" type="hidden" readonly>
        <input id="i2" name="name" type="hidden" readonly >
        <input id="i3" name = "x_axis" type="hidden" readonly>
        <input id="i4" name = "y_axis" type="hidden" readonly>
        <input type="submit" name="submit" onclick="myFunction()">
    </form>
</div>

    <?php
    //Php code for accessing mysql database and submitting data
    $db_host = "us-cdbr-azure-west-c.cloudapp.net";
    $db_username = "b22028a64fe197";
    $db_pass = "83d01b72";
    $db_name = "Vaidotas_1207652";

    if(isset($_POST['submit'])){
        $mysqli = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $fontID = $_POST['font_ID'];
        $name = $_POST['name'];
        $xaxis = $_POST['x_axis'];
        $yaxis = $_POST['y_axis'];

        $sql = "INSERT INTO fontlist (font_ID, name, x_axis, y_axis) 
                VALUES ('$fontID', '$name' , '$xaxis' , '$yaxis')";

        mysqli_query($mysqli, $sql);
        mysqli_close($mysqli);

    }
    ?>

</body>
</html>
