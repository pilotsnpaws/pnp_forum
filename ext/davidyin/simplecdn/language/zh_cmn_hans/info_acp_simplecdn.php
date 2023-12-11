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
	'SIMPLECDN_CONFIG'				=> 'Simple CDN 设定',
	'ACP_SIMPLECDN_CONFIG'			=> 'Simple CDN',
	'ACP_SIMPLECDN_CONFIG_EXPLAIN'	=> '这是 Simple CDN 扩展设置页面。 论坛的静态资源会由所设定的 CDN 来提供。支持 AWS Cloudfront，及类似的 CDN。',
	'ACP_SIMPLECDN_CONFIG_SET'		=> '设置',
	'SIMPLECDN_CONFIG_SAVED'		=> 'Simple CDN 设置已保存',
	'SIMPLECDN_ENABLE'				=> '启用 Simple CDN',
	'SIMPLECDN_ENABLE_EXPLAIN'		=> '您想启用 CDN，使其生效吗？',
	'SIMPLECDN_FILE_ENABLE'			=> '启用 文件 CDN',
	'SIMPLECDN_FILE_ENABLE_EXPLAIN'	=> '只有当你的论坛是开放式论坛才启用，帖子内用户上传的附件也会由 CDN 访问。。如果您的论坛只有注册用户才能访问，请不要开启该选项。',
	'SIMPLECDN_URL'					=> 'Simple CDN URL',
	'SIMPLECDN_URL_EXPLAIN'			=> '输入 CDN 的完整路径。网址应当以 // 开头，以 / 结尾。比如 //cdn.cloudfront.net/。',
	'SIMPLECDN_URL_PLACEHOLDER'		=> '//cdn.cloudfront.net/',
));
