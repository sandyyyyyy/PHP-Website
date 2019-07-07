<?php 

    require("common.php"); 

    if(!empty($_POST)) 
    { 
        if(empty($_POST['username'])) 
        { 
 
            die("Please enter a username."); 
        } 
         
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        } 

        $query = (" SELECT * FROM user WHERE username = :username "); 
         
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $row = $stmt->fetch(); 

        if($row) 
        { 
            die("This username is already in use"); 
        } 

        $query = " 
            INSERT INTO user ( 
                username, 
                password
            ) VALUES ( 
                :username, 
                :password
            ) 
        "; 
         
        $password = hash('sha1', $_POST['password']); 
 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        header("Location: userlogin.php"); 

        die("Redirecting to userlogin.php"); 
    } 
     
?> 