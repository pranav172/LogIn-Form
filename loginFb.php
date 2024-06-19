<?php
    include("loginFbDatabase.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method = "post">
        <h2>Welcome to Fakebook!</h2> <br>
        <label style="margin-bottom: 10px;">Username: </label><br>
        <input type="text" name = "username"><br>
        <label style="margin-bottom: 10px;">Password: </label><br>
        <input type="password" name="password" style="margin-bottom: 10px;"><br>
        <input type="submit" name = "submit" value="register" >

    </form>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($username)){
            echo "Please enter a username";
        }
        elseif(empty($password)){
            echo "Please enter a password";
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO login(user, password) VALUES ('$username', '$hash')";
            
            try{
                mysqli_query($conn, $sql);
                echo "<h4> You are now registered! </h4>";
            }
            catch(mysqli_sql_exception){
                echo "<h4> That username is taken </h4>";
            }
        }   
    }

    mysqli_close($conn);
?>