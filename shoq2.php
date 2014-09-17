<?php
$file = 'cache/queue.php';
echo '<html><body>';
include ( "../forum/config.php");
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");			@mysql_select_db($dbname) or die( "Unable to select database");
echo '
';
$query = "select config_name , config_value , from_unixtime(config_value) from phpbb_config where config_name = 'cron_lock' or config_name = 'last_queue_run'";

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
echo '<pre>';
if (file_exists($file)) {
    ob_clean();
    flush();
    readfile($file);
}
else
{
echo 'Queue is Empty';
};
echo '</pre>';


?>
</body>
</html>

