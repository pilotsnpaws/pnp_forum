<?php
echo '<html><body>
<form action="email-list.php" method="post">
List Pilots:<input type=checkbox name="pilots" value="' . $pilots . '"><br>
List Volunteers:<input type=checkbox name=volunteers" value="' . $volunteers . '"><br>
From Zip:<input type=text name="fromzip" value="' . $fromzip . '"><br>
To Zip:<input type=text name="tozip" value="' . $tozip . '"><br>
Distance From Courseline:<input type=text name="dist" value="' . $dist . '"><br>
<input type=submit>
</form>';




echo '</body></html>';
?>
