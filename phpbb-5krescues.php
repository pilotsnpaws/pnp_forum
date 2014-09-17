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
         . ' phpbb_topics.topic_time, '
         . ' phpbb_topics.pnp_sendzip, '
         . ' phpbb_topics.pnp_reczip '
         . ' from phpbb_topics , '
         . ' phpbb_posts '
         . ' where phpbb_topics.forum_id = 15 and ' 
         . ' phpbb_posts.post_id = phpbb_topics.topic_first_post_id and '
         . ' phpbb_posts.post_id = phpbb_topics.topic_last_post_id  ';
if ( $dbg == "yes" ) $echodata =  $query;
$result=mysql_query($query) or die ( $query );
if ( $dbg <> "yes" ) header('Content-type: application/vnd.google-earth.kml+xml');
$echodata =  '<?xml version="1.0" encoding="UTF-8"?>
      <kml xmlns="http://earth.google.com/kml/2.2">
      <Document>
      <name>PNP5000  - Transport Requests</name>
      <description>
      <![CDATA[PNP5000  - Transport Requests www.pilotsnpaws.org]]>
      </description>
      <Style id="red1"><LineStyle><color>ff0000ff</color><width>1</width></LineStyle></Style>
      <Style id="red2"><LineStyle><color>7f0000ff</color><width>1</width></LineStyle></Style>
      <Style id="red3"><LineStyle><color>3f0000ff</color><width>1</width></LineStyle></Style>
      <Style id="green1"><LineStyle><color>ff00ff00</color><width>1</width></LineStyle></Style>
      <Style id="green2"><LineStyle><color>7f00ff00</color><width>1</width></LineStyle></Style>
      <Style id="green3"><LineStyle><color>3f00ff00</color><width>1</width></LineStyle></Style>
      <Style id="blue1"><LineStyle><color>ffff0000</color><width>1</width></LineStyle></Style>
      <Style id="blue2"><LineStyle><color>7fff0000</color><width>1</width></LineStyle></Style>
      <Style id="blue3"><LineStyle><color>3fff0000</color><width>1</width></LineStyle></Style>

';



$myFile = "phpbb_5krescues.kml";
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


            $fromzip = mysql_result($result,$i,"phpbb_topics.pnp_sendzip");
            $tozip = mysql_result($result,$i,"phpbb_topics.pnp_reczip");
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
            $color = "blue";
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
            $echodata =  '<Placemark>'
                 . '<name>'
                 . $clean_subject 
                 . '</name><description><![CDATA[<div="ltr"><br>'
                 . $clean_text 
                 . '<br><br><br>';
fwrite($fh, $echodata);
echo $echodata;

            $echodata =  '<a href="http://pilotsnpaws.org/forum/viewtopic.php?f=5&amp;t=';
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
      $i++;
}
$echodata =  '</Document></kml>';
fwrite($fh, $echodata);
echo $echodata;

fclose($fh);

?>
