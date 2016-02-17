<?php
echo '<head>';
$fromcity=$_POST[fromcity];
$fromstate=$_POST[fromstate];
$fromzip=$_POST[fromzip];
$tocity=$_POST[tocity];
$tostate=$_POST[tostate];
$tozip=$_POST[tozip];
$rownum=$_POST[rownum];
$maptag=$_POST[maptag];
$postid=$_POST[postid];
include ( "../forum/config.php");
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");			@mysql_select_db($dbname) or die( "Unable to select database");
if ( $postid > " " ) if ( $maptag > " " ) 
{
$query = 'update phpbb_posts set post_text = concat(post_text," ' 
         . $maptag 
         . '") where post_id=' . $postid ;
$nada = mysql_query($query);
}
function distance($lat1, $lon1, $lat2, $lon2) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60;
  return ($miles); 
}




$query =   ' select '
         . ' phpbb_posts.post_subject , '
         . ' phpbb_posts.post_id , '
         . ' phpbb_posts.post_text , '
         . ' phpbb_posts.bbcode_uid , ' 
         . ' phpbb_topics.topic_id , '
         . ' phpbb_topics.topic_title , '
         . ' phpbb_topics.forum_id,  '
         . ' phpbb_topics.topic_time '
         . ' from phpbb_topics , '
         . ' phpbb_posts '
         . ' where phpbb_topics.forum_id = 5 and ' 
         . ' phpbb_posts.post_id = phpbb_topics.topic_first_post_id and '
         . ' unix_timestamp() - phpbb_topics.topic_last_post_time < 86400 * 7 * 3 and '
         . ' phpbb_posts.post_text NOT like "%map:_____-_____%" order by phpbb_posts.post_id desc';
$messagelist=mysql_query($query);
$msgnum=mysql_numrows($messagelist);
$rownum = max ( min ( $rownum , $msgnum - 1 ) , 0 );


if ($fromzip > " " ) {
   $query = "select city , state , lat , lon from zipcodes where zip = $fromzip";
   $result=mysql_query($query);
   $num=mysql_numrows($result);
   if ($num > 0) { 
                   $fromcity = mysql_result($result,0,"city");
                   $fromstate = mysql_result($result,0,"state");
                   $fromlat = mysql_result($result,0,"lat");
                   $fromlon = mysql_result($result,0,"lon");
				   }
	   else { 
	          $fromcity = "" ;
	          $fromstate = "" ;
                  $fromlat = 0;
                  $fromlon = 0;
		}
	}
	else
	if ( $fromcity > " " ) if ( $fromstate > " " ) {
	   $query = 'select zip , lat , lon from zipcodes where city like "' . $fromcity . '" and state like "' . $fromstate . '"';
	   $result=mysql_query($query);
	   if (mysql_numrows($result) > 0 ) {
               $fromzip = mysql_result($result,0,"zip");
               $fromlat = mysql_result($result,0,"lat");
               $fromlon = mysql_result($result,0,"lon");
              }
	   else
	   $fromzip = "";
	   }
if ($tozip > " " ) {
   $query = "select city , state , lon , lat from zipcodes where zip = $tozip";
   $result=mysql_query($query);
   $num=mysql_numrows($result);
   if ($num > 0) { $tocity = mysql_result($result,0,"city");
                   $tostate = mysql_result($result,0,"state");
                   $tolon = mysql_result($result,0,"lon");
                   $tolat = mysql_result($result,0,"lat");
				   }
	   else { $tocity = "" ;
	         $tostate = "" ;
                 $tolon = 0;
                 $tolat = 0;
		}
	}
	else
	if ( $tocity > " " ) if ( $tostate > " " ) {
	  	   $query = 'select zip , lat , lon from zipcodes where city like "' . $tocity . '" and state like "' . $tostate . '"';
	  
	   $result=mysql_query($query);
	   if (mysql_numrows($result) > 0 ) {
                 $tozip = mysql_result($result,0,"zip");
               $tolat = mysql_result($result,0,"lat");
               $tolon = mysql_result($result,0,"lon");
            }
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
<form action="process.php" method="post">
<input type=hidden name=rownum value="' . $rownum . '">
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
echo '<table><tr><th width=50%>';
echo mysql_result($messagelist,$rownum,"phpbb_posts.post_subject");
$bbcode_uid = mysql_result($messagelist,$rownum,"phpbb_posts.bbcode_uid");
echo '</th></tr><tr><td>';
echo date("l dS \of F Y h:i:s A", mysql_result($messagelist,$rownum,"phpbb_topics.topic_time" ));
echo "</td></tr><tr><td>";
echo mysql_result($messagelist,$rownum,"phpbb_posts.post_text");
echo '</td></tr></table>';
$echodist = (int)  distance($fromlat,$fromlon,$tolat,$tolon);
if ( strlen ( $fromzip . $tozip ) == 10 ) {
echo '
<form action="process.php" method="post">
<input type=hidden name=postid value="' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '">
<input type=hidden name=rownum value="' . $rownum . '">
<input type=submit name=maptag value="[map:' . $fromzip . '-' . $tozip .
'][/map]"></form> '. $echodist .'  ' . '[map:' . $fromzip . '-' . $tozip .
'][/map]<br>
<form action="process.php" method="post">
<input type=hidden name=postid value="' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '">
<input type=hidden name=rownum value="' . $rownum . '">
<input type=submit name=maptag value="[map:' . $fromzip . '-' . $tozip . '-red]"></form>
<form action="process.php" method="post">
<input type=hidden name=postid value="' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '">
<input type=hidden name=rownum value="' . $rownum . '">
<input type=submit name=maptag value="[map:' . $fromzip . '-' . $tozip . '-green]"></form>';

echo '<form action="http://www.pilotsnpaws.org/forum/posting.php?mode=edit&f=5&p=' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '" target = "_blank">
<input type=submit name="Edit Post"></form>';


echo '<a href="http://www.pilotsnpaws.org/forum/posting.php?mode=edit&f=5&p=' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '" target = "_blank">
Edit Post </a>';


}



if ( $rownum > 0 ) {
echo  '<br>
<form action="process.php" method="post">
<input type=hidden name=rownum value="';
echo  $rownum - 1 ;
echo '"><input type=submit value = "Previous"></form>';
}
if ( $rownum < $msgnum - 1 ) {
echo '<br>
<form action="process.php" method="post">
<input type=hidden name=rownum value="';
echo  $rownum + 1 ;
echo '">
<input type=submit value = "Next"></form>';
}
echo ' 
</body>
</html>';
?>


