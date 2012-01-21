<section class="mainCol col blog">

	<h1>Edit article "{$page.title}"</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#edit">Edit article</a></li>
		<li><a href="#comments">Comments</a></li>
		<li><a href="#hero">Hero image</a></li>
		<li><a href="#downloads">Downloads</a></li>
		<li><a href="#info">Article info</a></li>
	</ul>
	
	<div id="edit">
			
		<form method="post" action="">
			
			<fieldset>
				
				<label>Enabled:</label>
				<input type="checkbox" name="enabled" {if $page.enabled}checked="checked"{/if}/>
				<br class="clearBoth"/>
				
				<label>Article title:</label>
				<input type="text" name="title" value="{$page.title}" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Article name:</label>
				<input type="text" name="name" value="{$page.name}" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Uri:</label>
				<input type="text" name="uri" value="{$page.uri}" {if $page.uri == "/"}disabled="disabled"{/if} required="required" placeholder="uri"/>
				<br class="clearBoth"/>
				
				<label>Url:</label>
				<input type="text" name="url" value="{$page.url}" disabled="disabled"/>
				<input type="hidden" name="url" value="{$page.url}"/>
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
				
				<label>Category:</label>
				<select name="category_id">
					{foreach from=$site.categories  item=category}
						<option value="{$category.id}" {if $category.id == $page.category_id}selected="selected"{/if}>{$category.name}</option>
					{foreachelse}
						<option value="-1">General</option>
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
				
				<input type="hidden" name="section" value="{$page.section}>0"/>
				<input type="hidden" name="id" value="{$page.id}"/>
				<input type="hidden" name="edited_by" value="{$site.user}"/>
				<input type="hidden" name="table" value="blog"/>
				
				<input type="submit" name="action" value="save changes"/>
				{if $site.user_type != "user"}
					<input type="submit" name="action" class="delete" value="delete article"/>
				{/if}
				
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="comments">
		
		<h3>Comment list</h3>
		<hr/>
		
		<form method="post" action="">
	
			<fieldset>
				
				{foreach from=$page.comments item=comment}
				<div class="row">
					<h4>{$comment.name} -<span class="date"> on {$comment.created|date_format}</span></h4>
					<p>{$comment.comment}</p>	
					<input type="checkbox" name="item{$comment.id}"/>
				</div>
				<hr/>
					
				{foreachelse}	
					<p>No comments found.</p>
				{/foreach}
				
				<input type="hidden" name="table" value="blog_comments"/>
				
				<input type="submit" name="action" class="delete" value="delete selected"/>
				
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
					<div class="imageHolder">
						<img src="{$HOME}{$image.src}" width="120" alt="{$image.description}"/>
						<div class="inputHolder">
							<input type="radio" name="image_id" value="{$image.id}" {if $image.id == $page.image_id}checked="checked"{/if}/>
						</div>
					</div>
				{foreachelse}
					<p>Please add a gallery to select a hero image.</p>
				{/foreach}
				
				<br class="clearBoth"/>
				
				{if $page.images}
					<input type="hidden" name="id" value="{$page.id}"/>
					<input type="hidden" name="table" value="blog"/>
					
					<input type="submit" name="action" value="save"/>
				{/if}
			
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
				<input type="file" name="upload" required="required"/>
				<br class="clearBoth"/>
				
				<label>Name:</label>
				<input type="text" name="name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<input type="text" name="description" value="" placeholder="description"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="table" value="downloads"/>
				<input type="hidden" name="area" value="blog"/>
				<input type="submit" name="action" value="upload"/>
				
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
						{foreach from=$page.downloads item=download}
							<div class="download">
								<a href="{$HOME}{$download.src}" title="{$download.description}">{$download.name}</a>
								<input type="checkbox" name="item{$download.id}"/>
							</div>
						{foreachelse}
							<span>No downloads found.</span>
						{/foreach}
					</div>
				</div>
				
				{if $page.downloads}
					<br class="clearBoth"/>
					<input type="hidden" name="table" value="downloads"/>
					<input type="submit" name="action" class="delete" value="delete selected"/>
				{/if}
		
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="info">
		
		<h3>{$page.title} info</h3>
		<hr/>
		
		<p><span class="bold">Created by:</span> {$page.created_by}</p>
		<p><span class="bold">Last edited on:</span> {$page.created}</p>
		<p><span class="bold">Last edited by:</span> {$page.edited_by}</p>
		<p><span class="bold">Page views:</span> {$page.page_visits}</p>
		
	</div>
	
</section>

