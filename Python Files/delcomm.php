<html>
    <head>
        <title>PiOT</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
<?php
    include 'credentials.php';
    $conn = mysqli_connect($server, $user, $pass, $db);

    $sql = "SELECT * FROM commands";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table style='width: 100%;' class='table table-stripped table-responsive'>";
        echo "<tr>
    <th>Name</th>
    <th>GPIO</th>
    <th>Fn</th>
    <th>Command</th>          
    <th>Action</th>  
</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $command = $row['command'];
            $pin = $row['pin'];
            $funct = $row['funct'];
            $name = $row['name'];
            $id = $row['id'];
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$pin</td>";
            echo "<td>$funct</td>";
            echo "<td>$command</td>";
            echo "<td><a href='del.php?id=$id'><button class='btn btn-danger'>Delete</button></a> </td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
    </body>
</html>
