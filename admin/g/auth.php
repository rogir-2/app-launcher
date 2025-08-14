<?php
include '../../assets/css/admin.css';
require_once 'scout.php';
if(!isset($_POST['liu_username'])){echo '<h1 class="warn">USERNAME HAS NOT BEEN SET!</h1><br><button onclick="history.back()">Go Back</button>';}
elseif($_POST['liu_username']=='admin')
{
    $username = $_POST['liu_username'];
    setcookie($liu_username,$username);
    echo '<p class="caut">Username is set to: '.$_COOKIE['liu_username'].'</p><br><button onclick="history.back()">Go Back</button>';
    if(!isset($_POST['knock'])){echo '<h1 class="warn">PASSWORD HAS NOT BEEN SET!</h1><br><button onclick="history.back()">Go Back</button>';}
    elseif($_POST['knock']=='admin')
    {
        echo '<h1 class="caut">Welcome Admin!</h1>';
        $liu_username = $_POST['liu_username'];
        $password = $_POST['knock'];
        setcookie($liu_username,$liu_username,0,"/");
        setcookie($knock,$password,0,"/");
        setcookie($los,"1",0,"/");
        setcookie($ual_ltr,"a",0,"/");
        echo '<a class="debug" href="../index.php">TEMP TO ADMIN</a>';
    }
}
?>