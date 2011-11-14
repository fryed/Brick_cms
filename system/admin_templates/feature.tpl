<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#features">Feature list</a></li>
		<li><a href="#add">Add feature</a></li>
	</ul>
	
	<div id="features">
		
		<h3>Feature list</h3>
		<hr/>
		
		{foreach from=$site.features item=feature}
		<div class="row feature" data-name="{$feature.id}">

			<form method="post" action="" enctype="multipart/form-data">
				
				<div class="imageHolder">
					<img src="{$HOME}{$feature.img_src}" width="50" alt="{$feature.title}"/>
				</div>
				
				<h4>{$feature.title}</h4>
				<p>{$feature.content|truncate:100}</p>
					
				<fieldset class="slider">
					
					<br class="clearBoth"/>

					<label>Title:</label>
					<input type="text" name="title" value="{$feature.title}" required="required" placeholder="title"/>
					<br class="clearBoth"/>
					
					{assign var=external value=true}
					{foreach from=$site.pages item=page}
						{if $feature.url == $page.url}
							{assign var=external value=false}
						{/if}
					{/foreach}
					
					<label>External link:</label>
					<input type="checkbox" name="external" class="toggleLink" {if $external}checked="checked"{/if}/>
					<br class="clearBoth"/>
					
					<div class="internalLink">
						<label>Link:</label>
						<select name="url">
							{foreach from=$site.pages item=page}
							<option value="{$page.url}" {if $feature.url == $page.url}selected="selected"{/if}>{$page.name}</option>
							{foreachelse}
							<option value="">no pages found</option>
							{/foreach}
						</select>
						<br class="clearBoth"/>
					</div>
					
					<div class="externalLink">
						<label>Link:</label>
						<input type="url" name="external_url" value="{$feature.url}"/>
						<br class="clearBoth"/>
					</div>
					
					<label>Upload image:</label>
					<input type="file" name="upload" value="" placeholder="file"/>
					<br class="clearBoth"/>
					
					<label>Content:</label>
					<textarea id="textEditor" name="content" rows="5" cols="100">{$feature.content}</textarea>
					<br class="clearBoth"/>
					
					<input type="hidden" name="table" value="features"/>
					<input type="hidden" name="id" value="{$feature.id}"/>
					<input type="hidden" name="img_src" value="{$feature.img_src}"/>
					
					<input type="submit" name="action" value="edit feature"/>
					<input type="submit" name="action" class="delete" value="delete"/>
			
				</fieldset>
				
			</form>
		
		</div>
		<hr/>
		{foreachelse}
			<p>No features found.</p>
		{/foreach}

	</div>
	
	<br class="clearBoth"/>
	
	<div id="add">
		
		<form method="post" action="" enctype="multipart/form-data">
	
			<fieldset>

				<label>Title:</label>
				<input type="text" name="title" value="" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>External link:</label>
				<input type="checkbox" name="external" class="toggleLink"/>
				<br class="clearBoth"/>
				
				<div class="internalLink">
					<label>Link:</label>
					<select name="url">
						{foreach from=$site.pages item=page}
						<option value="{$page.url}">{$page.name}</option>
						{foreachelse}
						<option value="">no pages found</option>	
						{/foreach}
					</select>
					<br class="clearBoth"/>
				</div>
				
				<div class="externalLink">
					<label>Link:</label>
					<input type="url" name="external_url" value="" placeholder="http://"/>
					<br class="clearBoth"/>
				</div>
				
				<label>Upload image:</label>
				<input type="file" name="upload" value="" placeholder="file"/>
				<br class="clearBoth"/>
				
				<label>Content:</label>
				<textarea id="textEditor" name="content" rows="10" cols="100"></textarea>
				<br class="clearBoth"/>
		
				<input type="hidden" name="table" value="features"/>
				<input type="submit" name="action" value="add feature"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
</section>
