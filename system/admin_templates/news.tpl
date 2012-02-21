<section class="mainCol col">

	<h1>Blog</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#articles">Articles</a></li>
		<li><a href="#edit">Edit news homepage</a></li>
		<li><a href="#hero">Hero image</a></li>
	</ul>
	
	<div id="articles">
		
		<h3>News pages</h3>
		<hr/>
		
		{foreach from=$news.pages item=article}
		<div class="row">
				
			<div class="leftRow">
			
				<div class="imageHolder">
					<a href="{$ADMIN_HOME}{$article.url}">
						{if $article.main_image}
						<img src="{$HOME}/{$article.main_image.src}" width="50" alt="{$article.main_image.description}"/>
						{else}
						<div class="noImage"></div>
						{/if}
					</a>
				</div>
				
				<h4><a href="{$ADMIN_HOME}{$article.url}">{$article.name}</a></h4>
				<p>{$article.description}</p>
			
			</div>
			
			<div class="rightRow">
				<a class="button" href="{$ADMIN_HOME}{$article.url}">edit article</a>
			</div>

		</div>
		{foreachelse}
			<p>No articles found.</p>
		{/foreach}

		{include file="paging.tpl"}
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="edit">
		
		<form method="post" action="">
	
			<fieldset>
				
				<label>Article title:</label>
				<input type="text" name="title" value="{$page.title}" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Article name:</label>
				<input type="text" name="name" value="{$page.name}" required="required" placeholder="name"/>
				<br class="clearBoth"/>
		
				<label>Gallery:</label>
				<select name="gallery_id">
					<option value="-1">none</option>
					{foreach from=$site.galleries  item=gallery}
						<option value="{$gallery.id}" {if $gallery.id == $page.gallery_id} selected="selected"{/if}>{$gallery.name}</option>
					{foreachelse}
						<option value="-1">no galleries found</option>
					{/foreach}
				</select>
				<br class="clearBoth"/>
			
				<label>Content:</label>
				<textarea id="textEditor" rows="10" cols="100" name="content">{$page.content}</textarea>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<textarea rows="5" cols="50" name="description" placeholder="description">{$page.description}</textarea>
				<br class="clearBoth"/>
				
				<label>Keywords:</label>
				<input type="text" name="keywords" value="{$page.keywords}" placeholder="keywords"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="id" value="{$page.id}"/>
				<input type="hidden" name="edited_by" value="{$site.user}"/>
				<input type="hidden" name="table" value="news"/>
				<input type="hidden" name="enabled" value="1"/>
				<input type="hidden" name="url" value="/news"/>
				
				<input type="submit" name="action" value="save changes"/>	
				
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="hero">
		
		<form method="post" action="">
	
			<fieldset>
				
				<h3>Choose hero image</h3>
				<hr/>
				
				{foreach from=$page.images item=image}
					{$image.id}<br/>
					<div class="imageHolder">
						<img src="{$HOME}/{$image.src}" width="120" alt="{$image.description}"/>
						<div class="inputHolder">
							<input type="radio" name="image_id" value="{$image.id}" {if $image.id == $page.image_id}checked="checked"{/if}/>
						</div>
					</div>
				{foreachelse}
					<p>Please add a gallery to select an image.</p>
				{/foreach}
				
				<input type="hidden" name="id" value="{$page.id}"/>
				<input type="hidden" name="table" value="news"/>
				
				<input type="submit" name="action" value="save"/>
		
			</fieldset>
			
		</form>
				
		
	</div>
	
</section>

