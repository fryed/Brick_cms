<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#links">Links</a></li>
		<li><a href="#add">Add link</a></li>
	</ul>
	
	<div id="links">
		
		<h3>Link list</h3>
		<hr/>
		
		<form method="post" action="">
	
			<fieldset>
				
			{foreach from=$site.links item=link}
				<div class="row">
					
					<a href="{$link.url}" title="{$link.description}">{$link.name}</a>
					<input type="checkbox" name="item{$link.id}"/>
					
				</div>
				<hr/>	
			{foreachelse}
				<p>No links found.</p>
			{/foreach}
			
				<input type="hidden" name="table" value="links"/>
				<input type="submit" name="action" value="delete selected"/>
		
			</fieldset>
			
		</form>
				
	</div>
	
	<br class="clearBoth"/>
	
	<div id="add">
		
		<form method="post" action="">
	
			<fieldset>
				
				<label>Name:</label>
				<input type="text" name="name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<input type="text" name="description" value="" required="required" placeholder="description"/>
				<br class="clearBoth"/>
				
				<label>Url:</label>
				<input type="url" name="url" value="" required="required" placeholder="http://"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="table" value="links"/>
				<input type="submit" name="action" value="add link"/>
				
			</fieldset>
			
		</form>	
		
	</div>
	
</section>
