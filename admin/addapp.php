<?php
echo '
<form action="exec.php" method="POST">
<fieldset>
<legend>App Add</legend>
<label>MODE VISABLE FOR DEBUGGING: </label>
<input readonly name="mode" value="add"></br>
<label for="appname">App Name:</label>
<input type="text" id="appname" name="appname"></br>
<label for="description">Description:</label>
<input type="text" id="description" name="description"></br>
<label for="iconpath">Icon Path (TEMP move to an upload button):</label>
<input type="text" id="iconpath" name="iconpath" size="256" value="assets/images/appicons/default.png"></br>
<label for="link">Link:</label>
<input type="text" id="link" name="link"></br>
<label for="shortcut">Shortcut Key:</label>
<input type="text" id="shortcut" name="shortcut"></br>
<input type="submit" value="ADD">
</fieldset>
</form>
';
?>