<?php /* Smarty version 2.6.20, created on 2011-11-05 16:14:51
         compiled from edit-page.tpl */ ?>
<section class="mainCol col">

	<h1>Edit "<?php echo $this->_tpl_vars['page']['title']; ?>
"</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#edit">Edit page</a></li>
		<li><a href="#menu">Add to menu</a></li>
		<li><a href="#hero">Hero image</a></li>
		<li><a href="#downloads">Downloads</a></li>
		<li><a href="#info">Page Info</a></li>
	</ul>
	
	<div id="edit">
	
		<form method="post" action="">
			
			<fieldset>
				
				<label>Enabled:</label>
				<input type="checkbox" name="enabled" <?php if ($this->_tpl_vars['page']['enabled']): ?>checked="checked"<?php endif; ?>/>
				<br class="clearBoth"/>
				
				<label>Page title:</label>
				<input type="text" name="title" value="<?php echo $this->_tpl_vars['page']['title']; ?>
" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Page name:</label>
				<input type="text" name="name" value="<?php echo $this->_tpl_vars['page']['name']; ?>
" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Uri:</label>
				<input type="text" name="uri" value="<?php echo $this->_tpl_vars['page']['uri']; ?>
" <?php if ($this->_tpl_vars['page']['uri'] == "/"): ?>disabled="disabled"<?php endif; ?> required="required" placeholder="uri"/>
				<br class="clearBoth"/>
				
				<label>Url:</label>
				<input type="text" name="url" value="<?php echo $this->_tpl_vars['page']['url']; ?>
" disabled="disabled"/>
				<input type="hidden" name="url" value="<?php echo $this->_tpl_vars['page']['url']; ?>
"/>
				<br class="clearBoth"/>
				
				<label>Template:</label>
				<select name="template">
				 	<?php $_from = $this->_tpl_vars['site']['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['template']):
?>
						<option value="<?php echo $this->_tpl_vars['template']; ?>
" <?php if ($this->_tpl_vars['template'] == $this->_tpl_vars['page']['page_template']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['template']; ?>
</option>
					<?php endforeach; else: ?>
						<option value="error">no templates found</option>
					<?php endif; unset($_from); ?>
				</select>
				<br class="clearBoth"/>
			
				<label>Gallery:</label>
				<select name="gallery_id">
					<option value="-1">none</option>
					<?php $_from = $this->_tpl_vars['site']['galleries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gallery']):
?>
						<option value="<?php echo $this->_tpl_vars['gallery']['id']; ?>
" <?php if ($this->_tpl_vars['gallery']['id'] == $this->_tpl_vars['page']['gallery_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['gallery']['name']; ?>
</option>
					<?php endforeach; else: ?>
						<option value="-1">no galleries found</option>
					<?php endif; unset($_from); ?>
				</select>
				<br class="clearBoth"/>
				
				<?php if ($this->_tpl_vars['page']['url'] != "/"): ?>
				<label>Section:</label>
				<select name="section">
					<option value=">-1">top level</option>
					<?php $_from = $this->_tpl_vars['site']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section']):
?>
						<?php if ($this->_tpl_vars['section']['url'] != "/" && $this->_tpl_vars['section']['url'] != $this->_tpl_vars['page']['url']): ?>
						<option value="<?php echo $this->_tpl_vars['section']['url']; ?>
><?php echo $this->_tpl_vars['section']['id']; ?>
" <?php if ($this->_tpl_vars['section']['url'] == $this->_tpl_vars['page']['section']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['section']['url']; ?>
</option>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<br class="clearBoth"/>
				<?php endif; ?>
	
				<label>Content:</label>
				<textarea id="textEditor" rows="10" cols="100" name="content"><?php echo $this->_tpl_vars['page']['content']; ?>
</textarea>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<textarea rows="5" cols="50" name="description" placeholder="description"><?php echo $this->_tpl_vars['page']['description']; ?>
</textarea>
				<br class="clearBoth"/>
				
				<label>Keywords:</label>
				<input type="text" name="keywords" value="<?php echo $this->_tpl_vars['page']['keywords']; ?>
" placeholder="keywords"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']['id']; ?>
"/>
				<input type="hidden" name="edited_by" value="<?php echo $this->_tpl_vars['site']['user']; ?>
"/>
				<input type="hidden" name="table" value="pages"/>
				
				<input type="submit" name="action" value="save changes"/>
				<?php if ($this->_tpl_vars['page']['url'] != "/"): ?>
					<input type="submit" name="action" value="delete page"/>
				<?php endif; ?>	
				
			</fieldset>
			
		</form>
	
	</div>
	
	<br class="clearBoth"/>
	
	<div id="menu">
		
		<h3>Select menu</h3>
		<hr/>
		
		<form method="post" action="">
		
			<fieldset>
				
				<label>Menu:</label>
				<select name="table">
					<option value="header_nav">header menu</option>
					<option value="main_nav">main menu</option>
					<option value="footer_nav">footer menu</option>
				</select>
				
				<input type="hidden" name="name" value="<?php echo $this->_tpl_vars['page']['name']; ?>
"/>
				<input type="hidden" name="page_id" value="<?php echo $this->_tpl_vars['page']['id']; ?>
"/>
				<input type="hidden" name="parent" value="<?php echo $this->_tpl_vars['page']['parent']; ?>
"/>
				<input type="hidden" name="menu_order" value="1"/>
				<input type="hidden" name="type" value="page"/>
				
				<input type="submit" name="action" value="add to menu"/>

			</fieldset>
			
		</form>	
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="hero">
	
		<form method="post" action="">
			
			<fieldset>
				
				<h3>Choose hero image</h3>
				<hr/>
				
				<?php $_from = $this->_tpl_vars['page']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
					<div class="imageHolder">
						<img src="<?php echo $this->_tpl_vars['HOME']; ?>
<?php echo $this->_tpl_vars['image']['src']; ?>
" width="120" alt="<?php echo $this->_tpl_vars['image']['description']; ?>
"/>
						<div class="inputHolder">
							<input type="radio" name="image_id" value="<?php echo $this->_tpl_vars['image']['id']; ?>
" <?php if ($this->_tpl_vars['image']['id'] == $this->_tpl_vars['page']['image_id']): ?>checked="checked"<?php endif; ?>/>
						</div>
					</div>
				<?php endforeach; else: ?>
					<p>Please add a gallery to select a hero image.</p>
				<?php endif; unset($_from); ?>
				
				<br class="clearBoth"/>
				
				<?php if ($this->_tpl_vars['page']['images']): ?>
					<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']['id']; ?>
"/>
					<input type="hidden" name="table" value="pages"/>
					
					<input type="submit" name="action" value="save"/>
				<?php endif; ?>
			
			</fieldset>
			
		</form>
	
	</div>
	
	<br class="clearBoth"/>
	
	<div id="downloads">
	
		<form method="post" action="" enctype="multipart/form-data">
		
			<fieldset>
		
				<h3>Add Download</h3>
				<hr/>
				
				<label>Upload resource:</label>
				<input type="file" name="upload" value="" required="required" placeholder="file"/>
				<br class="clearBoth"/>
				
				<label>Name:</label>
				<input type="text" name="name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<input type="text" name="description" value="" placeholder="description"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="belongs_to" value="<?php echo $this->_tpl_vars['page']['id']; ?>
"/>
				<input type="hidden" name="area" value="pages"/>
				<input type="hidden" name="table" value="downloads"/>
				
				<input type="submit" name="action" value="upload"/>
				
			</fieldset>
		
		</form>
		
		<br class="clearBoth"/>
		
		<form method="post" action="">
			
			<fieldset>
				
				<h3>Downloads</h3>
				<hr/>
				
				<div class="whitePod">
					<div class="pad10">
						<?php $_from = $this->_tpl_vars['page']['downloads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['download']):
?>
							<div class="download">
								<a href="<?php echo $this->_tpl_vars['HOME']; ?>
<?php echo $this->_tpl_vars['download']['src']; ?>
" title="<?php echo $this->_tpl_vars['download']['description']; ?>
"><?php echo $this->_tpl_vars['download']['name']; ?>
</a>
								<input type="checkbox" name="item<?php echo $this->_tpl_vars['download']['id']; ?>
"/>
							</div>
						<?php endforeach; else: ?>
							<span>No downloads found.</span>
						<?php endif; unset($_from); ?>
					</div>
				</div>
				
				<?php if ($this->_tpl_vars['page']['downloads']): ?>
					<br class="clearBoth"/>
					<input type="hidden" name="table" value="downloads"/>
					<input type="submit" name="action" value="delete selected"/>
				<?php endif; ?>
		
			</fieldset>
			
		</form>
	
	</div>
	
	<br class="clearBoth"/>
	
	<div id="info">
		
		<h3><?php echo $this->_tpl_vars['page']['title']; ?>
 info</h3>
		<hr/>
		
		<p><span class="bold">Created by:</span> <?php echo $this->_tpl_vars['page']['created_by']; ?>
</p>
		<p><span class="bold">Created on:</span> <?php echo $this->_tpl_vars['page']['created']; ?>
</p>
		<p><span class="bold">Last edited by:</span> <?php echo $this->_tpl_vars['page']['edited_by']; ?>
</p>
		<p><span class="bold">Page views:</span> <?php echo $this->_tpl_vars['page']['page_visits']; ?>
</p>
		
	</div>
	
</section>