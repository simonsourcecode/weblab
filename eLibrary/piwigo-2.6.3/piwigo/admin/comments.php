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

if (isset($_GET['start']) and is_numeric($_GET['start']))
{
  $page['start'] = $_GET['start'];
}
else
{
  $page['start'] = 0;
}

// +-----------------------------------------------------------------------+
// | Check Access and exit when user status is not ok                      |
// +-----------------------------------------------------------------------+

check_status(ACCESS_ADMINISTRATOR);

// +-----------------------------------------------------------------------+
// |                                actions                                |
// +-----------------------------------------------------------------------+

if (!empty($_POST))
{
  if (empty($_POST['comments']))
  {
    $page['errors'][] = l10n('Select at least one comment');
  }
  else
  {
    include_once( PHPWG_ROOT_PATH .'include/functions_comment.inc.php' );
    check_input_parameter('comments', $_POST, true, PATTERN_ID);
    
    if (isset($_POST['validate']))
    {
      validate_user_comment($_POST['comments']);

      $page['infos'][] = l10n_dec(
        '%d user comment validated', '%d user comments validated',
        count($_POST['comments'])
        );
    }

    if (isset($_POST['reject']))
    {
      delete_user_comment($_POST['comments']);

      $page['infos'][] = l10n_dec(
        '%d user comment rejected', '%d user comments rejected',
        count($_POST['comments'])
        );
    }
  }
}

// +-----------------------------------------------------------------------+
// |                             template init                             |
// +-----------------------------------------------------------------------+

$template->set_filenames(array('comments'=>'comments.tpl'));

$template->assign(
  array(
    'F_ACTION' => get_root_url().'admin.php?page=comments'
    )
  );

// +-----------------------------------------------------------------------+
// | Tabs                                                                  |
// +-----------------------------------------------------------------------+

include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

$tabsheet = new tabsheet();
$tabsheet->set_id('comments');
$tabsheet->select('');
$tabsheet->assign();

// +-----------------------------------------------------------------------+
// |                           comments display                            |
// +-----------------------------------------------------------------------+

$nb_total = 0;
$nb_pending = 0;

$query = '
SELECT
    COUNT(*) AS counter,
    validated
  FROM '.COMMENTS_TABLE.'
  GROUP BY validated
;';
$result = pwg_query($query);
while ($row = pwg_db_fetch_assoc($result))
{
  $nb_total+= $row['counter'];

  if ('false' == $row['validated'])
  {
    $nb_pending = $row['counter'];
  }
}

if (!isset($_GET['filter']) and $nb_pending > 0)
{
  $page['filter'] = 'pending';
}
else
{
  $page['filter'] = 'all';
}

if (isset($_GET['filter']) and 'pending' == $_GET['filter'])
{
  $page['filter'] = $_GET['filter'];
}

$template->assign(
  array(
    'nb_total' => $nb_total,
    'nb_pending' => $nb_pending,
    'filter' => $page['filter'],
    )
  );

$where_clauses = array('1=1');

if ('pending' == $page['filter'])
{
  $where_clauses[] = 'validated=\'false\'';
}

$query = '
SELECT
    c.id,
    c.image_id,
    c.date,
    c.author,
    '.$conf['user_fields']['username'].' AS username,
    c.content,
    i.path,
    i.representative_ext,
    validated
  FROM '.COMMENTS_TABLE.' AS c
    INNER JOIN '.IMAGES_TABLE.' AS i
      ON i.id = c.image_id
    LEFT JOIN '.USERS_TABLE.' AS u
      ON u.'.$conf['user_fields']['id'].' = c.author_id
  WHERE '.implode(' AND ', $where_clauses).'
  ORDER BY c.date DESC
  LIMIT '.$page['start'].', '.$conf['comments_page_nb_comments'].'
;';
$result = pwg_query($query);
while ($row = pwg_db_fetch_assoc($result))
{
  $thumb = DerivativeImage::thumb_url(
      array(
        'id'=>$row['image_id'],
        'path'=>$row['path'],
        )
     );
  if (empty($row['author_id'])) 
  {
    $author_name = $row['author'];
  }
  else
  {
    $author_name = stripslashes($row['username']);
  }
  $template->append(
    'comments',
    array(
      'U_PICTURE' => get_root_url().'admin.php?page=photo-'.$row['image_id'],
      'ID' => $row['id'],
      'TN_SRC' => $thumb,
      'AUTHOR' => trigger_event('render_comment_author', $author_name),
      'DATE' => format_date($row['date'], true),
      'CONTENT' => trigger_event('render_comment_content',$row['content']),
      'IS_PENDING' => ('false' == $row['validated']),
      )
    );

  $list[] = $row['id'];
}

// +-----------------------------------------------------------------------+
// |                            navigation bar                             |
// +-----------------------------------------------------------------------+

$navbar = create_navigation_bar(
  get_root_url().'admin.php'.get_query_string_diff(array('start')),
  ('pending' == $page['filter'] ? $nb_pending : $nb_total),
  $page['start'],
  $conf['comments_page_nb_comments']
  );

$template->assign('navbar', $navbar);

// +-----------------------------------------------------------------------+
// |                           sending html code                           |
// +-----------------------------------------------------------------------+

$template->assign_var_from_handle('ADMIN_CONTENT', 'comments');

?>
