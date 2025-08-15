<?php
echo '<p class="caut">Please logon to continue!</p>';
echo '
<form action="g/dbauth.php" method="POST">
<label>🆔<strong>Username (admin):</strong> </label>
<input type="text" name="liu_username" id="liu_username" placeholder="Username" required></br>
<label>🔐<strong>Password (admin): </strong></label>
<input type="password" name="knock" id="knock" placeholder="Password" required></br>
<input type="submit" value="LOGON">
</form>
';
?>