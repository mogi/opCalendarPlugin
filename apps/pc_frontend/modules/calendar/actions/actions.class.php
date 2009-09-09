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
class calendarActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
  public function executeUpdateCalendar(sfWebRequest $request) {
    include_once('Calendar/Week.php');
    //POSTリクエストかどうかを確認する
    if ($request->isMethod(sfRequest::POST))
    {

      $calendar = Doctrine::getTable('ScheduleCalendar')->find($this->getUser()->getMemberId());
      $param = $request->getParameter('calendar');
      $param['member_id'] = $this->getUser()->getMember()->getId();

      $scheduleCalendarForm = new ScheduleCalendarForm($calendar);
      $scheduleCalendarForm->bind($param);
        if ($scheduleCalendarForm->isValid())
        {
          $scheduleCalendarForm->save();
        }
      }
    $this->redirect('@homepage');
  }
}
