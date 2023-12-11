<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\migrations;

class simplecdn_schema extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('simplecdn_enable', '')),
			array('config.add', array('simplecdn_url', '')),
			array('config.add', array('simplecdn_file_enable', '')),
			array('config.add', array('simplecdn_version', '1.0.2')),
		);
	}
}
