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
 * @package functions\calendar
 */

include_once(PHPWG_ROOT_PATH.'include/calendar_base.class.php');

/** level of year view */
define('CYEAR', 0);
/** level of week view */
define('CWEEK', 1);
/** level of day view */
define('CDAY',  2);


/**
 * Weekly calendar style (composed of years/week in years and days in week)
 */
class Calendar extends CalendarBase
{
  /**
   * Initialize the calendar
   * @param string $inner_sql
   */
  function initialize($inner_sql)
  {
    parent::initialize($inner_sql);
    global $lang, $conf;
    $week_no_labels=array();
    for ($i=1; $i<=53; $i++)
    {
      $week_no_labels[$i] = l10n('Week %d', $i);
      //$week_no_labels[$i] = $i;
    }

    $this->calendar_levels = array(
      array(
          'sql'=> pwg_db_get_year($this->date_field),
          'labels' => null
        ),
      array(
          'sql'=> pwg_db_get_week($this->date_field).'+1',
          'labels' => $week_no_labels,
        ),
      array(
          'sql'=> pwg_db_get_dayofweek($this->date_field).'-1',
          'labels' => $lang['day']
        ),
     );
    //Comment next lines for week starting on Sunday or if MySQL version<4.0.17
    //WEEK(date,5) = "0-53 - Week 1=the first week with a Monday in this year"
    if ('monday' == $conf['week_starts_on'])
    {
      $this->calendar_levels[CWEEK]['sql'] = pwg_db_get_week($this->date_field, 5).'+1';
      $this->calendar_levels[CDAY]['sql'] = pwg_db_get_weekday($this->date_field);
      $this->calendar_levels[CDAY]['labels'][] = array_shift($this->calendar_levels[CDAY]['labels']);
    }
  }

  /**
   * Generate navigation bars for category page.
   *
   * @return boolean false indicates that thumbnails where not included
   */
  function generate_category_content()
  {
    global $conf, $page;

    if ( count($page['chronology_date'])==0 )
    {
      $this->build_nav_bar(CYEAR); // years
    }
    if ( count($page['chronology_date'])==1 )
    {
      $this->build_nav_bar(CWEEK, array()); // week nav bar 1-53
    }
    if ( count($page['chronology_date'])==2 )
    {
      $this->build_nav_bar(CDAY); // days nav bar Mon-Sun
    }
    $this->build_next_prev();
    return false;
  }

  /**
   * Returns a sql WHERE subquery for the date field.
   *
   * @param int $max_levels (e.g. 2=only year and month)
   * @return string
   */
  function get_date_where($max_levels=3)
  {
    global $page;
    $date = $page['chronology_date'];
    while (count($date)>$max_levels)
    {
      array_pop($date);
    }
    $res = '';
    if (isset($date[CYEAR]) and $date[CYEAR]!=='any')
    {
      $y = $date[CYEAR];
      $res = " AND $this->date_field BETWEEN '$y-01-01' AND '$y-12-31 23:59:59'";
    }

    if (isset($date[CWEEK]) and $date[CWEEK]!=='any')
    {
      $res .= ' AND '.$this->calendar_levels[CWEEK]['sql'].'='.$date[CWEEK];
    }
    if (isset($date[CDAY]) and $date[CDAY]!=='any')
    {
      $res .= ' AND '.$this->calendar_levels[CDAY]['sql'].'='.$date[CDAY];
    }
    if (empty($res))
    {
      $res = ' AND '.$this->date_field.' IS NOT NULL';
    }
    return $res;
  }
}

?>