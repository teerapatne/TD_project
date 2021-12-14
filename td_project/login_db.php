<?php 
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']) ;
        $password = mysqli_real_escape_string($conn, $_POST['password']) ;

        if (empty($username)) {
            array_push($errors, "Username Required");
        }
        
        if (empty($password)) {
            array_push($errors, "Password Required");
        }
        if (count($errors) == 0 ) {
            //$password = md5($password) ;
            $user_check_query = "SELECT * FROM userdata WHERE username = '$username' ";
            $query = mysqli_query($conn, $user_check_query);
            $result = mysqli_fetch_assoc($query);
            if ($result) { // if user exists
                if ($result['username'] === $username) {
                    if ($result['password'] != $password) {
                        array_push($errors, "Wrong Password");                       
                    }else{
                        $_SESSION['user'] = $result['username'] ;
                        $_SESSION['success'] = "You are now logged in" ;
                        header('location: web-1920-2.php');
                    }
                }else {
                    array_push($errors, "Username does not exists");   
                } 
            }
        }

    }
    

?>