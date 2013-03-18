<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $username = "Dom";
    $password = "Password";
    $db = "simpletondb";
    
    $conn = new mysqli("127.0.0.1", $username, $password, $db);
    
    if($conn->connect_error) {
        die("connect error: " . $conn->connect_errno . " ++++ " . $conn->connect_error);
    }
    
    $subscription = $_POST["sub"];
    
    $idquery = "SELECT UNIQUE_ID FROM users where username = 'Dom'";
    
    $ans = $conn->query($idquery);
    $t = $ans->fetch_assoc();
    $id = $t['UNIQUE_ID'];
    
    $query = "INSERT INTO subscription (id, url) VALUES (?, ?)";
    
    if ($stmt = $conn->prepare($query))
    {
        $stmt->bind_param('is', $id, $subscription);
        $stmt->execute();
    }
    
    $conn->close();
    
    header( 'Location: Index.php' ) ;
?>