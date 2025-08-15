<!-- Temporary script to create a logon DB & credentials -->
<?php
include '../assets/css/admin.css';
echo '<h1 class="caut">The table should now be made in your DB...Username <strong>admin</strong> Password <strong>admin</strong></h1><br><button onclick="history.back()">Go Back</button></br>';
require_once '../includes/db-config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) 
{
    die("Database connection failed: " . $conn->connect_error);
}
$sql1 = "CREATE TABLE IF NOT EXISTS `bifrost` (
  `uuid` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `realname` text NOT NULL,
  `passkey` text NOT NULL,
  `email` text NOT NULL,
  `authlvl` int(11) NOT NULL,
  `authrole` text NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$sql1 .= "INSERT INTO bifrost (uuid,username,realname,passkey,email,authlvl,authrole) VALUES (NULL,'admin','admin','$2y$10$2AXrMm//CBWf6/rhiy3Hf.U7ng297KjtXCV1EeU27us3iD/rgE45q','admin@localhost.local',1,'administrator');";
$conn->multi_query($sql1);
$conn->close();

// Edit the text in the quotes below to generate a different password
$temppassword = password_hash('',PASSWORD_DEFAULT);
echo '<strong>This is the temporary hash generator:</strong> '.$temppassword;
?>