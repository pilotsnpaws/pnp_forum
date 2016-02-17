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
        . ' phpbb_profile_fields_data.user_id ,'
        . ' phpbb_profile_fields_data.pf_zip_code ,'
        . ' zipcodes.zip ,'
        . ' zipcodes.lat ,'
        . ' zipcodes.city ,'
        . ' zipcodes.state ,'
        . ' zipcodes.lon'
        . ' from phpbb_users,'
        . ' phpbb_profile_fields_data ,'
        . ' zipcodes'
        . ' where ' 
        . ' phpbb_profile_fields_data.pf_foster_yn = 1 and'
        . ' phpbb_profile_fields_data.user_id = phpbb_users.user_id and '
        . ' zipcodes.zip = phpbb_profile_fields_data.pf_zip_code '
        . ' and (  phpbb_users.user_new_privmsg = 0 or '
        . ' phpbb_users.user_lastvisit > unix_timestamp() -  604800 ) '
        . ' ';
if ( $mode == "query" ) $echodata =  $query ;
	$result=mysql_query($query);
	header('Content-type: application/vnd.google-earth.kml+xml');
    $echodata =  '<?xml version="1.0" encoding="UTF-8"?>
		 <kml xmlns="http://earth.google.com/kml/2.2">
		 <Document>
		 		   <name>Pilots N Paws - Volunteer Locations</name>
				   <description>
				      <![CDATA[Pilots N Paws - Volunteer Locations www.pilotsnpaws.org]]>
				   </description>
         <Style id="style1">
    <IconStyle>
      <Icon>
       <href>http://maps.google.com/mapfiles/ms/micons/blue-dot.png</href> 
      </Icon>
    </IconStyle>
  </Style>';

$myFile = "phpbb_mapf.kml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $echodata);
echo $echodata;



       $num=mysql_numrows($result);
       mysql_close;
       $i=0;
       while ($i < $num) {
	   $contact_name = mysql_result($result,$i,"phpbb_users.username");  	   
	   $pnp_name = mysql_result($result,$i,"phpbb_users.username");
	   $pnp_id = mysql_result($result,$i,"phpbb_users.user_id");
	   $lat = mysql_result($result,$i,"zipcodes.lat") + rand(-100,100) / 10000 ;
	   $lon = mysql_result($result,$i,"zipcodes.lon")  + rand(-100,100) / 10000 ;
	   $type = "FOSTER VOLUNTEER";
           $city = mysql_result($result,$i,"zipcodes.city");
           $state = mysql_result($result,$i,"zipcodes.state");

	   $public_comment = $type;

	   $echodata =  '<Placemark>';
fwrite($fh, $echodata);
echo $echodata;

	
	   $echodata =  '<Style>
      <IconStyle>
        <Icon>
          <href>root://icons/palette-2';
fwrite($fh, $echodata);
echo $echodata;


		  $echodata =  '.png</href>
          <x>';
fwrite($fh, $echodata);
echo $echodata;

		  $echodata =  0;
fwrite($fh, $echodata);
echo $echodata;

		  $echodata =  '</x>
          <y>';
fwrite($fh, $echodata);
echo $echodata;

		  $echodata =  0;
fwrite($fh, $echodata);
echo $echodata;

		  $echodata =  '</y>
          <w>8</w>
          <h>8</h>
        </Icon>
      </IconStyle>
    </Style>';
fwrite($fh, $echodata);
echo $echodata;

	
if ( $mode == "private" ) {
$echodata =  '<name>'; 
fwrite($fh, $echodata);
echo $echodata;

$echodata =  $pnp_name ;
fwrite($fh, $echodata);
echo $echodata;

$echodata =  '</name><description><![CDATA[<div="ltr"><br>';
fwrite($fh, $echodata);
echo $echodata;

$echodata =  'Name:' . $contact_name . '<br>';
fwrite($fh, $echodata);
echo $echodata;

if ( $cell_num > " " ) {
$echodata =  'Cell_num:' . $cell_num . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
if ( $email > " " ) {
$echodata =  'Email:' . $email . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
if ( $city > " " ) {
$echodata =  'city:' . $city . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
if ( $state > " " ) {
$echodata =  'state:' . $state . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
if ( $email_alt > " " ) {
$echodata =  'email_alt:' . $email_alt . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
if ( $home_num > " " ) {
$echodata =  'home_num:' . $home_num . '<br>';
fwrite($fh, $echodata);
echo $echodata;
}
	$echodata =  '<br><br></div>]]>'; 
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '</description>';
fwrite($fh, $echodata);
echo $echodata;

   }
else
{

	   $echodata =  '<name>';
fwrite($fh, $echodata);
echo $echodata;

	   $echodata =  $pnp_name;
fwrite($fh, $echodata);
echo $echodata;

	   $echodata =  '</name><description>';
fwrite($fh, $echodata);
echo $echodata;

	   $echodata =  '<![CDATA[<div dir="ltr">';
fwrite($fh, $echodata);
echo $echodata;

	    
/*	$echodata =  $contact_name .'<br>' ; */
	$echodata =  $type . '<br>';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  $city . ', ' . $state . '<br>';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '<br><br><a href="http://pilotsnpaws.org/forum/memberlist.php?mode=viewprofile&amp;u=';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  $pnp_id ; 
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '">View Profile for ';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =   $pnp_name ;
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '</a><br><br><a href="http://pilotsnpaws.org/forum/ucp.php?i=pm&amp;mode=compose&amp;u=';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  $pnp_id ;
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '">Request Foster Assistance from ';
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  $pnp_name ;
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '</a>'; 
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '<br><br></div>]]>'; 
fwrite($fh, $echodata);
echo $echodata;

	$echodata =  '</description>';
fwrite($fh, $echodata);
echo $echodata;

	}
/*	$echodata =  '<styleUrl>#style1</styleUrl>'; */
    $echodata =  '<Point>
      <coordinates>';
fwrite($fh, $echodata);
echo $echodata;

	  $echodata =  $lon ;
fwrite($fh, $echodata);
echo $echodata;

	  $echodata =  ',' ;
fwrite($fh, $echodata);
echo $echodata;

	  $echodata =  $lat ;
fwrite($fh, $echodata);
echo $echodata;

	  $echodata =  ',0.000000</coordinates>
    </Point>
  </Placemark>';
fwrite($fh, $echodata);
echo $echodata;

	       $i++;
	       }
		   $echodata =  
		   '</Document></kml>';
fwrite($fh, $echodata);
echo $echodata;


fclose($fh);
       ?>
