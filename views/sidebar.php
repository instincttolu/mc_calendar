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

?>
<p class="button"><a href="<?php echo get_url('plugin/calendar/new_event'); ?>"><img src="<?php echo PLUGINS_URI; ?>/calendar/images/new_event.png" align="middle" alt="New event" /> <?php echo __('New event'); ?></a></p>
<p class="button"><a href="<?php echo get_url('plugin/calendar/events'); ?>"><img src="<?php echo PLUGINS_URI; ?>/calendar/images/view.png" align="middle" alt="View all events" /> <?php echo __('View all events'); ?></a></p>
<p class="button"><a href="<?php echo get_url('plugin/calendar/documentation'); ?>"><img src="<?php echo PLUGINS_URI; ?>/calendar/images/doc.png" align="middle" alt="Docs" /> <?php echo __('Documentation'); ?></a></p>

<div class="box">
    <h3>Show note in frontend</h3>
    <p>There are two ways to display your notes in your layout, page or snippet.</p>
    <h5>Show only one note</h5>
    <p><code>&lt;?php shownotebyid('note_id'); ?&gt;</code></p>
    <h5>Show all your notes</h5>
    <p><code>&lt;?php showallnotes(); ?&gt;</code></p>
</div>


