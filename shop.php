<?php
// FILL THESE IN WITH YOUR SERVER'S DETAILS
include ( "../forum/config.php");
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");			@mysql_select_db($dbname) or die( "Unable to select database");
echo '
<html>
<head><title>MySQL Command Line</title></head>
<body>
';
$query = "select u.username , a.city, a.state , a.apt_id, p.pf_flying_radius from phpbb_users u, 
phpbb_profile_fields_data p , airports a where p.pf_pilot_yn = 1 and p.pf_flying_radius > 0 and u.user_id = p.user_id and a.apt_id = p.pf_airport_id ";
echo('<p><b>Query:</b><br />'.nl2br($query).'</p>');
        $result = mysql_query($query);
        if ($result) {
                if (@mysql_num_rows($result)) {
                        ?>
                        <p><b>Result Set:</b></p>
                        <table border="1">
                        <thead>
                        <tr>
			<th>Count</th>
                        <?php
                        for ($i=0;$i<mysql_num_fields($result);$i++) {
                                echo('<th>'.mysql_field_name($result,$i).'</th>');
                        }
                        ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
			$kount = 1;
                        while ($row = mysql_fetch_row($result)) {
                                echo('<tr>');
				echo "<td>$kount</td>";
				$kount++;
                                for ($i=0;$i<mysql_num_fields($result);$i++) {
                                        echo('<td>'.$row[$i].'</td>');
                                }
                                echo('</tr>');
                        }
                        ?>
                        </tbody>
                        </table>
                        <?php
                } else {
                        echo('<p><b>Query OK:</b> '.mysql_affected_rows().' rows affected.</p>');
                }
        } else {
                echo('<p><b>Query Failed:</b> '.mysql_error().'</p>');
        }
        echo('<hr />');

?>
</body>
</html>

