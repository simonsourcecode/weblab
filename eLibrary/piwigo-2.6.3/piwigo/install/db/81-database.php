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
  die('Hacking attempt!');
}

$upgrade_description = 'add new email features : 
users can modify/delete their owns comments';

$query = '
INSERT INTO '.PREFIX_TABLE.'config (param,value,comment)
  VALUES (\'user_can_delete_comment\',\'false\',
    \'administrators can allow user delete their own comments\'),
  (\'user_can_edit_comment\',\'false\',
    \'administrators can allow user edit their own comments\'),
  (\'email_admin_on_comment_edition\',\'false\',
    \'Send an email to the administrators when a comment is modified\'),
  (\'email_admin_on_comment_deletion\',\'false\',
    \'Send an email to the administrators when a comment is deleted\')
;';
pwg_query($query);

echo
"\n"
. $upgrade_description
."\n"
;
?>
