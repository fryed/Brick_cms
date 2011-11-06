<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#brick">Brick</a></li>
	</ul>
	
	<div id="brick">

		<form method="post" action="">
			
			<fieldset>
				
				<label>Enabled:</label>
				<input type="checkbox" name="enabled" {if $page.enabled}checked="checked"{/if}/>
				<br class="clearBoth"/>
				
				{if $site.user_type == "developer"}
				<label>Name:</label>
				<input type="text" name="brick_name" value="{$page.brick_name}" disabled="disabled"/>
				<br class="clearBoth"/>
				{/if}
				
				<label>Title:</label>
				<input type="text" name="title" value="{$page.title}" required="required" placeholder="title"/>
				<br class="clearBoth"/>
			
				{if $site.user_type == "developer"}
				<label>Template:</label>
				<select name="page_template">
					<option value="global">global</option>
				 	{foreach from=$site.templates item=template}
						<option value="{$template}" {if $page.page_template == $template}selected="selected"{/if}>{$template}</option>
					{foreachelse}
						<option value="global">no templates found</option>
					{/foreach}
				</select>	
				<br class="clearBoth"/>
				{/if}
				
				<label>Content:</label>
				<textarea id="textEditor" name="content" rows="10" cols="100">{$page.content}</textarea>
				<br class="clearBoth"/>
				
				<input type="hidden" name="id" value="{$page.id}"/>
				<input type="hidden" name="table" value="bricks"/>
				
				<input type="submit" name="action" value="save"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
</section>