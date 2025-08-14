<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php require_once '../includes/config.php'; echo $title;?></title>

    <!-- CSS Style -->
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
    <body class="dark">
        <!-- Header -->
        <header>
            <h1 tabindex="0"><?php require_once '../includes/config.php'; echo $title;?> </br>⚠ Admin Panel Version 1 ⚠</h1>
            <button id="themeBtn" area-pressed="true" aria-label="Toggle light mode">
                <span id="themeIcon">☀️</span>
            </button>
        </header>
        <?php
        include '../assets/css/admin.css';
        include '../includes/config.php';
        include 'g/scout.php';
        // LOGON COOKIE CODE FOR NOW //
        echo '<p class="caut">CAUTION: This page is DIRTY & in development and will be buggy!</p>';
        if(!isset($_COOKIE[$los]))
        {
            if(!isset($_COOKIE[$liu_username])){echo '<p class="warn">WARNING: Cookie: '.$liu_username.' is not set!</p>';}
            if(!isset($_COOKIE[$ual_ltr])){echo '<p class="warn">WARNING: Cookie: '.$ual_ltr.' is not set!</p>';}
            echo '<p class="caut">Please logon to continue!</p>';
            echo'<div id="auth">';
            include 'logon.php';
            echo'</div>';
        }
        elseif($_COOKIE[$los]=="1")
        {
            if($_COOKIE[$ual_ltr]=="a")
            {
                echo '<a class="debug" href="logoff.php">DIRTY LOGOFF</a>';
                // TEMP MAYBE MOVE //
                echo'<div id="addapp">';
                if($adminmode !== 2){include 'addapp.php';}if($adminmode==2){include 'addapp.php';}
                echo'</div>';
                echo'<div id="editapp">';
                if($adminmode !== 2){include 'editapp.php';}if($adminmode==2){echo '<p class="caut">MODULE NOT YET MADE!</p>';}
                echo'</div>';
                echo'<div id="delapp">';
                if($adminmode !== 2){include 'delapp.php';}if($adminmode==2){echo '<p class="caut">MODULE NOT YET MADE!</p>';}
                echo'</div>';
            }
            // END OF LOGON COOKIE CODE FOR NOW //
        }
        ?>
        <script src="../assets/js/app.js"></script>
    </body>
</html>