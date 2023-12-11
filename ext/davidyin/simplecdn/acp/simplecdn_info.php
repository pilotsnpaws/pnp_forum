<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\acp;

class simplecdn_info
{
	function module()
	{
		return array(
			'filename'	=> '\davidyin\simplecdn\acp\simplecdn_module',
			'title'		=> 'ACP_SIMPLECDN',
			'modes'		=> array(
				'config'	=> array(
					'title'	=> 'ACP_SIMPLECDN_CONFIG', 
					'auth'	=> 'ext_davidyin/simplecdn && acl_a_board', 
					'cat'	=> array('ACP_SIMPLECDN')
				),
			),
		);
	}
}
