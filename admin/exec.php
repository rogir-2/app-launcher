<?php
include '../assets/css/admin.css';
if(!isset($_POST['mode'])){echo '<h1 class="warn">MODE HAS NOT BEEN SET!</h1><br><button onclick="history.back()">Go Back</button>';}
elseif($_POST['mode']=='add'){echo '<h1 class="caut">ADD MODE ENABLED!</h1><br><button onclick="history.back()">Go Back</button>';}
elseif($_POST['mode']=='edit'){echo '<h1 class="caut">EDIT MODE ENABLED!</h1><br><button onclick="history.back()">Go Back</button>';}
elseif($_POST['mode']=='remove'){echo '<h1 class="warn">DELETION MODE ENABLED!</h1><br><button onclick="history.back()">Go Back</button>';}
?>