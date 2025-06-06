
<?php

require_once './Create_tables.php';
$user = new User();
if(isset($_POST['submit'])){
    
    $user->create(
       $_POST['username'],  
        $_POST['password'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['gender'],
        $_POST['address']
    );
 
    header("Location: Register.html");
}
