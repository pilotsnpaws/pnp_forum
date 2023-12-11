<?php

/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\migrations;

class v_1_0_6 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['simplecdn_version']) && version_compare($this->config['simplecdn_version'], '1.0.6', '>=');
	}

	static public function depends_on()
	{
		return array('\davidyin\simplecdn\migrations\v_1_0_5');
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.update', array('simplecdn_version', '1.0.6')),
		);
	}
}
