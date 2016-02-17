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
	$query="select contact_name , pnp_name , pnp_id , lat , lon ,  public_comment, 
	type , city , state , airport, email, email_alt, cell_num, home_num, other from contacts where lat * lat  > 0" ;

$query = 'select '
        . ' phpbb_users.user_id ,'
        . ' phpbb_users.username ,'
        . ' phpbb_users.user_email, '
        . ' phpbb_users.user_sig, '
        . ' phpbb_users.user_occ, '
        . ' phpbb_users.user_interests, '
        . ' phpbb_profile_fields_data.user_id ,'
        . ' phpbb_profile_fields_data.pf_airport_id ,'
        . ' phpbb_profile_fields_data.pf_zip_code , '
        . ' phpbb_profile_fields_data.pf_pilot_yn , '
        . ' phpbb_profile_fields_data.pf_foster_yn , '
        . ' phpbb_profile_fields_data.pf_emergency_contact '
        . ' from phpbb_users left join '
        . ' phpbb_profile_fields_data '
        . ' on ' 
        . ' phpbb_profile_fields_data.user_id = phpbb_users.user_id '
        . ' where phpbb_users.user_id > 52 '
        . ' order by phpbb_users.user_id ';
	$result=mysql_query($query) or die ( $query) ;

echo       '<html><body><table border=1><tr><th>UserName</th><th>User ID</th><th>ZIP</th><th>foster_yn(1=y,2=no)</th>'
     .'<th>Airport</th><th>pilot_yn(1=y,2=n)</th><th>Email</th><th>Sig</th><th>Occ</th><th>Interests</th><th>Contact</th></tr>';

       $num=mysql_numrows($result);
       mysql_close;
       $i=0;
       while ($i < $num) {

echo mysql_result($result,$i,"phpbb_users.user_email")  . '<br>'
 ;
	       $i++;
	       }
		   echo 
		   '</table><br>'. $i . ' Users Listed<br></body></html>';
       ?>
