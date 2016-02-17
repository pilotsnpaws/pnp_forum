<?php
function xmlspecialchars($text) {
   return str_replace('-' , ' ' , str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES)));
}

echo '<html><body>';

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
         . ' where phpbb_topics.forum_id = 5 and ' 
         . ' phpbb_posts.post_id = phpbb_topics.topic_first_post_id and '
         . ' unix_timestamp() - phpbb_topics.topic_last_post_time < 86400 * 7 * 3 and '
         . ' phpbb_posts.post_text like "%map:_____-_____%" ';
$result=mysql_query($query) or die ( $query );
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

            $kommand = 'update phpbb_topics set pnp_sendzip = "' . $fromzip . '",pnp_reczip = "' . $tozip . '" where topic_id = ' . $topic_id . ';';
$xx = mysql_query($kommand) or die ( $kommand );
echo $kommand . $xx . "<br>";
          }
            $h++;
      }
      $i++;
}
echo '</body></html>';
?>
