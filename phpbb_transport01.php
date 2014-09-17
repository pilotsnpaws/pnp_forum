<?php
echo '<head>';
$fromcity=$_POST[fromcity];
$fromstate=$_POST[fromstate];
$fromzip=$_POST[fromzip];
$tocity=$_POST[tocity];
$tostate=$_POST[tostate];
$tozip=$_POST[tozip];
include ( "../forum/config.php");
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");			@mysql_select_db($dbname) or die( "Unable to select database");
if ($fromzip > " " ) {
   $query = "select city , state from zipcodes where zip = $fromzip";
   $result=mysql_query($query);
   $num=mysql_numrows($result);
   if ($num > 0) { 
                   $fromcity = mysql_result($result,0,"city");
                   $fromstate = mysql_result($result,0,"state");
				   }
	   else { 
	          $fromcity = "" ;
	          $fromstate = "" ;
		}
	}
	else
	if ( $fromcity > " " ) if ( $fromstate > " " ) {
	   $query = 'select zip from zipcodes where city = "' . $fromcity . '" and state = "' . $fromstate . '"';
	   $result=mysql_query($query);
	   if (mysql_numrows($result) > 0 ) $fromzip = mysql_result($result,0,"zip");
	   else
	   $fromzip = "";
	   }
if ($tozip > " " ) {
   $query = "select city , state from zipcodes where zip = $tozip";
   $result=mysql_query($query);
   $num=mysql_numrows($result);
   if ($num > 0) { $tocity = mysql_result($result,0,"city");
                   $tostate = mysql_result($result,0,"state");
				   }
	   else { $tocity = "" ;
	         $tostate = "" ;
		}
	}
	else
	if ( $tocity > " " ) if ( $tostate > " " ) {
	  	   $query = 'select zip from zipcodes where city = "' . $tocity . '" and state = "' . $tostate . '"';
	  
	   $result=mysql_query($query);
	   if (mysql_numrows($result) > 0 ) $tozip = mysql_result($result,0,"zip");
	   else
	   $tozip = "";
	   }

echo '<head>
  <title>';
if ( strlen ( $fromzip . $tozip ) == 10 ) echo "Map Pilots between $fromcity $fromstate and $tocity $tostate";
else echo "Select To and From Zip Codes";
echo '</title>
</head>
<body>';
echo '
<form action="phpbb_transport.php" method="post">
From:<br>
City:<input type=text name="fromcity" value="' . $fromcity . '">
State:<input type=text name="fromstate" value="' .$fromstate . '">
Zip:<input type=text name="fromzip" value="' . $fromzip . '">
<br><br>
To:<BR>
City:<input type=text name="tocity" value="' . $tocity . '">
State:<input type=text name="tostate" value="' . $tostate . '">
Zip:<input type=text name="tozip" value="' . $tozip . '">
<input type=submit value="Search">
</form>';

if ( strlen ( $fromzip . $tozip ) == 10 ) {
echo '&lt;map:' . $fromzip . '-' . $tozip . '&gt;<br>' .
'<a href="http://maps.google.com/maps?q=http://www.pilotsnpaws.org/forum/phpbb_kml2.php?fromzip=' . $fromzip . $tozip . '">';
echo "Display Map of Pilots between $fromcity $fromstate and $tocity $tostate</a><br>" .
'<a href="http://maps.google.com/maps?q=http://www.pilotsnpaws.org/forum/phpbb_kml3.php?fromzip=' . $fromzip . $tozip . '">';
echo "Display Map of Volunteers between $fromcity $fromstate and $tocity $tostate</a><br>" .
'<a href="http://maps.google.com/maps?q=http://www.pilotsnpaws.org/forum/phpbb_kmlb.php?fromzip=' . $fromzip . $tozip . '">';
echo "Display Map of Volunteers and Pilots between $fromcity $fromstate and $tocity $tostate</a><br>" .
 ' ';
echo '<a href="http://www.pilotsnpaws.org/forum/phpbb_kml2.php?fromzip=' . $fromzip . $tozip . '&mode=email">';
echo "List Email Addresses of Pilots between $fromcity $fromstate and $tocity $tostate</a><br>" ;

}
echo ' 
</body>
</html>';
?>


