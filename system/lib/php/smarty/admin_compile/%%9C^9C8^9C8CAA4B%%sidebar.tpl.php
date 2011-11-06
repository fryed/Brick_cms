<?php /* Smarty version 2.6.20, created on 2011-11-06 11:36:40
         compiled from sidebar.tpl */ ?>
<div class="pod logoPod">
	<?php if ($this->_tpl_vars['site']['logo']): ?>
		<form method="post" action="" enctype="multipart/form-data">
			
			<fieldset>
				
				<h3>Site logo</h3>
				<hr/>
				
				<div class="innerPod">
					<img src="<?php echo $this->_tpl_vars['HOME']; ?>
<?php echo $this->_tpl_vars['site']['logo']['src']; ?>
" alt="<?php echo $this->_tpl_vars['site']['logo']['description']; ?>
"/>
					<div class="deleteLogo">
						<input type="submit" name="action" value="delete logo"/>
					</div>
				</div>
				
				<input type="hidden" name="item<?php echo $this->_tpl_vars['site']['logo']['id']; ?>
" value="on"/>
				<input type="hidden" name="table" value="images"/>
				
			</fieldset>
			
		</form>		
	<?php else: ?>	
		<form method="post" action="" enctype="multipart/form-data">
			
			<fieldset class="equalInput">
				
				<label>Upload logo:</label>
				<input type="file" name="upload" value="" required="required" placeholder="logo"/>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<input type="text" name="description" value="" placeholder="description"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="belongs_to" value="-2"/>
				
				<input type="hidden" name="table" value="images"/>
				
				<input type="submit" name="action" value="upload logo"/>
				
			</fieldset>
			
		</form>	
	<?php endif; ?>	
</div>

<br class="clearBoth"/>

<?php if ($this->_tpl_vars['page']['section'] == "/blog"): ?>

<div class="pod menuPod">
	
	<h3>Blog menu</h3>
	<hr/>
	
	<div class="innerPod">
	<?php $_from = $this->_tpl_vars['blog']['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	
		<h4><?php echo $this->_tpl_vars['category']['name']; ?>
</h4>
		<nav>
			<ul class="mainNav">
			<?php $_from = $this->_tpl_vars['category']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
				<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
<?php echo $this->_tpl_vars['article']['url']; ?>
"><?php echo $this->_tpl_vars['article']['name']; ?>
</a></li>
			<?php endforeach; else: ?>
				<li>No articles found.</li>
			<?php endif; unset($_from); ?>
			</ul>
		</nav>
		
	<?php endforeach; else: ?>
		<p>No categories found.</p>
	<?php endif; unset($_from); ?>
	</div>

</div>

<?php elseif ($this->_tpl_vars['page']['section'] == "/news"): ?>
	
<div class="pod menuPod">
	
	<h3>News menu</h3>
	<hr/>
	
	<div class="innerPod">
	<?php $_from = $this->_tpl_vars['news']['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>

		<h4><?php echo $this->_tpl_vars['category']['name']; ?>
</h4>
		<nav>
			<ul class="mainNav">
			<?php $_from = $this->_tpl_vars['category']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
				<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
<?php echo $this->_tpl_vars['article']['url']; ?>
"><?php echo $this->_tpl_vars['article']['name']; ?>
</a></li>
			<?php endforeach; else: ?>
				<li>No articles found.</li>
			<?php endif; unset($_from); ?>
			</ul>
		</nav>

	<?php endforeach; else: ?>
		<p>No categories found.</p>
	<?php endif; unset($_from); ?>
	</div>
	
</div>
	
<?php else: ?>

<div class="pod menuPod">
	
	<h3>Site menu</h3>
	<hr/>
	
	<form method="post" action="">
		
		<fieldset>

			<div class="innerPod">
				
				<nav>
					<?php $this->assign('navType', $this->_tpl_vars['menu']['main']); ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</nav>
				
				<br class="clearBoth"/>
				
			</div>
			
			<input type="hidden" name="table" value="main_nav"/>
			<input type="submit" name="action" value="update menu"/>
		
		</fieldset>
	
	</form>
	
</div>

<?php endif; ?>

<br class="clearBoth"/>

<div class="pod equalInput">
	
	<form method="post" action="">
	
		<h3>Add link to menu</h3>
		<hr/>
		
		<fieldset>
			
			<label>Name:</label>
			<input type="text" name="name" value="" required="required" placeholder="name"/>
			<br class="clearBoth"/>
			
			<label>Url:</label>
			<input type="url" name="link" value="http://www." required="required" placeholder="url"/>
			<br class="clearBoth"/>
			
			<label>Type:</label>
			<select name="type">
				<option value="link" selected="selected">link</option>
				<option value="page">page</option>
			</select>
			<br class="clearBoth"/>
			
			<input type="hidden" name="parent" value="-1"/>
			<input type="hidden" name="menu_order" value="1"/>
			
			<input type="hidden" name="table" value="main_nav"/>
			
			<input type="submit" name="action" value="add link"/>		
					
		</fieldset>
		
	</form>
	
</div>