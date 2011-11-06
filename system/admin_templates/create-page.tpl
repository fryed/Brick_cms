<section class="mainCol col equalInput">

	<h1 class="pageTitle">{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#create">Create page</a></li>
	</ul>
	
	<div id="create">
		
		<form method="post" action="">
			
			<fieldset>
				
				<label>Page title:</label>
				<input type="text" name="title" value="" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Page name:</label>
				<input type="text" name="name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Uri:</label>
				<input type="text" name="uri" value="/" required="required" placeholder="uri"/>
				<br class="clearBoth"/>
				
				<label>Template:</label>
				<select name="template">
				 	{foreach from=$site.templates item=template}
						<option value="{$template}">{$template}</option>
					{foreachelse}
						<option value="error">no templates found</option>
					{/foreach}
				</select>	
				<br class="clearBoth"/>
				
				<label>Gallery:</label>
				<select name="gallery_id">
					<option value="-1">none</option>
					{foreach from=$site.galleries item=gallery}
						<option value="{$gallery.id}">{$gallery.name}</option>
					{foreachelse}
						<option value="-1">no galleries found</option>
					{/foreach}
				</select>
				<br class="clearBoth"/>
				
				<label>Content:</label>
				<textarea id="textEditor" rows="10" cols="100" name="content"></textarea>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<textarea rows="5" cols="50" name="description" placeholder="description"></textarea>
				<br class="clearBoth"/>
				
				<label>Keywords:</label>
				<input type="text" name="keywords" value="" placeholder="keywords"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="table" value="pages"/>
				<input type="hidden" name="created_by" value="{$site.user}"/>
				<input type="hidden" name="edited_by" value=""/>
				
				<input type="submit" name="action" value="create page"/>
				
			</fieldset>
			
		</form>
	
	</div>

</section>

