<?php /* Smarty version 2.6.20, created on 2011-11-05 16:14:51
         compiled from messages.tpl */ ?>
<?php if ($this->_tpl_vars['messages']['messages']): ?>
<div class="messageBox">
	<p><?php echo $this->_tpl_vars['messages']['messages']; ?>
</p>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['messages']['errors']): ?>
<div class="errorBox">
	<?php echo $this->_tpl_vars['messages']['errors']; ?>

</div>
<?php endif; ?>