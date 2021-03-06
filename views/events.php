<?php
/**
* This file is part of the "MensaCymru Calendar" plugin for Wolf CMS.
* Licensed under an GPL style license. For full details see license.txt.
*
* @author Giles Metcalf <giles@lughnasadh.com>
* @copyright Giles Metcalf, 2015
*
* Original authors:
*
* @author Jacek Ciach <jacek.ciach@wp.eu>
* @copyright Jacek Ciach, 2014
*
*/

if (!defined('IN_CMS')) { exit(); }

?>

<h1><?php echo __('All events'); ?></h1>
    <table class="index" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <td><?php echo __('Id'); ?></td>
                <td><?php echo __('Title'); ?></td>
                <td><?php echo __('Date from'); ?></td>
                <td><?php echo __('Date to'); ?></td>   
                <td><?php echo __('Start time'); ?></td>   				
                <td><?php echo __('Created by'); ?></td>
                <td><?php echo __('Delete'); ?></td>
            </tr>
        </thead>

        <?php foreach($events as $event) { ?>

        <tr class="<?php echo odd_even(); ?>">
            <td><?php echo $event->getId(); ?></td>
            <td><a href="<?php echo get_url('plugin/mc_calendar/update/'.$event->id); ?>"><?php echo $event->getTitle(); ?></a></td>
            <td><?php echo $event->getDateFrom(); ?></td>            
            <td><?php echo $event->getDateTo(); ?></td>            
            <td><?php echo $event->getStartTime(); ?></td>            
            <td><?php echo $event->getAuthor(); ?></td>
            <td><a class="delete-event" href="<?php echo get_url('plugin/mc_calendar/delete/'.$event->id); ?>"><img src="<?php echo ICONS_PATH; ?>action-delete-16.png" alt="Delete" /></a></td>
        </tr>
        <?php } ?>
    </table>

<script>
  function onDeleteEventClick() {
    var question = "<?php echo __("Are you sure you want to delete this event?"); ?>";
    if (confirm(question))
      return true;
    else
      return false;
  }
   
  $("a.delete-event").click(onDeleteEventClick);  
</script>
