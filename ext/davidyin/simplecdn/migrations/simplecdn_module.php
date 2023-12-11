<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\migrations;

class simplecdn_module extends \phpbb\db\migration\migration
{
	
	public function update_data()
	{
		return array(
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_SIMPLECDN')),
			array('module.add', array('acp', 'ACP_SIMPLECDN', 
				array(
					'module_basename'	=> '\davidyin\simplecdn\acp\simplecdn_module',
					'modes'	=> array('config'),
				),
			)),
		);
	}
}
