<?php 
    session_start();
    include('server.php');
    $errors = array();

    if (isset($_POST['point_db'])) {
        $conversation = mysqli_real_escape_string($conn,$_POST['conversation']);
        $helping = mysqli_real_escape_string($conn,$_POST['helping']);
        $mid = mysqli_real_escape_string($conn,$_POST['mid']);
        $carry = mysqli_real_escape_string($conn,$_POST['carry']);
        $offlane = mysqli_real_escape_string($conn,$_POST['offlane']);
        $sup4 = mysqli_real_escape_string($conn,$_POST['sup4']);
        $sup5 = mysqli_real_escape_string($conn,$_POST['sup5']);
        $average = mysqli_real_escape_string($conn,$_POST['average']);
        $matchNO = mysqli_real_escape_string($conn,$_POST['matchNO']);

        $user_check_query = "SELECT * FROM pointsdata WHERE matchNO = '$matchNO' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if exists
            if ($result['matchNO'] === $matchNO) {
                array_push($errors, "MatchNumber already exists");            
            }
        } 

        if (count($errors) == 0) {
            $sql = "INSERT INTO pointsdata (conversation ,helping ,mid ,carry ,offlane ,sup4 ,sup5 ,average ,matchNO) VALUES ('$conversation','$helping','$mid','$carry','$offlane','$sup4','$sup5','$average','$matchNO')";
            mysqli_query($conn, $sql) ;
            header('location: web-1920-2.php');
        }

    }
?>
