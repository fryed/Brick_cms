<section class="mainCol col">

	<h1>{$page.name}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#images">Images</a></li>
		<li><a href="#upload">Upload image</a></li>
	</ul>
	
	<div id="images">
		
		<form method="post" action="">
	
			<fieldset>
				
				{foreach from=$page.images item=image}
					<div class="imageHolder">
						<img src="{$HOME}{$image.src}" height="100" alt="{$image.description}"/>
						<div class="inputHolder">
							<input type="checkbox" name="item{$image.id}"/>
						</div>
					</div>
				{foreachelse}
					<p>No images found.</p>
				{/foreach}
				
				<br class="clearBoth"/>
				
				<hr/>
			
				<input type="hidden" name="table" value="images"/>
				<input type="submit" name="action" class="delete" value="delete selected"/>
		
			</fieldset>
			
		</form>

	</div>
	
	<br class="clearBoth"/>
	
	<div id="upload">
		
		<form method="post" action="" enctype="multipart/form-data">
	
			<fieldset>
				
				<label>Upload image:</label>
				<input type="file" name="upload" value="" required="required" placeholder="file"/>
				<br class="clearBoth"/>
				
				<label>Description:</label>
				<input type="text" name="description" value="" placeholder="description"/>
				<br class="clearBoth"/>
				
				<input type="hidden" name="belongs_to" value="{$page.id}"/>
				<input type="hidden" name="table" value="images"/>
				
				<input type="submit" name="action" value="upload"/>
				
			</fieldset>
		
		</form>	
		
	</div>
	
</section>
