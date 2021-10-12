<?php
    include 'credentials.php';
    $conn = mysqli_connect($server, $user, $pass, $db);
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['comm'])) {
            $comm = mysqli_real_escape_string($conn, $_GET['comm']);

            $sql = "SELECT * FROM commands";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $command = $row['command'];
                    $pin = $row['pin'];
                    $funct = $row['funct'];
                    if ($comm == "$command") {
                        system("gpio -g mode $pin out");
                        system("gpio -g write $pin $funct");
                        echo "test";
                    }
                }
            }
            
            if($comm == "turn_on_all_the_lights" OR $comm == "Turn_on_all_the_lights"){
				system("gpio -g mode 18 out");
				system("gpio -g write 18 1");
				system("gpio -g mode 27 out");
				system("gpio -g write 27 1");
				
			}

	if($comm == "turn_off_all_the_lights" OR $comm == "Turn_off_all_the_lights"){
				system("gpio -g mode 18 out");
				system("gpio -g write 18 0");
				system("gpio -g mode 27 out");
				system("gpio -g write 27 0");
				
		}
            
        }
    }
?>

<html>
    <head>
        <title>PiOT</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <style>
            .cellcentercontent {
                display: table-cell;
                vertical-align: middle;
                text-align: center;
            }

            .cellcenterparent {
                width: 100%;
                height: 100%;
                display: table;
            }

            .btnmain{
                padding: 20px;
                margin: 10px;
                width: 100%;
            }

            .container{
                width: 100%;
                max-width: 800px;
            }
        </style>
    </head>
    <body>

        <div class="cellcenterparent">
            <div class="cellcentercontent">
                <div class="container">
                    <a href="addcomm.php"><button class="btn btn-primary btnmain">Add Command</button></a>
                    <br>
                    <a href="delcomm.php"><button class="btn btn-danger btnmain">Delete Command</button></a>
		    <a href="bon.php"><button class="btn btn-success">Relay on 17</button></a> <a href="boff.php"><button class="btn btn-warning">Relay off 17</button></a>
                </div>
            </div>
        </div>

    </body>
</html>
