<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * calendar actions.
 *
 * @package    OpenPNE
 * @subpackage calendar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class CalendarComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeWeekCalendarComponent(sfWebRequest $request)
  {
   include_once('Calendar/Week.php');

    // Calendar
    if (!($this->year && $this->month))
    {
      $this->year = $request->getParameter('year', date('y'));
      $this->month = $request->getParameter('month', date('m'));
      $this->day = $request->getParameter('day', date('d'));
    }
var_dump($this->month,$this->day);
    $this->calendar_week = new Calendar_Week($this->year, $this->month, $this->day, 0);
    $this->calendar_week->build();

    $calendar = Doctrine::getTable('ScheduleCalendar')->find($this->getUser()->getMemberId());
    $this->form = new ScheduleCalendarForm( $calendar, array('calendar_week' => $this->calendar_week));
    $this->plan = Doctrine::getTable('ScheduleCalendar')->find($this->getUser()->getMemberId());
  }
}
