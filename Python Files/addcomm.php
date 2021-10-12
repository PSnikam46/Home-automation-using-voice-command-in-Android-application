<html>
    <head>
        <title>PiOT</title>
        <title>PiOT</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body{
                background-color: crimson;
            }

            .card{
                background-color: white;
                padding: 10px;
                width: 100%;
                max-width: 800px;
            }

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
        </style>
    </head>
    <body>
        <div class="cellcenterparent">
            <div class="cellcentercontent">
                <center>
                    <div class="card">
                        <h2>Add Command</h2>
                        <br>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                            <p align="left">Enter Name : </p>
                            <input type="text" class="form-control" name="name">
                            <br>
                            <p align="left">Enter GPIO : </p>
                            <input type="text" class="form-control" name="pin">
                            <br>
                            <p align="left">Enter Function : </p>
                            <select name="function" class="form-control">
                                <option value="on">ON</option>
                                <option value="off">OFF</option>
                            </select>
                            <br>
                            <p align="left">Enter Voice Command : </p>
                            <input type="text" class="form-control" name="comm">
                            <br>
                            <button type="submit" class="btn btn-success form-control">Add Command</button>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include 'credentials.php';
        $conn = mysqli_connect($server, $user, $pass, $db);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $pin = mysqli_real_escape_string($conn, $_POST['pin']);
        $funct = mysqli_real_escape_string($conn, $_POST['function']);
        $command = mysqli_real_escape_string($conn, $_POST['comm']);

        $command = str_replace(" ","_", $command);

        $sqlin = "INSERT INTO commands(name, pin, funct, command) VALUES('$name',$pin,'$funct','$command')";

        if(mysqli_query($conn, $sqlin)){
            echo "<script>alert('Command Added'); document.location='index.php'</script>";
        }else{
            echo "<script>alert('Error has occured');</script>";
        }
    }
?>