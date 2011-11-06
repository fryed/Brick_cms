<?php /* Smarty version 2.6.20, created on 2011-11-06 11:36:40
         compiled from nav.tpl */ ?>
<ul class="mainNav">
	
<?php $_from = $this->_tpl_vars['navType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	
	<li class="<?php if ($this->_tpl_vars['row']['active'] == true): ?> active <?php endif; ?> <?php if ($this->_tpl_vars['row']['external'] == true): ?> external <?php endif; ?> <?php if ($this->_tpl_vars['row']['enabled'] == false): ?> disabled <?php endif; ?> <?php if ($this->_tpl_vars['row']['subNav']): ?> hasChildren <?php endif; ?>">
		
		<a href="<?php if ($this->_tpl_vars['row']['external'] != true): ?><?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
<?php endif; ?><?php echo $this->_tpl_vars['row']['url']; ?>
"><?php echo $this->_tpl_vars['row']['name']; ?>
</a>
		
		<div class="inputHolder">
		
			<input type="text" name="menu_order-<?php echo $this->_tpl_vars['row']['id']; ?>
" value="<?php echo $this->_tpl_vars['row']['menu_order']; ?>
"/>
			
			<?php if ($this->_tpl_vars['row']['uri'] != "/"): ?>
			
			<select name="parent-<?php echo $this->_tpl_vars['row']['id']; ?>
">
				<option value=">-1">top level</option>
				<?php $_from = $this->_tpl_vars['site']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section']):
?>
					<?php if ($this->_tpl_vars['section']['url'] != "/" && $this->_tpl_vars['section']['url'] != $this->_tpl_vars['row']['url']): ?>
					<option value="<?php echo $this->_tpl_vars['section']['url']; ?>
><?php echo $this->_tpl_vars['section']['id']; ?>
" <?php if ($this->_tpl_vars['row']['section'] == $this->_tpl_vars['section']['url']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['section']['url']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			
			<input type="checkbox" name="item<?php echo $this->_tpl_vars['row']['id']; ?>
"/>
			
			<?php endif; ?>
			
		</div>
		
		<?php if ($this->_tpl_vars['row']['subNav']): ?>
			<?php $this->assign('subNav', $this->_tpl_vars['row']['subNav']); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sub-nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>	
		
	</li>
	
<?php endforeach; endif; unset($_from); ?>

</ul>