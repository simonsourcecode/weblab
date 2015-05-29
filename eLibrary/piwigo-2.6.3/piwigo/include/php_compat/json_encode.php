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

function json_encode($data) {
  switch (gettype($data)) {
    case 'boolean':
      return ($data ? 'true' : 'false');
    case 'null':
    case 'NULL':
      return 'null';
    case 'integer':
    case 'double':
      return $data;
    case 'string':
      return '"'. str_replace(array("\\",'"',"/","\n","\r","\t"), array("\\\\",'\"',"\\/","\\n","\\r","\\t"), $data) .'"';
    case 'object':
    case 'array':
      if ($data === array()) return '[]'; # empty array
      if (range(0, count($data) - 1) !== array_keys($data) ) { # string keys, unordered, non-incremental keys, .. - whatever, make object
        $out = "\n".'{';
        foreach($data as $key => $value) {
          $out .= json_encode((string) $key) . ':' . json_encode($value) . ',';
        }
        $out = substr($out, 0, -1) . "\n". '}';
      }else{
        # regular array
        $out = "\n".'[' . join("\n".',', array_map('json_encode', $data)) ."\n".']';
      }
      return $out;
  }
}

?>