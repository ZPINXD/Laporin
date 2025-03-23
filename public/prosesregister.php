<?php
    session_start();
    include_once("database.php");
    $username = $_POST["nama"];
    $tempat = $_POST["tempat"];
    $jenis_kelamin = $_POST["kelamin"];
    $no_telp = $_POST["no"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hash_password = hash("sha256", $password);

    $check_query = "SELECT * FROM user WHERE email = '$email' OR no_telp = '$no_telp'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION["register_message"] = "Email/No.Telp sudah digunakan";
        header("Location: register.php");
        exit();
    } else {
        $query = "INSERT INTO user (username, password, no_telp, email, jenis_kelamin, alamat) 
                  VALUES ('$username', '$hash_password', '$no_telp', '$email', '$jenis_kelamin', '$tempat')";

        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            header("Location: login.php");
            exit();
        } else {
            $_SESSION["register_message"] = "Daftar akun gagal, silahkan coba lagi";
            header("Location: register.php");
            exit();
        }
    }

    $conn->close();
?>
