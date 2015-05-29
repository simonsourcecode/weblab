<?php
define('MULTIVIEW_CONTROLLER', 1);
define('PHPWG_ROOT_PATH','../../');
include_once( PHPWG_ROOT_PATH.'include/common.inc.php' );

if (!is_admin() or !function_exists('multiview_user_init') )
{
  pwg_unset_session_var( 'multiview_as' );
  pwg_unset_session_var( 'multiview_theme' );
  pwg_unset_session_var( 'multiview_lang' );
  pwg_unset_session_var( 'multiview_show_queries' );
  pwg_unset_session_var( 'multiview_debug_l10n' );
  pwg_unset_session_var( 'multiview_debug_template' );
	pwg_unset_session_var( 'multiview_template_combine_files' );
  pwg_unset_session_var( 'multiview_no_history' );
?>

<script type="text/javascript">
  window.close();
</script>
<?php
  exit();
}
?>
<!DOCTYPE html">
<?php

$refresh_main = false;

if ( isset($_GET['view_as']) )
{
  if ($user['id']===$_GET['view_as'])
    pwg_unset_session_var( 'multiview_as' );
  else
    pwg_set_session_var( 'multiview_as', (int)$_GET['view_as'] );
  // user change resets theme/lang
  pwg_unset_session_var( 'multiview_theme' );
  pwg_unset_session_var( 'multiview_lang' );
  $refresh_main = true;
}
if (pwg_get_session_var( 'multiview_as', $user['id']) != $user['id'] )
  $view_as_user = build_user( pwg_get_session_var( 'multiview_as',0), false);
else
  $view_as_user = $user;

if ( isset($_GET['theme']) )
{
  pwg_set_session_var( 'multiview_theme', $_GET['theme'] );
  $refresh_main = true;
}

if ( isset($_GET['lang']) )
{
  pwg_set_session_var( 'multiview_lang', $_GET['lang'] );
  $refresh_main = true;
}

if ( isset($_GET['show_queries']) )
{
  if ( $_GET['show_queries']> 0 )
    pwg_set_session_var( 'multiview_show_queries', 1 );
  else
    pwg_unset_session_var( 'multiview_show_queries' );
  $refresh_main = true;
}

if ( isset($_GET['debug_l10n']) )
{
  if ( $_GET['debug_l10n']>0 )
    pwg_set_session_var( 'multiview_debug_l10n', 1 );
  else
    pwg_unset_session_var( 'multiview_debug_l10n' );
  $refresh_main = true;
}


if ( isset($_GET['debug_template']) )
{
  if ( $_GET['debug_template']>0 )
    pwg_set_session_var( 'multiview_debug_template', 1 );
  else
    pwg_unset_session_var( 'multiview_debug_template' );
  $refresh_main = true;
}

if ( isset($_GET['template_combine_files']) )
{
  if ( $_GET['template_combine_files']==0 )
    pwg_set_session_var( 'multiview_template_combine_files', 0 );
  else
    pwg_unset_session_var( 'multiview_template_combine_files' );
  $refresh_main = true;
}


if ( isset($_GET['no_history']) )
{
  if ( $_GET['no_history']>0 )
    pwg_set_session_var( 'multiview_no_history', 1 );
  else
    pwg_unset_session_var( 'multiview_no_history' );
  $refresh_main = true;
}

if ( isset($_GET['purge_template']) )
{
  pwg_set_session_var( 'purge_template', 1 );
  $refresh_main = true;
}

$my_url = get_root_url().'plugins/'.basename(dirname(__FILE__)).'/'.basename(__FILE__);

// +-----------------------------------------------------------------------+
// | users                                                                 |
$query = '
SELECT '.$conf['user_fields']['id'].' AS id,'.$conf['user_fields']['username'].' AS username
FROM '.USERS_TABLE.'
  ORDER BY CONVERT('.$conf['user_fields']['username'].',CHAR)
;';
$user_map = simple_hash_from_query($query, 'id', 'username');

$users_html = '<select onchange="document.location = this.options[this.selectedIndex].value;">';
foreach( $user_map as $id=>$username)
{
  $selected = ($id==$view_as_user['id']) ? 'selected="selected"' : '';
  $users_html .=
    '<option value="'
    .$my_url.'?view_as='.$id
    .'" '.$selected.'>'
    .$username
    .'</option>';
}
$users_html.= '</select>';


// +-----------------------------------------------------------------------+
// | templates                                                             |
$my_theme = '';
$themes_html='<select onchange="document.location = this.options[this.selectedIndex].value;">';
include_once(PHPWG_ROOT_PATH.'admin/include/themes.class.php');
$themes = new themes();
foreach ($themes->fs_themes as $pwg_theme => $fs_theme)
{
  $selected = $pwg_theme == pwg_get_session_var( 'multiview_theme', $view_as_user['theme'] ) ? 'selected="selected"' : '';
  $my_theme = $selected == '' ? $my_theme : 'themes/'.$view_as_user['theme'];
  $themes_html .=
    '<option value="'
    .$my_url.'?theme='.$pwg_theme
    .'" '.$selected.'>'
    .$pwg_theme
    .'</option>';
}
$themes_html .= '</select>';

// +-----------------------------------------------------------------------+
// | language                                                              |
$lang_html='<select onchange="document.location = this.options[this.selectedIndex].value;">';
foreach (get_languages() as $language_code => $language_name)
{
  $selected = $language_code == pwg_get_session_var( 'multiview_lang', $view_as_user['language'] ) ? 'selected="selected"' : '';
  $lang_html .=
    '<option value="'
    .$my_url.'?lang='.$language_code
    .'" '.$selected.'>'
    .$language_name
    .'</option>';
}
$lang_html .= '</select>';

// +-----------------------------------------------------------------------+
// | show queries                                                          |
$show_queries_html='';
if (!$conf['show_queries'])
{
  if ( !pwg_get_session_var( 'multiview_show_queries', 0 ) )
    $show_queries_html.='<a href="'.$my_url.'?show_queries=1">Show SQL queries</a>';
  else
    $show_queries_html.='<a href="'.$my_url.'?show_queries=0">Hide SQL queries</a>';
}

// +-----------------------------------------------------------------------+
// | debug language                                                        |
$debug_l10n_html='';
if (!$conf['debug_l10n'])
{
  if ( !pwg_get_session_var( 'multiview_debug_l10n', 0 ) )
    $debug_l10n_html.='<a href="'.$my_url.'?debug_l10n=1">Debug language</a>';
  else
    $debug_l10n_html.='<a href="'.$my_url.'?debug_l10n=0">Revert debug language</a>';
}

// +-----------------------------------------------------------------------+
// | debug template                                                        |
$debug_template_html='';
if (!$conf['debug_template'])
{
  if ( !pwg_get_session_var( 'multiview_debug_template', 0 ) )
    $debug_template_html.='<a href="'.$my_url.'?debug_template=1">Debug template</a>';
  else
    $debug_template_html.='<a href="'.$my_url.'?debug_template=0">Revert debug template</a>';
}

// +-----------------------------------------------------------------------+
// | template combine files                                                |
$template_combine_files_html='';
if ($conf['template_combine_files'])
{
  if ( pwg_get_session_var( 'multiview_template_combine_files', 1 ) )
    $template_combine_files_html.='<a href="'.$my_url.'?template_combine_files=0">Don\'t combine js&amp;css</a>';
  else
    $template_combine_files_html.='<a href="'.$my_url.'?template_combine_files=1">Combine js&amp;css</a>';
}

// +-----------------------------------------------------------------------+
// | no history                                                            |
$no_history_html='';
if ( !pwg_get_session_var( 'multiview_no_history', 0 ) )
  $no_history_html.='<a href="'.$my_url.'?no_history=1">Don\'t save to visit history</a>';
else
  $no_history_html.='<a href="'.$my_url.'?no_history=0">Save to visit history</a>';

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo get_pwg_charset() ?>">
<style>
BODY, TABLE {
  font-family: sans-serif;
  font-size: small;
}
BODY{
  margin: 2px;
}
</style>
<title>Controller</title>

</head>
<body>
<div>
<script type="text/javascript">
if (window.opener==null) {
  window.close();
  document.write("<"+"h2>How did you get here ???<"+"/h2>");
}
</script>

<table>
<tr><td>User</td><td><?php echo $users_html; ?></td></tr>

<tr><td>Theme</td><td><?php echo $themes_html; ?></td></tr>

<tr><td>Lang</td><td><?php echo $lang_html; ?></td></tr>
</table>
<?php echo implode( "<br/>\n", array($show_queries_html, $debug_l10n_html, $debug_template_html, $template_combine_files_html, $no_history_html) ); ?>
<br/><a href="<?php echo $my_url; ?>?purge_template">Purge compiled templates</a>

<script type="text/javascript">
<?php
  if ($refresh_main) echo '
window.opener.location = window.opener.location;';
?>
</script>
</div>
</body>
</html>
