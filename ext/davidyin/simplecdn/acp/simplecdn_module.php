<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\acp;

class simplecdn_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $user, $template, $request, $config;
		
		$this->tpl_name = 'acp_simplecdn_config';
		$this->page_title = $user->lang['SIMPLECDN_CONFIG'];
		add_form_key('acp_simplecdn_config');

		$submit = $request->is_set_post('submit');
		if ($submit)
		{
			if (!check_form_key('acp_simplecdn_config'))
			{
				trigger_error('FORM_INVALID');
			}
			$config->set('simplecdn_enable', $request->variable('simplecdn_enable', 0));
			$config->set('simplecdn_url', $request->variable('simplecdn_url', ''));
			$config->set('simplecdn_file_enable', $request->variable('simplecdn_file_enable', 0));


			trigger_error($user->lang['SIMPLECDN_CONFIG_SAVED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
			'SIMPLECDN_VERSION'			=> $config['simplecdn_version'],
			'SIMPLECDN_ENABLE'			=> (!empty($config['simplecdn_enable'])) ? true : false,
			'SIMPLECDN_URL'				=> $config['simplecdn_url'],
			'SIMPLECDN_FILE_ENABLE'		=> (!empty($config['simplecdn_file_enable'])) ? true : false, 
			'U_ACTION'	=> $this->u_action,
		));

	}
}
