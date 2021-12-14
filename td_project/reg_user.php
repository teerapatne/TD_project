<?php 
    session_start();
    include('server.php');
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $steam_id = mysqli_real_escape_string($conn,$_POST['steam_id']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if (empty($steam_id)) {
            array_push($errors, "ID steam Required");
        }

        
        $user_check_query = "SELECT * FROM userdata WHERE username = '$username' OR e_mail = '$email' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");            
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");    
            }
        } 

        if (count($errors) == 0) {
            $password = md5($password) ;
            $sql = "INSERT INTO userdata (steam_id, e_mail, password, username) VALUES ('$steam_id', '$email', '$password', '$username')" ;
            mysqli_query($conn, $sql) ;
            $_SESSION['username'] = $username ;
            $_SESSION['success'] = "You are now logged in" ;
            header('location: index.php');
        }
    }    
?>