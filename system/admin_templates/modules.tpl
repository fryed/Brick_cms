<section class="mainCol col">

	<h1>Modules</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#modules">View modules</a></li>
		{if $site.user_type == "developer"}
		<li><a href="#create">Create module</a></li>
		<li><a href="#install">Install module</a></li>
		{/if}
	</ul>
	
	<div id="modules">
		
		<h3>Modules</h3>
		<hr/>
		
		<form method="post" action="">
	
			<fieldset>
				
				{foreach from=$page.modules item=module}
					<div class="row">
						<a href="{$ADMIN_HOME}/modules/{$module.name}">{$module.name}</a>
						{if $site.user_type == "developer"}
							<span class="buildMode">Build mode: <span class="bold">{if $module.build_mode}ON{else}OFF{/if}</span></span>
							<input type="checkbox" name="{$module.name}"/>
						{/if}
					</div>
					<hr/>
				{foreachelse}
					<p>No modules installed.</p>
				{/foreach}
				
				{if $site.user_type == "developer"}
				<input type="submit" name="action" class="delete" value="uninstall selected"/>
				<input type="submit" name="action" value="toggle build mode"/>
				{/if}
				
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	{if $site.user_type == "developer"}
	<div id="create">
		
		<h3>Create module</h3>
		<hr/>

		<form method="post" action="">
			
			<fieldset>
				
				<label>Module name:</label>
				<input type="text" name="module_name" value="" required="required" placeholder="name"/>
				<br class="clearBoth"/>
				
				<input type="submit" name="action" value="create module"/>
				
			</fieldset>
			
		</form>

	</div>
	
	<br class="clearBoth"/>
	
	<div id="install">
		
		<h3>Install module</h3>
		<hr/>

		<form method="post" action="" enctype="multipart/form-data">
			
			<fieldset>
				
				<label>Module:</label>
				<input type="file" name="module" value="" required="required" placeholder="file"/>
				<br class="clearBoth"/>
				
				<input type="submit" name="action" value="install module"/>
				
			</fieldset>
			
		</form>
		
	</div>
	{/if}
	
</section>

