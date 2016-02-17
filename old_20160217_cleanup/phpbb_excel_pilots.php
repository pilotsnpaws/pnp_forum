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
        . ' from_unixtime(phpbb_users.user_lastvisit) as lastvisit, ' 
        . ' phpbb_users.user_allow_massemail, '
        . ' phpbb_profile_fields_data.user_id ,'
        . ' phpbb_profile_fields_data.pf_airport_id ,'
        . ' airports.apt_id ,'
        . ' airports.apt_name ,'
        . ' airports.lat ,'
        . ' airports.city ,'
        . ' airports.state ,'
        . ' airports.lon'
        . ' from phpbb_users,'
        . ' phpbb_profile_fields_data ,'
        . ' airports'
        . ' where ' 
        . ' phpbb_users.user_allow_massemail = 1 and'
        . ' phpbb_profile_fields_data.pf_pilot_yn = 1 and'
        . ' phpbb_profile_fields_data.user_id = phpbb_users.user_id and '
        . ' airports.apt_id = UCASE(phpbb_profile_fields_data.pf_airport_id) order by airports.state, phpbb_users.user_lastvisit desc'
        . ' ';
	$result=mysql_query($query);



// Functions for export to excel.
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=orderlist.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"Pilots N Paws Pilots");

// Make column labels. (at line 3)
xlsWriteLabel(2,0,"Name");
xlsWriteLabel(2,1,"email");
xlsWriteLabel(2,2,"State");
xlsWriteLabel(2,3,"Last Visit");
xlsWriteLabel(2,4,"City");
xlsWriteLabel(2,5,"Airport");
xlsWriteLabel(2,6,"Allow Mass Email");

$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){

xlsWriteLabel($xlsRow,0,$row['username']);
xlsWriteLabel($xlsRow,1,$row['user_email']);
xlsWriteLabel($xlsRow,2,$row['state']);
xlsWriteLabel($xlsRow,3,$row['lastvisit']);
xlsWriteLabel($xlsRow,4,$row['city']);
xlsWriteLabel($xlsRow,5,$row['apt_id']);
xlsWriteLabel($xlsRow,6,$row['user_allow_massemail']);
 
$xlsRow++;
}
xlsEOF();
exit();
?>




