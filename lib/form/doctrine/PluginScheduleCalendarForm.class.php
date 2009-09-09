<?php

/**
 * PluginScheduleCalendar form.
 *
 * @package    form
 * @subpackage ScheduleCalendar
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginScheduleCalendarForm extends BaseScheduleCalendarForm
{
  protected static $subjects = array();
   
  public function setup()
  {
    parent::setup();

    $subjects = array();
    $objects = $this->getOption('calendar_week');
    if($objects !== null)
    {
    $i = 0;
    $default_week = array("sun","mon","tue","wed","thu","fri","sat");
    while ($day = $objects->fetch())
    {
      self::$subjects[date("Y/m/d", $day->getTimestamp())] = $objects->month.'/'.$day->thisDay().'('.op_format_date($default_week[$i], 'EE').')';
      $i++;
    } 
    }

    $this->setWidgets(array(
      'schedule'      => new sfWidgetFormInput(),
      'schedule_date' => new sfWidgetFormSelect(array('choices' => self::$subjects)),
    ));
    $this->widgetSchema->setNameFormat('calendar[%s]');

    $this->setValidators(array(
       'member_id'     => new sfValidatorDoctrineChoice(array('model' => 'Member')),
       'schedule'      => new sfValidatorString(array('required' => false)),
       'schedule_date' => new sfValidatorDate(),
    ));
  }
}
