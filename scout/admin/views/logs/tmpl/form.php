<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" enctype="multipart/form-data" >

	<fieldset>
		<legend><?php echo JText::_('Form'); ?></legend>
			<table class="admintable">
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Date' ); ?>:
                    </td>
                    <td>
                        <?php echo JHTML::calendar( @$row->datetime, "datetime", "datetime", '%Y-%m-%d %H:%M:%S' ); ?>
                    </td>
                </tr>
				<tr>
					<td style="width: 100px; text-align: right;" class="key">
						<?php echo JText::_( 'Subject' ); ?>:
					</td>
					<td>
						<input name="subject_id" value="<?php echo @$row->subject_id; ?>" size="48" maxlength="250" type="text" />
					</td>
				</tr>
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Verb' ); ?>:
                    </td>
                    <td>
                        <input name="verb_id" value="<?php echo @$row->verb_id; ?>" size="48" maxlength="250" type="text" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Object' ); ?>:
                    </td>
                    <td>
                        <input name="object_id" value="<?php echo @$row->object_id; ?>" size="48" maxlength="250" type="text" />
                    </td>
                </tr>
			</table>
			<input type="hidden" name="id" value="<?php echo @$row->log_id; ?>" />
			<input type="hidden" name="task" value="" />
	</fieldset>
</form>