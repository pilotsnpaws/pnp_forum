<?php
function xmlspecialchars($text) {
   return str_replace('-' , ' ' , str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES)));
}



include ( "../forum/config.php");

$username=$dbuser;
$password=$dbpasswd;
$database=$dbname;
$server=$dbhost;
$dbg=$_GET[dbg];
$color=$_GET[color];
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");			@mysql_select_db($dbname) or die( "Unable to select database");



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
         . ' phpbb_posts.post_text like "%map:_____-_____%" ';
if ( $dbg == "yes" ) echo $query;
$result=mysql_query($query) or die ( $query );
if ( $dbg <> "yes" ) header('Content-type: application/vnd.google-earth.kml+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>
      <kml xmlns="http://earth.google.com/kml/2.2">
      <Document>
      <name>Pilots N Paws - Transport Requests</name>
      <description>
      <![CDATA[Pilots N Paws - Transport Requests www.pilotsnpaws.org]]>
      </description>
      <Style id="red1"><LineStyle><color>ff0000ff</color><width>4</width></LineStyle></Style>
      <Style id="red2"><LineStyle><color>7f0000ff</color><width>4</width></LineStyle></Style>
      <Style id="red3"><LineStyle><color>3f0000ff</color><width>4</width></LineStyle></Style>
      <Style id="green1"><LineStyle><color>ff00ff00</color><width>4</width></LineStyle></Style>
      <Style id="green2"><LineStyle><color>7f00ff00</color><width>4</width></LineStyle></Style>
      <Style id="green3"><LineStyle><color>3f00ff00</color><width>4</width></LineStyle></Style>
      <Style id="blue1"><LineStyle><color>ffff0000</color><width>4</width></LineStyle></Style>
      <Style id="blue2"><LineStyle><color>7fff0000</color><width>4</width></LineStyle></Style>
      <Style id="blue3"><LineStyle><color>3fff0000</color><width>4</width></LineStyle></Style>

';

$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
      $post_id = mysql_result($result,$i,"phpbb_posts.post_id");
      $forum_id = mysql_result($result,$i,"phpbb_topics.forum_id");
      $topic_id = mysql_result($result,$i,"phpbb_topics.topic_id");
      $post_text = mysql_result($result,$i,"phpbb_posts.post_text");
      $topic_time = mysql_result($result,$i,"phpbb_topics.topic_time");
      $post_subject = mysql_result($result,$i,"phpbb_posts.post_subject");
      $haystack = " abcdefghijklmnopqrswtuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $h=0;
      $clean_subject = "";
      while ($h < strlen ( $post_subject ) ) {
            $needle = substr ( $post_subject , $h , 1 );
            if ( strpos( $haystack , $needle )  !== false )  $clean_subject = $clean_subject . $needle ;
            $h++;
      }
      $h=0;
      $clean_text = "";
      while ($h < min(200,strlen ( $post_text )) ) {
            $needle = substr ( $post_text , $h , 1 );
            if ( strpos( $haystack , $needle )   !== false  ) $clean_text = $clean_text . $needle ;
            $h++;
      }
      $h=0;
      while ($h < strlen ( $post_text )  ) {
            if ( substr($post_text , $h , 4) == "map:" ) 
            if ( substr ( $post_text , $h + 9 , 1 ) == "-" )  

            {
            $fromzip=substr($post_text , $h + 4 , 5 ) . substr($post_text , $h + 10 , 5 );
	    $tozip = substr ( $fromzip , 5 , 5  );
	    $fromzip = substr ( $fromzip , 0 , 5 ) ;
            $fromlat = 0;
            $tolat = 0;
            $fromlon = 0;
            $tolon = 0;
	    $query='select lat , lon from zipcodes where zip="' . $fromzip . '"';
            if ( $dbg == "yes") echo $query;
            $zresult=mysql_query($query);
	    if ( $dbg == "yes")  echo mysql_numrows($zresult);
            if ( mysql_numrows($zresult) > 0 ) {
               $fromlat = mysql_result($zresult,0,"lat");
               $fromlon = mysql_result($zresult,0,"lon");
            }
            $query='select lat , lon from zipcodes where zip="' . $tozip . '"';
            $query='select lat , lon from zipcodes where zip="' . $tozip . '"';
            if ( $dbg == "yes")  echo ' ' . $query . ' ';
            $zresult=mysql_query($query);
	    if ( $dbg == "yes")  echo mysql_numrows($zresult);
            if ( mysql_numrows($zresult) > 0 ) {
               $tolat = mysql_result($zresult,0,"lat");
               $tolon = mysql_result($zresult,0,"lon");
            }
            if ( $fromlon <> 0 )
            if ( $fromlat <> 0 )
            if ( $tolon <> 0 )
            if ( $tolat <> 0 )
            {
            $color = "blue";
            $age = "3";
            if (  ( time() - $topic_time ) / 86400 < 7  ) $age = "2";
            if ( ( time() - $topic_time ) / 86400 < 2 ) $age = "1";
            if ( substr ( $post_text , $h + 16 , 3 ) == "red" ) $color = "red";
            if ( substr ( $post_text , $h + 16 , 5 ) == "green" ) $color = "green";
            if ( $dbg == "yes" ) {
               echo 'time=' ;
               echo  time() ; 
               echo ' topic_time=' ; 
               echo  $topic_time ; 
               echo ' age in seconds=' ; 
               echo time() - $topic_time;
               echo ' age in days ';
               echo ( time() - $topic_time ) / 86400 ;
              }
            echo '<Placemark>'
                 . '<name>'
                 . $clean_subject 
                 . '</name><description><![CDATA[<div="ltr"><br>'
                 . $clean_text 
                 . '<br><br><br>';
            echo '<a href="http://pilotsnpaws.org/forum/viewtopic.php?f=5&amp;t=';
            echo $topic_id
              . '&amp;p='
               . $post_id;
	    echo '">View Post';
            echo '</a>'; 
            echo '<br><br></div>]]>'; 
            echo ' </description>';
            echo '<styleUrl>#' . $color . $age . '</styleUrl>';
            echo '<LineString>
                  <extrude>1</extrude>
                  <tessellate>1</tessellate>
                  <altitudeMode>absolute</altitudeMode>
                  <coordinates>';
            echo " $fromlon , $fromlat , 0 ";
            echo ' ';
            echo "$tolon , $tolat , 0 ";
            echo ' ';
            echo '</coordinates>
                 </LineString>
                  </Placemark>';
            }
            }
            $h++;
      }
      $i++;
}
echo '</Document></kml>';
?>
