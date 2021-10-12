<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include 'credentials.php';

        $conn = mysqli_connect($server, $user, $pass, $db);

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        if(!empty($id)){
            $sqldel = "DELETE FROM commands WHERE id = '$id'";
            if(mysqli_query($conn, $sqldel)){
                echo "<script>alert('Deleted'); document.location='index.php';</script>";
            }
        }
    }
?>