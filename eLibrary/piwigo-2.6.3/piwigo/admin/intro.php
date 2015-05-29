<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based photo gallery                                    |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2014 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+

if (!defined('PHPWG_ROOT_PATH'))
{
  die ("Hacking attempt!");
}

include_once(PHPWG_ROOT_PATH.'admin/include/functions.php');
include_once(PHPWG_ROOT_PATH.'admin/include/check_integrity.class.php');
include_once(PHPWG_ROOT_PATH.'admin/include/c13y_internal.class.php');
include_once(PHPWG_ROOT_PATH.'admin/include/image.class.php');

// +-----------------------------------------------------------------------+
// | Check Access and exit when user status is not ok                      |
// +-----------------------------------------------------------------------+
check_status(ACCESS_ADMINISTRATOR);

// +-----------------------------------------------------------------------+
// |                                actions                                |
// +-----------------------------------------------------------------------+

// Check for upgrade : code inspired from punbb
if (isset($_GET['action']) and 'check_upgrade' == $_GET['action'])
{
  if (!fetchRemote(PHPWG_URL.'/download/latest_version', $result))
  {
    $page['errors'][] = l10n('Unable to check for upgrade.');
  }
  else
  {
    $versions = array('current' => PHPWG_VERSION);
    $lines = @explode("\r\n", $result);

    // if the current version is a BSF (development branch) build, we check
    // the first line, for stable versions, we check the second line
    if (preg_match('/^BSF/', $versions['current']))
    {
      $versions['latest'] = trim($lines[0]);

      // because integer are limited to 4,294,967,296 we need to split BSF
      // versions in date.time
      foreach ($versions as $key => $value)
      {
        $versions[$key] =
          preg_replace('/BSF_(\d{8})(\d{4})/', '$1.$2', $value);
      }
    }
    else
    {
      $versions['latest'] = trim($lines[1]);
    }

    if ('' == $versions['latest'])
    {
      $page['errors'][] = l10n('Check for upgrade failed for unknown reasons.');
    }
    // concatenation needed to avoid automatic transformation by release
    // script generator
    else if ('%'.'PWGVERSION'.'%' == $versions['current'])
    {
      $page['infos'][] = l10n('You are running on development sources, no check possible.');
    }
    else if (version_compare($versions['current'], $versions['latest']) < 0)
    {
      $page['infos'][] = l10n('A new version of Piwigo is available.');
    }
    else
    {
      $page['infos'][] = l10n('You are running the latest version of Piwigo.');
    }
  }
}
// Show phpinfo() output
else if (isset($_GET['action']) and 'phpinfo' == $_GET['action'])
{
  phpinfo();
  exit();
}

// +-----------------------------------------------------------------------+
// |                             template init                             |
// +-----------------------------------------------------------------------+

$template->set_filenames(array('intro' => 'intro.tpl'));

if ($conf['show_newsletter_subscription']) {
  $template->assign(
    array(
      'EMAIL' => $user['email'],
      'SUBSCRIBE_BASE_URL' => get_newsletter_subscribe_base_url($user['language']),
      )
    );
}

$php_current_timestamp = date("Y-m-d H:i:s");
$db_version = pwg_get_db_version();
list($db_current_date) = pwg_db_fetch_row(pwg_query('SELECT now();'));

$query = '
SELECT COUNT(*)
  FROM '.IMAGES_TABLE.'
;';
list($nb_elements) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.CATEGORIES_TABLE.'
;';
list($nb_categories) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.CATEGORIES_TABLE.'
  WHERE dir IS NULL
;';
list($nb_virtual) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.CATEGORIES_TABLE.'
  WHERE dir IS NOT NULL
;';
list($nb_physical) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.IMAGE_CATEGORY_TABLE.'
;';
list($nb_image_category) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.TAGS_TABLE.'
;';
list($nb_tags) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.IMAGE_TAG_TABLE.'
;';
list($nb_image_tag) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.USERS_TABLE.'
;';
list($nb_users) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.GROUPS_TABLE.'
;';
list($nb_groups) = pwg_db_fetch_row(pwg_query($query));

$query = '
SELECT COUNT(*)
  FROM '.RATE_TABLE.'
;';
list($nb_rates) = pwg_db_fetch_row(pwg_query($query));

$template->assign(
  array(
    'PHPWG_URL' => PHPWG_URL,
    'PWG_VERSION' => PHPWG_VERSION,
    'OS' => PHP_OS,
    'PHP_VERSION' => phpversion(),
    'DB_ENGINE' => 'MySQL',
    'DB_VERSION' => $db_version,
    'DB_ELEMENTS' => l10n_dec('%d photo', '%d photos', $nb_elements),
    'DB_CATEGORIES' =>
      l10n_dec('%d album including', '%d albums including', $nb_categories).
      l10n_dec('%d physical', '%d physicals', $nb_physical).
      l10n_dec(' and %d virtual', ' and %d virtuals', $nb_virtual),
    'DB_IMAGE_CATEGORY' => l10n_dec('%d association', '%d associations', $nb_image_category),
    'DB_TAGS' => l10n_dec('%d tag', '%d tags', $nb_tags),
    'DB_IMAGE_TAG' => l10n_dec('%d association', '%d associations', $nb_image_tag),
    'DB_USERS' => l10n_dec('%d user', '%d users', $nb_users),
    'DB_GROUPS' => l10n_dec('%d group', '%d groups', $nb_groups),
    'DB_RATES' => ($nb_rates == 0) ? l10n('no rate') : l10n('%d rates', $nb_rates),
    'U_CHECK_UPGRADE' => PHPWG_ROOT_PATH.'admin.php?action=check_upgrade',
    'U_PHPINFO' => PHPWG_ROOT_PATH.'admin.php?action=phpinfo',
    'PHP_DATATIME' => $php_current_timestamp,
    'DB_DATATIME' => $db_current_date,
    )
  );
  
if ($conf['activate_comments'])
{
  $query = '
SELECT COUNT(*)
  FROM '.COMMENTS_TABLE.'
;';
  list($nb_comments) = pwg_db_fetch_row(pwg_query($query));
  $template->assign('DB_COMMENTS', l10n_dec('%d comment', '%d comments', $nb_comments));
}

if ($nb_elements > 0)
{
  $query = '
SELECT MIN(date_available)
  FROM '.IMAGES_TABLE.'
;';
  list($first_date) = pwg_db_fetch_row(pwg_query($query));

  $template->assign(
    'first_added',
    array(
      'DB_DATE' =>
      l10n('first photo added on %s', format_date($first_date))
      )
    );
}

// graphics library
switch (pwg_image::get_library())
{
  case 'imagick':
    $library = 'ImageMagick';
    $img = new Imagick();
    $version = $img->getVersion();
    if (preg_match('/ImageMagick \d+\.\d+\.\d+-?\d*/', $version['versionString'], $match))
    {
      $library = $match[0];
    }
    $template->assign('GRAPHICS_LIBRARY', $library);
    break;

  case 'ext_imagick':
    $library = 'External ImageMagick';
    exec($conf['ext_imagick_dir'].'convert -version', $returnarray);
    if (preg_match('/Version: ImageMagick (\d+\.\d+\.\d+-?\d*)/', $returnarray[0], $match))
    {
      $library .= ' ' . $match[1];
    }
    $template->assign('GRAPHICS_LIBRARY', $library);
    break;

  case 'gd':
    $gd_info = gd_info();
    $template->assign('GRAPHICS_LIBRARY', 'GD '.@$gd_info['GD Version']);
    break;
}

// +-----------------------------------------------------------------------+
// |                           sending html code                           |
// +-----------------------------------------------------------------------+

$template->assign_var_from_handle('ADMIN_CONTENT', 'intro');

// Check integrity
$c13y = new check_integrity();
// add internal checks
new c13y_internal();
// check and display
$c13y->check();
$c13y->display();

?>
