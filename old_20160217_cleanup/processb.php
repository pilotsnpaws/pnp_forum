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





$query =   ' select '
         . ' phpbb_posts.post_subject , '
         . ' phpbb_posts.post_id , '
         . ' phpbb_posts.post_text , ' 
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

echo '</th></tr><tr><td>';
echo date("l dS \of F Y h:i:s A", mysql_result($messagelist,$rownum,"phpbb_topics.topic_time" ));
echo "</td></tr><tr><td>";
echo mysql_result($messagelist,$rownum,"phpbb_posts.post_text");
echo '</td></tr></table>';

if ( strlen ( $fromzip . $tozip ) == 10 ) {
echo '
<form action="process.php" method="post">
<input type=hidden name=postid value="' . 
mysql_result($messagelist,$rownum,"phpbb_posts.post_id") . '">
<input type=hidden name=rownum value="' . $rownum . '">
<input type=submit name=maptag value="[map:' . $fromzip . '-' . $tozip . ']"></form>
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


