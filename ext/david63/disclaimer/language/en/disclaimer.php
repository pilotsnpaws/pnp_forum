<?php
/**
*
* @package Disclaimer Extension
* @copyright (c) 2014 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'DISCLAIMER'				=> 'Disclaimer',
	'DISCLAIMER_TEXT'			=> '<h3>Board Disclaimer</h3>
	<p>	The views and comments entered in these forums are personal and are not those of Pilots N Paws. Rescue flights are the responsibility of the sending and receiving parties and pilots. Pilots N Paws is an electronic meeting place for those seeking to make arrangements for rescue flights. Pilots N Paws does not arrange all rescue flights, coordinate transports and/or rescue animals. Pilots volunteer their time and aircraft to the sending and receiving parties. Pilots N Paws is not responsible or liable for the conduct of any pilots or flights. Compliance with applicable law and the conduct of flights are the responsibility and liability of the sending and receiving parties and pilots.</p>',
));

?>