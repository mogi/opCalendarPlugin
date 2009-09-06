<?php $default_week = array("sun","mon","tue","wed","thu","fri","sat")?>
<?php slot('week_calendar') ?>

<label for="title">予定</label>
<?php echo $form->getWidget('schedule')->setAttribute('rows', 1); ?>
<?php echo $form->getWidget('schedule')->setAttribute('cols', 10); ?>
<?php echo $form->renderFormTag(url_for('calendar/updateSchedule') ,array('method' => 'post')) ?>
<?php echo $form->renderHiddenFields() ?>
<?php echo $form['schedule']->render() ?>
<select name="start_date">
<?php
while ($day = $calendar_week->fetch())
{
  echo '<option value="'.$month.$day->thisDay().'">'.$month.'/'.$day->thisDay().'('.op_format_date($default_week[$week], 'EE').')</option>';
  $week++;
}
$week = 0;
?>
</select>


<input type="submit" />
</form>

<?php if ($_w = $calendar_week->prevWeek('array')): ?>
  <?php echo link_to('&lt;&lt;','@homepage?id='.$sf_user->getMemberId().'&year='.$_w['year'].'&month='.$_w['month'].'&day='.$_w['day']) ?>
<?php endif; ?>
  <?php $_w = $calendar_week->thisWeek('array'); ?>
  <?php echo link_to('■','@homepage?id='.$sf_user->getMemberId().'&year='.date('y').'&month='.date('m').'&day='.date('d')) ?>
<?php if ($_w = $calendar_week->nextWeek('array')): ?>
  <?php echo link_to('&gt;&gt;', '@homepage?id='.$sf_user->getMemberId().'&year='.$_w['year'].'&month='.$_w['month'].'&day='.$_w['day']) ?>
<?php endif; ?>

<table class="calendar"><tbody>
<?php
while ($day = $calendar_week->fetch())
{
  if ($day->isEmpty())
  {
    echo '<td>&nbsp;</td>';
  }
  else
  {
    if ($week == 0)
    {
      echo '<th class="'.$default_week[$week].'">'.$month.'/'.$day->thisDay().'<br>('.op_format_date($default_week[$week], 'EE').')</th>';
    }
    else
    {
      echo '<th class="'.$default_week[$week].'">'.$day->thisDay().'<br>('.op_format_date($default_week[$week], 'EE').')</th>';
    }
  }
  $week++;
}
?>
</tbody></table>
<?php end_slot('week_calendar'); ?>
<?php op_include_box('week_calendar', get_slot('week_calendar'));
