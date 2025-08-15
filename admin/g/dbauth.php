<?php
require_once '../../includes/db-config.php';
require_once 'scout.php';
include '../../assets/css/admin.css';
session_start();
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) 
{
    die("Database connection failed: " . $conn->connect_error);
}
if($stmt = $conn->prepare('SELECT uuid, passkey FROM bifrost WHERE username = ?'))
{
    $stmt->bind_param('s', $_POST['liu_username']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($uuid,$passkey);
        $stmt->fetch();
        if(password_verify($_POST['knock'],$passkey))
        {
            session_regenerate_id();
            $_SESSION['status_li'] = TRUE;
            $_SESSION['liu_username'] = $_POST['liu_username'];
            echo '<h1 class="caut">Logon Successful!</h1>';
            // Authentication Stage just checks logon not role level currently //
            setcookie($los,"1",0,"/"); // Set logon cookie to active
            setcookie($ual_ltr,"a",0,"/"); // Set logon level to administrator
            echo '<a class="debug" href="../index.php">TEMP TO ADMIN</a>';
        }
        else {echo '<h1 class="warn">Password - BAD LOGON!</h1><br><button onclick="history.back()">Go Back</button>';}
    }
    else{echo '<h1 class="warn">Username - BAD LOGON!</h1><br><button onclick="history.back()">Go Back</button>';}
}
?>