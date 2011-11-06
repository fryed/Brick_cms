<div class="pod logoPod">
	{if $site.logo}
		<form method="post" action="" enctype="multipart/form-data">
			
			<fieldset>
				
				<h3>Site logo</h3>
				<hr/>
				
				<div class="innerPod">
					<img src="{$HOME}{$site.logo.src}" alt="{$site.logo.description}"/>
					<div class="deleteLogo">
						<input type="submit" name="action" value="delete logo"/>
					</div>
				</div>
				
				<input type="hidden" name="item{$site.logo.id}" value="on"/>
				<input type="hidden" name="table" value="images"/>
				
			</fieldset>
			
		</form>		
	{else}	
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
	{/if}	
</div>

<br class="clearBoth"/>

{if $page.section == "/blog"}

<div class="pod menuPod">
	
	<h3>Blog menu</h3>
	<hr/>
	
	<div class="innerPod">
	{foreach from=$blog.menu item=category}
	
		<h4>{$category.name}</h4>
		<nav>
			<ul class="mainNav">
			{foreach from=$category.pages item=article}
				<li><a href="{$ADMIN_HOME}{$article.url}">{$article.name}</a></li>
			{foreachelse}
				<li>No articles found.</li>
			{/foreach}
			</ul>
		</nav>
		
	{foreachelse}
		<p>No categories found.</p>
	{/foreach}
	</div>

</div>

{elseif $page.section == "/news"}
	
<div class="pod menuPod">
	
	<h3>News menu</h3>
	<hr/>
	
	<div class="innerPod">
	{foreach from=$news.menu item=category}

		<h4>{$category.name}</h4>
		<nav>
			<ul class="mainNav">
			{foreach from=$category.pages item=article}
				<li><a href="{$ADMIN_HOME}{$article.url}">{$article.name}</a></li>
			{foreachelse}
				<li>No articles found.</li>
			{/foreach}
			</ul>
		</nav>

	{foreachelse}
		<p>No categories found.</p>
	{/foreach}
	</div>
	
</div>
	
{else}

<div class="pod menuPod">
	
	<h3>Site menu</h3>
	<hr/>
	
	<form method="post" action="">
		
		<fieldset>

			<div class="innerPod">
				
				<nav>
					{assign var=navType value=$menu.main}
					{include file="nav.tpl"}
				</nav>
				
				<br class="clearBoth"/>
				
			</div>
			
			<input type="hidden" name="table" value="main_nav"/>
			<input type="submit" name="action" value="update menu"/>
		
		</fieldset>
	
	</form>
	
</div>

{/if}

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