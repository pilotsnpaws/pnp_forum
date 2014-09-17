<HTML>
<?php
/**
*
* @package phpBB3
* @version $Id: cron.php 8479 2008-03-29 00:22:48Z naderman $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/
define('IN_PHPBB', true);
define('IN_CRON', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Flush here to prevent browser from showing the page as loading while running cron.
//flush();


	echo '<div>' ;
	echo '  email package size: ', $config['email_package_size'] ;
	echo '<div>' ;
	echo 'email queue interval: ', $config['queue_interval'] ;
	echo '</div>' ;
	echo '<div>' ;
	echo 'current time: ', date('r'); 
	if (file_exists('cache/queue.php')) 
		{
		 	$queue_formatted_before = number_format(filesize('cache/queue.php'),0,'.',',') ; 
			echo '<div>queue.php before: ', $queue_formatted_before, ' bytes' ;
			logEvent('queue size: ' . $queue_formatted_before . ' bytes');
		} else
		{
			echo '<div>queue.php does not exist. which means there is no pending mail!' ;	
			logEvent('queue size: 0 bytes');
		}
	echo '</div>' ;
	echo '<div>' ;
	echo 'last_queue_run = ' ;
	echo date('r',$config['last_queue_run']) ;
	echo '</div>' ;
	echo 'cron_lock = ' ;
	echo date('r',$config['cron_lock']) ;
	echo '<div>' ;
	//Include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
	//$queue = new queue();

	echo '<div>' ;
	echo '</div>' ;

function logEvent($message) {
    if ($message != '') {
        // Add a timestamp to the start of the $message
        $message = date("Y/m/d H:i:s").': '.$message;
        $fp = fopen('../../papertrail_logging/events.log', 'a');
        fwrite($fp, $message."\n");
        fclose($fp);
    }
}

	
?>
</HTML>
