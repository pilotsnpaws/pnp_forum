<?php
/**
*
* @package phpBB Extension - Simple CDN
* @copyright (c) David Yin <https://www.phpbbchinese.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace davidyin\simplecdn\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header_after'					=> 'modify_header_static_to_cdn',
			'core.generate_smilies_before'				=> 'modify_smilies_posting_to_cdn',
			'core.get_avatar_after'						=> 'modify_avatar_to_cdn',
			'core.display_forums_modify_template_vars'	=> 'modify_forum_image_to_cdn',
			'core.viewtopic_modify_post_row'			=> 'modify_post_to_cdn',
			'core.get_user_rank_after'					=> 'modify_user_rank_to_cdn',
		);
	}
	
	protected $template;

	protected $config;
	
	protected $user;

	
	public function __construct(\phpbb\template\template $template, \phpbb\config\config $config, \phpbb\user $user)
	{

		$this->template = $template;
		$this->config = $config;
		$this->user = $user;
	}


	// Modify the css and js files to use CDN
	public function modify_header_static_to_cdn($event)
	{
		$this->template->assign_vars(array(
		'SIMPLECDN_ENABLE'		=> $this->config['simplecdn_enable'] ? true : false,
		'SIMPLECDN_URL'			=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',


		));
		
		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{
			$this->template->assign_vars(array(
				'T_ASSETS_PATH'			=>  $this->config['simplecdn_url']."assets",
				'T_THEME_PATH'			=>  $this->config['simplecdn_url'] ."styles/". rawurlencode($this->user->style['style_path']) . '/theme',
				'T_TEMPLATE_PATH'		=>  $this->config['simplecdn_url']."styles/" . rawurlencode($this->user->style['style_path']) . '/template',
				'T_STYLESHEET_LINK'		=>  $this->config['simplecdn_url']."styles/" . rawurlencode($this->user->style['style_path']) . '/theme/stylesheet.css?assets_version=' .  $this->config['assets_version'],
				'T_STYLESHEET_LANG_LINK'    => $this->config['simplecdn_url']."styles/" . rawurlencode($this->user->style['style_path']) . '/theme/' . $this->user->lang_name . '/stylesheet.css?assets_version=' . $this->config['assets_version'],

				'T_SUPER_TEMPLATE_PATH'	=> $this->config['simplecdn_url']."styles/" . rawurlencode($this->user->style['style_path']) . '/template',
				'T_IMAGES_PATH'			=> $this->config['simplecdn_url']."images/",
				'T_SMILIES_PATH'		=> $this->config['simplecdn_url']. $this->config['smilies_path']."/",	
				'T_AVATAR_PATH'			=> $this->config['simplecdn_url']. $this->config['avatar_path']."/",
				'T_AVATAR_GALLERY_PATH'	=> $this->config['simplecdn_url']. $this->config['avatar_gallery_path']."/",
				'T_ICONS_PATH'			=> $this->config['simplecdn_url']. $this->config['icons_path']."/",
				'T_RANKS_PATH'			=> $this->config['simplecdn_url']. $this->config['ranks_path']."/",
				'T_UPLOAD_PATH'			=> $this->config['simplecdn_url']. $this->config['upload_path']."/",			

				'T_JQUERY_LINK'			=> !empty($this->config['allow_cdn']) && !empty($this->config['load_jquery_url']) ? $this->config['load_jquery_url'] : $this->config['simplecdn_url']."assets/javascript/jquery.min.js?assets_version=" . $this->config['assets_version'],
				'T_FONT_AWESOME_LINK'	=> !empty($this->config['allow_cdn']) && !empty($this->config['load_font_awesome_url']) ? $this->config['load_font_awesome_url'] : $this->config['simplecdn_url']."assets/css/font-awesome.min.css?assets_version=" . $this->config['assets_version'],

			
			));
		
		}
	}

	// Modify smilies on posting page to use CDN
	public function modify_smilies_posting_to_cdn($event)
	{
		$this->template->assign_vars(array(
			'SIMPLECDN_ENABLE'	=> $this->config['simplecdn_enable'] ? true : false,
			'SIMPLECDN_URL'		=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',
		));
		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{

			$event['root_path'] = $this->config['simplecdn_url'];

		}
	}
	
	// Modify the avatar on profile and viewtopic page to use CDN
	public function modify_avatar_to_cdn($event)
	{
		$this->template->assign_vars(array(
			'SIMPLECDN_ENABLE'	=> $this->config['simplecdn_enable'] ? true : false,
			'SIMPLECDN_URL'		=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',
		));
		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{
			$substring_localurl 	= '<img class="avatar" src="./';
			$substring_cdn			= '<img class="avatar" src="'.$this->config["simplecdn_url"].'';
			if (strpos($event['html'], $substring_localurl) !== false)
			{
				$event['html'] = str_replace($substring_localurl, $substring_cdn, $event['html']);
			}
		}
	}
	
	// Modify the forum image on viewforum page to use CDN
	public function modify_forum_image_to_cdn($event)
	{
		$this->template->assign_vars(array(
			'SIMPLECDN_ENABLE'	=> $this->config['simplecdn_enable'] ? true : false,
			'SIMPLECDN_URL'		=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',
		));

		if ( $this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{
			$substring_localurl 	= '<img src="./';
			$substring_cdn			= '<img src="'.$this->config["simplecdn_url"].'';
			$forum_row = $event['forum_row'];
			if (strpos($forum_row['FORUM_IMAGE'], $substring_localurl) !== false)
			{
				$forum_row['FORUM_IMAGE'] = str_replace($substring_localurl, $substring_cdn, $forum_row['FORUM_IMAGE']);
				$event['forum_row'] =$forum_row;
			}
		}
	}
	
	// Modify any local resource to use CDN at viewtopic pages
	public function modify_post_to_cdn($event)
	{
		$this->template->assign_vars(array(
			'SIMPLECDN_ENABLE'		=> $this->config['simplecdn_enable'] ? true : false,
			'SIMPLECDN_URL'			=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',
			'SIMPLECDN_FILE_ENABLE'	=> $this->config['simplecdn_file_enable'] ? true : false,
		));

		// When only smilies using CDN
		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{
			$substring_localurl		= '<img class="smilies" src="./';
			$substring_cdn			= '<img class="smilies" src="'.$this->config["simplecdn_url"].'';
			$post_row				= $event['post_row'];
			// In the post content
			if (strpos($post_row['MESSAGE'], $substring_localurl) !== false)
			{
				$post_row['MESSAGE'] = str_replace($substring_localurl, $substring_cdn, $post_row['MESSAGE']);
				$event['post_row'] = $post_row;
			}
			// In the signature
			if (strpos($post_row['SIGNATURE'], $substring_localurl) !== false)
			{
				$post_row['SIGNATURE'] = str_replace($substring_localurl , $substring_cdn , $post_row['SIGNATURE']);
				$event['post_row'] = $post_row;
			}
		}
		
		// When File CDN enabled, the attachments which are put inline are using CDN
		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']) && $this->config['simplecdn_file_enable'])
		{
			// Attached picture
			$substring_localurl		= '<img src="./';
			$substring_cdn			= '<img src="'.$this->config["simplecdn_url"].'';
			$post_row				= $event['post_row'];
			if (strpos($post_row['MESSAGE'], $substring_localurl) !== false)
			{
				$post_row['MESSAGE'] = str_replace($substring_localurl, $substring_cdn, $post_row['MESSAGE']);
				$event['post_row'] = $post_row;
			}
			// Attached downloadable file
			$substring_localurl		= '<a class="postlink" href="./';
			$substring_cdn			= '<a class="postlink" href="'.$this->config["simplecdn_url"].'';
			if (strpos($post_row['MESSAGE'], $substring_localurl) !== false)
			{
				$post_row['MESSAGE'] = str_replace($substring_localurl, $substring_cdn, $post_row['MESSAGE']);
				$event['post_row'] = $post_row;
			}
		}
	}
	
	// Modify the rank in user profile to use CDN
	public function modify_user_rank_to_cdn($event)
	{
		$this->template->assign_vars(array(
			'SIMPLECDN_ENABLE'	=> $this->config['simplecdn_enable'] ? true : false,
			'SIMPLECDN_URL'		=> (isset($this->config['simplecdn_url'])) ? $this->config['simplecdn_url'] : '',
		));

		if ($this->config['simplecdn_enable'] && isset($this->config['simplecdn_url']))
		{
			$substring_localurl 	= 'src="./';
			$substring_cdn		= 'src="'.$this->config["simplecdn_url"].'';
			$user_rank_data = $event['user_rank_data']; 
			if (strpos($user_rank_data['img'], $substring_localurl) !== false)
			{
				$user_rank_data['img'] = str_replace($substring_localurl, $substring_cdn, $user_rank_data['img']);
				$event['user_rank_data'] = $user_rank_data;
			}
		}
	}
}
