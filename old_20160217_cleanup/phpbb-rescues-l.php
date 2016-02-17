<?php
function xmlspecialchars($text) {
   return str_replace('-' , ' ' , str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES)));
}



include ( "../forum/config.php");
$kount = 0;
$username=$dbuser;
$password=$dbpasswd;
$database=$dbname;
$server=$dbhost;
$dbg=$_GET[dbg];
$defcolor=$_GET[color];
$limit=$_GET[limit];
$forum=$_GET[forum];
if ( $forum == "" ) $forum = 5;
if ( $limit == "" ) $limit = 5000;
if ( $defcolor == "" ) $defcolor = "blue";
$width=$_GET[width];
if ( $width == "" ) $width = 1;
$age = 365;
if ( $forum == 5 ) $age = 30;
$con = mysql_connect($dbhost,$dbuser,$dbpasswd)or die( "Unable to connect to database");
			@mysql_select_db($dbname) or die( "Unable to select database");
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
         . ' phpbb_topics.topic_id , '
         . ' phpbb_topics.topic_title , '
         . ' phpbb_topics.forum_id,  '
         . ' phpbb_topics.topic_time '
         . ' from phpbb_topics , '
         . ' phpbb_posts '
         . ' where phpbb_topics.forum_id = ' . $forum . ' and ' 
         . ' phpbb_posts.post_id = phpbb_topics.topic_first_post_id and '
         . ' unix_timestamp() - phpbb_topics.topic_last_post_time < 86400 * ' . $age . ' and '
         . ' phpbb_posts.post_text like "%map:_____-_____%" ';
if ( $dbg == "yes" ) $echodata =  $query;
$result=mysql_query($query) or die ( $query );
if ( $dbg <> "yes" ) header('Content-type: application/vnd.google-earth.kml+xml');
$echodata =  '<?xml version="1.0" encoding="UTF-8"?>
      <kml xmlns="http://earth.google.com/kml/2.2">
      <Document>
      <name>Pilots N Paws - Transport Requests</name>
    
      <Style id="red1"><LineStyle><color>ff0000ff</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="red2"><LineStyle><color>7f0000ff</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="red3"><LineStyle><color>3f0000ff</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="green1"><LineStyle><color>ff00ff00</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="green2"><LineStyle><color>7f00ff00</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="green3"><LineStyle><color>3f00ff00</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="blue1"><LineStyle><color>ffff0000</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="blue2"><LineStyle><color>7fff0000</color><width>' . $width . '</width></LineStyle></Style>
      <Style id="blue3"><LineStyle><color>3fff0000</color><width>' . $width . '</width></LineStyle></Style>

';



$myFile = "phpbb_rescues.kml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $echodata);
echo $echodata;



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
            if ( $dbg == "yes") $echodata =  $query;
            $zresult=mysql_query($query);
	    if ( $dbg == "yes")  $echodata =  mysql_numrows($zresult);
            if ( mysql_numrows($zresult) > 0 ) {
               $fromlat = mysql_result($zresult,0,"lat");
               $fromlon = mysql_result($zresult,0,"lon");
            }
            $query='select lat , lon from zipcodes where zip="' . $tozip . '"';
            $query='select lat , lon from zipcodes where zip="' . $tozip . '"';
            if ( $dbg == "yes")  $echodata =  ' ' . $query . ' ';
            $zresult=mysql_query($query);
	    if ( $dbg == "yes")  $echodata =  mysql_numrows($zresult);
            if ( mysql_numrows($zresult) > 0 ) {
               $tolat = mysql_result($zresult,0,"lat");
               $tolon = mysql_result($zresult,0,"lon");
            }
            if ( $fromlon <> 0 )
            if ( $fromlat <> 0 )
            if ( $tolon <> 0 )
            if ( $tolat <> 0 )
            {
            $color = $defcolor;
            $age = "3";
            if (  ( time() - $topic_time ) / 86400 < 7  ) $age = "2";
            if ( ( time() - $topic_time ) / 86400 < 2 ) $age = "1";
            if ( substr ( $post_text , $h + 16 , 3 ) == "red" ) $color = "red";
            if ( substr ( $post_text , $h + 16 , 5 ) == "green" ) $color = "green";
            if ( $dbg == "yes" ) {
               $echodata =  'time=' ;
               $echodata =   time() ; 
               $echodata =  ' topic_time=' ; 
               $echodata =   $topic_time ; 
               $echodata =  ' age in seconds=' ; 
               $echodata =  time() - $topic_time;
               $echodata =  ' age in days ';
               $echodata =  ( time() - $topic_time ) / 86400 ;
              }
if ( distance( $fromlat, $fromlon, $tolat, $tolon ) < $limit ) {
            $kount++;
            $echodata =  '<Placemark>'
                 . '<name>'
                 . $clean_subject 
                 . '</name><description><![CDATA[<div="ltr"><br>'
                 . $clean_text 
                 . '<br><br><br>';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '<a href="http://pilotsnpaws.org/forum/viewtopic.php?f=' . $forum . '&amp;t=';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  $topic_id
              . '&amp;p='
               . $post_id;
fwrite($fh, $echodata);
echo $echodata;

	    $echodata =  '">View Post';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '</a>'; 
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '<br><br></div>]]>'; 
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  ' </description>';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '<styleUrl>#' . $color . $age . '</styleUrl>';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '<LineString>
                  <extrude>1</extrude>
                  <tessellate>1</tessellate>
                  <altitudeMode>absolute</altitudeMode>
                  <coordinates>';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  " $fromlon , $fromlat , 0 ";
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  ' ';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  "$tolon , $tolat , 0 ";
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  ' ';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '</coordinates>
                 </LineString>
                  </Placemark>';
fwrite($fh, $echodata);
echo $echodata;
}
            }
            }
            $h++;
      }
      $i++;
}
$echodata =  '<description>
      <![CDATA[' . $kount . ' Transports Under ' . $limit . ' NM]]>
      </description>
</Document></kml>';
fwrite($fh, $echodata);
echo $echodata;

fclose($fh);

?>
