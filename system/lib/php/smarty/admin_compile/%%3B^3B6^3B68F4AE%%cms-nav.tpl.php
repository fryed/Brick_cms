<?php /* Smarty version 2.6.20, created on 2011-11-06 11:36:40
         compiled from cms-nav.tpl */ ?>
<ul>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'dashboard'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/dashboard" class="dash">Dashboard</a></li>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'pages'): ?>class="active"<?php endif; ?>>Pages
		<ul class="cmsSubNav">
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/pages">
				View pages<br/><span>View a list of the sites pages</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/create">
				Create page<br/><span>Create a page</span>
			</a></li>
		</ul>
	</li>
	<?php if ($this->_tpl_vars['settings']['blog']): ?>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'blog'): ?>class="active"<?php endif; ?>>Blog
		<ul class="cmsSubNav">
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/blog">
				View articles<br/><span>View a list of blog articles</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/blog/create">
				Create article<br/><span>Create a blog article</span>
			</a></li>
		</ul>
	</li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['settings']['news']): ?>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'news'): ?>class="active"<?php endif; ?>>News
		<ul class="cmsSubNav">
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/news">
				View articles<br/><span>View a list of news articles</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/news/create">
				Create article<br/><span>Create a news article</span>
			</a></li>
		</ul>
	</li>
	<?php endif; ?>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'bricks'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/bricks">Bricks</a></li>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'modules'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/modules">Modules</a></li>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'site'): ?>class="active"<?php endif; ?>>Site
		<ul class="cmsSubNav">
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/feature">
				Feature area<br/><span>Edit the sites feature area</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/galleries">
				Galleries<br/><span>Create image galleries which can then be linked to pages</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/links">
				Links<br/><span>Add links to the site for seo</span>
			</a></li>
			<li><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/users">
				Users<br/><span>Add and remove users and edit your account</span>
			</a></li>
		</ul>
	</li>
	<li <?php if ($this->_tpl_vars['page']['active'] == 'settings'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/settings">Settings</a></li>
</ul>