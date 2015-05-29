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

/**
 * @package functions\session
 */


if (isset($conf['session_save_handler'])
  and ($conf['session_save_handler'] == 'db')
  and defined('PHPWG_INSTALLED'))
{
  session_set_save_handler(
    'pwg_session_open',
    'pwg_session_close',
    'pwg_session_read',
    'pwg_session_write',
    'pwg_session_destroy',
    'pwg_session_gc'
  );

  if (function_exists('ini_set'))
  {
    ini_set('session.use_cookies', $conf['session_use_cookies']);
    ini_set('session.use_only_cookies', $conf['session_use_only_cookies']);
    ini_set('session.use_trans_sid', intval($conf['session_use_trans_sid']));
    ini_set('session.cookie_httponly', 1);
  }

  session_name($conf['session_name']);
  session_set_cookie_params(0, cookie_path());
  register_shutdown_function('session_write_close');
}


/**
 * Generates a pseudo random string.
 * Characters used are a-z A-Z and numerical values.
 *
 * @param int $size
 * @return string
 */
function generate_key($size)
{
  if (
    is_callable('openssl_random_pseudo_bytes')
    and !(version_compare(PHP_VERSION, '5.3.4') < 0 and defined('PHP_WINDOWS_VERSION_MAJOR'))
    )
  {
    return substr(
      str_replace(
        array('+', '/'),
        '',
        base64_encode(openssl_random_pseudo_bytes($size))
        ),
      0,
      $size
      );
  }
  else
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $l = strlen($alphabet)-1;
    $key = '';
    for ($i=0; $i<$size; $i++)
    {
      $key.= $alphabet[mt_rand(0, $l)];
    }
    return $key;
  }
}

/**
 * Called by PHP session manager, always return true.
 *
 * @param string $path
 * @param sring $name
 * @return true
 */
function pwg_session_open($path, $name)
{
  return true;
}

/**
 * Called by PHP session manager, always return true.
 *
 * @return true
 */
function pwg_session_close()
{
  return true;
}

/**
 * Returns a hash from current user IP
 *
 * @return string
 */
function get_remote_addr_session_hash()
{
  global $conf;

  if (!$conf['session_use_ip_address'])
  {
    return '';
  }
  
  if (strpos($_SERVER['REMOTE_ADDR'],':')===false)
  {//ipv4
    return vsprintf(
      "%02X%02X",
      explode('.',$_SERVER['REMOTE_ADDR'])
    );
  }
  return ''; //ipv6 not yet
}

/**
 * Called by PHP session manager, retrieves data stored in the sessions table.
 *
 * @param string $session_id
 * @return string
 */
function pwg_session_read($session_id)
{
  $query = '
SELECT data
  FROM '.SESSIONS_TABLE.'
  WHERE id = \''.get_remote_addr_session_hash().$session_id.'\'
;';
  $result = pwg_query($query);
  if ($result)
  {
    $row = pwg_db_fetch_assoc($result);
    return $row['data'];
  }
  else
  {
    return '';
  }
}

/**
 * Called by PHP session manager, writes data in the sessions table.
 *
 * @param string $session_id
 * @param sring $data
 * @return true
 */
function pwg_session_write($session_id, $data)
{
  $query = '
REPLACE INTO '.SESSIONS_TABLE.'
  (id,data,expiration)
  VALUES(\''.get_remote_addr_session_hash().$session_id.'\',\''.pwg_db_real_escape_string($data).'\',now())
;';
  pwg_query($query);
  return true;
}

/**
 * Called by PHP session manager, deletes data in the sessions table.
 *
 * @param string $session_id
 * @return true
 */
function pwg_session_destroy($session_id)
{
  $query = '
DELETE
  FROM '.SESSIONS_TABLE.'
  WHERE id = \''.get_remote_addr_session_hash().$session_id.'\'
;';
  pwg_query($query);
  return true;
}

/**
 * Called by PHP session manager, garbage collector for expired sessions.
 *
 * @return true
 */
function pwg_session_gc()
{
  global $conf;

  $query = '
DELETE
  FROM '.SESSIONS_TABLE.'
  WHERE '.pwg_db_date_to_ts('NOW()').' - '.pwg_db_date_to_ts('expiration').' > '
  .$conf['session_length'].'
;';
  pwg_query($query);
  return true;
}

/**
 * Persistently stores a variable for the current session.
 *
 * @param string $var
 * @param mixed $value
 * @return bool
 */
function pwg_set_session_var($var, $value)
{
  if ( !isset($_SESSION) )
    return false;
  $_SESSION['pwg_'.$var] = $value;
  return true;
}

/**
 * Retrieves the value of a persistent variable for the current session.
 *
 * @param string $var
 * @param mixed $default
 * @return mixed
 */
function pwg_get_session_var($var, $default = null)
{
  if (isset( $_SESSION['pwg_'.$var] ) )
  {
    return $_SESSION['pwg_'.$var];
  }
  return $default;
}

/**
 * Deletes a persistent variable for the current session.
 *
 * @param string $var
 * @return bool
 */
function pwg_unset_session_var($var)
{
  if ( !isset($_SESSION) )
    return false;
  unset( $_SESSION['pwg_'.$var] );
  return true;
}

?>