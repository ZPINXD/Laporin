<?php
    session_start();
    include_once("database.php");

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);

        $sql = "SELECT * FROM user WHERE email ='$email' AND password = '$hash_password'";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
    
            if ($data["password"] === $hash_password) {
                $_SESSION["email"] = $data["email"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["id_user"] = $data["id_user"];
                $_SESSION["is_login"] = true;
    
                header("location:Home.php");
                exit;
            } else {
                header("location:login.php");
                $_SESSION['login_message'] = "Password salah!";
            }
        } else {
            header("location:login.php");
            $_SESSION['login_message'] = "Akun tidak ditemukan!";
        }
        $conn->close();
    
?>