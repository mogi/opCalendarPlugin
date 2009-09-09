<?php $default_week = array("sun","mon","tue","wed","thu","fri","sat") ?>
<?php $i = 0; ?>
<?php slot('week_calendar') ?>
<label for="title">予定</label>
<?php echo $form->renderFormTag(url_for('calendar/updateCalendar')) ?>
<?php echo $form->renderHiddenFields() ?>
<?php echo $form['schedule']->render() ?>
<?php echo $form['schedule_date']->render() ?>
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


<?php var_dump($plan); ?>


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
    if ($i == 0)
    {
      echo '<th class="'.$default_week[$i].'">'.$month.'/'.$day->thisDay().'<br>('.op_format_date($default_week[$i], 'EE').')';
    }
    else
    {
      echo '<th class="'.$default_week[$i].'">'.$day->thisDay().'<br>('.op_format_date($default_week[$i], 'EE').')';
    }
    /*
    if()
    {
      echo '';
    }
     */
    echo '</th>';
  }
  $i++;
}
?>
</tbody></table>
<?php end_slot('week_calendar'); ?>
<?php op_include_box('week_calendar', get_slot('week_calendar'));
