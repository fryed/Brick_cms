<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#bricks">View bricks</a></li>
		{if $site.user_type =="developer"}
		<li><a href="#create">Create brick</a></li>
		{/if}
	</ul>
	
	<div id="bricks">
		
		<h3>Bricks</h3>
		<hr/>
		
		<form method="post" action="">
	
			<fieldset>
				
				{foreach from=$page.bricks item=brick}
					<div class="row">
						<a href="{$ADMIN_HOME}/bricks/{$brick.brick_name}">{$brick.title}</a>
						<input type="checkbox" name="{$brick.id}"/>
					</div>
					<hr/>
				{foreachelse}
					<p>No bricks found.</p>
				{/foreach}
				
				<input type="hidden" name="table" value="bricks"/>
				<input type="submit" name="action" value="delete selected"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	{if $site.user_type =="developer"}
	<div id="create">
		
		<h3>Create brick</h3>
		<hr/>

		<form method="post" action="">
			
			<fieldset>
				
				<label>Name:</label>
				<input type="text" name="brick_name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Title:</label>
				<input type="text" name="title" value="" required="required" placeholder="title"/>
				<br class="clearBoth"/>
			
				<label>Template:</label>
				<select name="page_template">
					<option value="global">global</option>
				 	{foreach from=$site.templates item=template}
						<option value="{$template}">{$template}</option>
					{foreachelse}
						<option value="global">no templates found</option>
					{/foreach}
				</select>	
				<br class="clearBoth"/>
				
				<label>Content:</label>
				<textarea id="textEditor" name="content" rows="10" cols="100"></textarea>
				<br class="clearBoth"/>
				
				<input type="hidden" name="table" value="bricks"/>
				<input type="submit" name="action" value="create"/>
				
			</fieldset>
			
		</form>

	</div>
	{/if}
	
</section>

