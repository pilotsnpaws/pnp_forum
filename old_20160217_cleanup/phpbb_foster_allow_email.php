<?php
function xmlspecialchars($text) {
   return str_replace('-' , ' ' , str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES)));
}



include ( "../forum/config.php");

$username=$dbuser;
$password=$dbpasswd;
$database=$dbname;
$server=$dbhost;

$con = mysql_connect($server,$username,$password)or die( "Unable to connect to database");			@mysql_select_db($database) or die( "Unable to select database");


	$mode = $_GET[mode];


$query = 'select '
        . ' phpbb_users.user_id ,'
        . ' phpbb_users.username ,'
        . ' phpbb_users.user_email, '
        . ' phpbb_users.user_sig, '
        . ' phpbb_users.user_occ, '
        . ' phpbb_users.user_interests, '
		. ' phpbb_users.user_allow_massemail, '
        . ' phpbb_profile_fields_data.user_id , '
        . ' phpbb_profile_fields_data.pf_zip_code, '
        . ' zipcodes.city, '
        . ' zipcodes.state '
        . ' from phpbb_users,'
        . ' phpbb_profile_fields_data, '
        . ' zipcodes '
        . ' where '
		. ' phpbb_users.user_allow_massemail = 1 and '
        . ' phpbb_profile_fields_data.pf_foster_yn = 1 and '
        . ' phpbb_profile_fields_data.user_id = phpbb_users.user_id and '
        . ' zipcodes.zip = phpbb_profile_fields_data.pf_zip_code '
        . ' order by zipcodes.state'
        . ' ';
	$result=mysql_query($query) or die($query);

echo       '<html><body><table border=1><tr><th>UserName</th><th>State</th><th>City</th>'
     .'<th>Zip Code</th><th>Allow Mass Email</th><th>Email</th><th>Sig</th><th>Occ</th><th>Interests</th></tr>';

       $num=mysql_numrows($result);
       mysql_close;
       $i=0;
       while ($i < $num) {

echo '<tr><td>' . mysql_result($result,$i,"phpbb_users.username") . '</td>'
       . '<td>' . mysql_result($result,$i,"zipcodes.state") . '</td>'
       . '<td>' . mysql_result($result,$i,"zipcodes.city") . '</td>'
       . '<td>' . mysql_result($result,$i,"phpbb_profile_fields_data.pf_zip_code")  . '</td>'
	   . '<td>' . mysql_result($result,$i,"phpbb_users.user_allow_massemail") . '</td>'
       . '<td>' . mysql_result($result,$i,"phpbb_users.user_email")  . '</td>'
       . '<td>' . mysql_result($result,$i,"phpbb_users.user_sig")  . ' &nbsp</td>'
       . '<td>' . mysql_result($result,$i,"phpbb_users.user_occ")  . ' &nbsp</td>'
       . '<td>' . mysql_result($result,$i,"phpbb_users.user_interests")  . ' &nbsp</td>'
       . '</tr>'
 ;
	       $i++;
	       }
		   echo 
		   '</table><br>'. $i . ' Volunteer Fosters Listed<br></body></html>';
       ?>
