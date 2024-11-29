<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

if(isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    mysqli_query($connection, "DELETE FROM student WHERE nim = '$nim'");
    header('Location: student_view.php');
}
?>
