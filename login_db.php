<?php
    session_start();
    include('server.php');

    $errors =  array();

    if (isset($_POST['log_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)){
            array_push($errors, "Username is required");
        }
        if (empty($password)){
            array_push($errors, "Password is required");
        }

        $user_check_query = "SELECT * FROM user WHERE username = '$username' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['username'] === $username) {
                array_push($errors, "Cannot login");
            }
        }

        if (count($errors) == 0) {
            $password = md5($password);

            $sql = "INSERT INTO user (username, password) VALUES ('$username','$password')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Try again");
            $_SESSION['error'] = "Try again";
            header("location: login.php");
        }
    }

?>