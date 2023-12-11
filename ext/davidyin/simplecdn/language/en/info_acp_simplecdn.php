<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}
if (empty($lang) || !is_array($lang))
{
   $lang = array();
}

$lang = array_merge($lang, array(
	'ACP_SIMPLECDN'					=> 'Simple CDN',
	'SIMPLECDN_CONFIG'				=> 'Simple CDN Settings',
	'ACP_SIMPLECDN_CONFIG'			=> 'Simple CDN',
	'ACP_SIMPLECDN_CONFIG_EXPLAIN'	=> 'This is configuration page for the Simple CDN extension. The URL of static resources will be served from CDN below. AWS Cloudfront is suported.',
	'ACP_SIMPLECDN_CONFIG_SET'		=> 'Configuration',
	'SIMPLECDN_CONFIG_SAVED'		=> 'Simple CDN settings saved',
	'SIMPLECDN_ENABLE'				=> 'Enable Simple CDN',
	'SIMPLECDN_ENABLE_EXPLAIN'		=> 'Do you want to enable the Simple CDN EXT?',
	'SIMPLECDN_FILE_ENABLE'			=> 'Enable File CDN',
	'SIMPLECDN_FILE_ENABLE_EXPLAIN'	=> 'Enable it only when your forum is an open forum. Do not turn on it if your forum is accessed by registered user only.',	
	'SIMPLECDN_URL'					=> 'Simple CDN URL',
	'SIMPLECDN_URL_EXPLAIN'			=> 'Enter the full URL of the CDN. The URL should be starting with //, and ending with /. E.g. //cdn.cloudfront.net/.',
	'SIMPLECDN_URL_PLACEHOLDER'		=> '//cdn.cloudfront.net/',
));
