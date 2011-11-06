<ul>
	<li {if $page.active == "dashboard"}class="active"{/if}><a href="{$ADMIN_HOME}/dashboard" class="dash">Dashboard</a></li>
	<li {if $page.active == "pages"}class="active"{/if}>Pages
		<ul class="cmsSubNav">
			<li><a href="{$ADMIN_HOME}/pages">
				View pages<br/><span>View a list of the sites pages</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/create">
				Create page<br/><span>Create a page</span>
			</a></li>
		</ul>
	</li>
	{if $settings.blog}
	<li {if $page.active == "blog"}class="active"{/if}>Blog
		<ul class="cmsSubNav">
			<li><a href="{$ADMIN_HOME}/blog">
				View articles<br/><span>View a list of blog articles</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/blog/create">
				Create article<br/><span>Create a blog article</span>
			</a></li>
		</ul>
	</li>
	{/if}
	{if $settings.news}
	<li {if $page.active == "news"}class="active"{/if}>News
		<ul class="cmsSubNav">
			<li><a href="{$ADMIN_HOME}/news">
				View articles<br/><span>View a list of news articles</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/news/create">
				Create article<br/><span>Create a news article</span>
			</a></li>
		</ul>
	</li>
	{/if}
	<li {if $page.active == "bricks"}class="active"{/if}><a href="{$ADMIN_HOME}/bricks">Bricks</a></li>
	<li {if $page.active == "modules"}class="active"{/if}><a href="{$ADMIN_HOME}/modules">Modules</a></li>
	<li {if $page.active == "site"}class="active"{/if}>Site
		<ul class="cmsSubNav">
			<li><a href="{$ADMIN_HOME}/feature">
				Feature area<br/><span>Edit the sites feature area</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/galleries">
				Galleries<br/><span>Create image galleries which can then be linked to pages</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/links">
				Links<br/><span>Add links to the site for seo</span>
			</a></li>
			<li><a href="{$ADMIN_HOME}/users">
				Users<br/><span>Add and remove users and edit your account</span>
			</a></li>
		</ul>
	</li>
	<li {if $page.active == "settings"}class="active"{/if}><a href="{$ADMIN_HOME}/settings">Settings</a></li>
</ul>