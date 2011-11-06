<section class="mainCol col">

	<h1>Pages</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#pages">View pages</a></li>
	</ul>
	
	<div id="pages">
		
		<h3>Pages</h3>
		<hr/>
		
		{foreach from=$site.pages  item=page}
		<div class="row">
				
			<div class="leftRow">
			
				<div class="imageHolder">
					<a href="{$ADMIN_HOME}{$page.url}">
						{if $page.main_image}
						<img src="{$HOME}{$page.main_image.src}" width="50" alt="{$page.main_image.description}"/>
						{else}
						<div class="noImage"></div>
						{/if}
					</a>
				</div>
				
				<h4><a href="{$ADMIN_HOME}{$page.url}">{$page.name}</a></h4>
				<p>{$page.description}</p>
			
			</div>
			
			<div class="rightRow">
				<a class="button" href="{$ADMIN_HOME}{$page.url}">edit page</a>
			</div>

		</div>
		<hr/>
		{foreachelse}
			<p>No pages found</p>
		{/foreach}
	
		<br class="clearBoth"/>
	
	</div>
	
</section>