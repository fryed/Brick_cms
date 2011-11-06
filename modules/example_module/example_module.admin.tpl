<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#module">Module</a></li>
	</ul>
	
	<div id="module">

		<form method="post" action="">
			
			<fieldset>
				
				<label>Title:</label>
				<input type="text" name="title" value="{$module.example_module.title}" required="required" placeholder="title"/>
				<br class="clearBoth"/>
				
				<label>Content:</label>
				<textarea id="textEditor" name="content" rows="10" cols="100">{$module.example_module.content}</textarea>
				<br class="clearBoth"/>
				
				<input type="submit" name="save_example_module" value="save example module"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
</section>

