<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

include("connection.php");

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    $query = "SELECT * FROM student WHERE nim = '$nim'";
    $result = mysqli_query($connection, $query);
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        die("Data mahasiswa tidak ditemukan.");
    }
} else {
    header("Location: student_view.php?message=Mahasiswa tidak ditemukan.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birth_city = $_POST['birth_city'];
    $birth_date = $_POST['birth_date'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $gpa = $_POST['gpa'];

    $update_query = "UPDATE student SET 
        name='$name', 
        birth_city='$birth_city', 
        birth_date='$birth_date', 
        faculty='$faculty', 
        department='$department', 
        gpa='$gpa' 
        WHERE nim = '$nim'";

    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        header("Location: student_view.php?message=Data mahasiswa berhasil diupdate.");
        exit;
    } else {
        echo "Update gagal: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
</head>
<body>
<div class="container">
        <h1>Edit Data Mahasiswa</h1>
        <form action="student_edit.php?nim=<?= $nim; ?>" method="POST">
            <table>
                <tr>
                    <td><label for="name">Nama:</label></td>
                    <td><input type="text" id="name" name="name" value="<?= $student['name']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="birth_city">Tempat Lahir:</label></td>
                    <td><input type="text" id="birth_city" name="birth_city" value="<?= $student['birth_city']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="birth_date">Tanggal Lahir:</label></td>
                    <td><input type="date" id="birth_date" name="birth_date" value="<?= $student['birth_date']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="faculty">Fakultas:</label></td>
                    <td><input type="text" id="faculty" name="faculty" value="<?= $student['faculty']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="department">Jurusan:</label></td>
                    <td><input type="text" id="department" name="department" value="<?= $student['department']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="gpa">IPK:</label></td>
                    <td><input type="number" step="0.01" id="gpa" name="gpa" value="<?= $student['gpa']; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
