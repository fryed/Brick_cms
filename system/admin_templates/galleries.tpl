<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#galleries">Galleries</a></li>
		<li><a href="#create">Create gallery</a></li>
	</ul>
	
	<div id="galleries">
		
		<h3>Gallery list</h3>
		<hr/>
		
		<form method="post" action="">

			<fieldset>
		
				{foreach from=$site.galleries item=gallery}
				<div class="row">
					
					<div class="imageHolder">
						<a href="{$ADMIN_HOME}{$gallery.url}">
						{if $gallery.image}
							<img src="{$HOME}/{$gallery.image.src}" width="50" alt="{$gallery.image.description}"/>
						{else}
							<div class="noImage"></div>
						{/if}
						</a>
					</div>
					
					<h4><a href="{$ADMIN_HOME}{$gallery.url}">{$gallery.name}</a></h4>
					
					<input type="checkbox" name="{$gallery.id}"/>	
					
				</div>
				<hr/>
				{foreachelse}
					<p>No galleries found.</p>
				{/foreach}
				
				<input type="hidden" name="table" value="galleries"/>
				<input type="submit" name="action" class="delete" value="delete selected"/>
		
			</fieldset>
	
		</form>	
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="create">
		
		<form method="post" action="">

			<fieldset>
				
				<label>Gallery name:</label>
				<input type="text" name="name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
						
				<input type="hidden" name="table" value="galleries"/>
				
				<input type="submit" name="action" value="create gallery"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
</section>

