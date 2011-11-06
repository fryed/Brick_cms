<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#settings">Settings</a></li>
		<li><a href="#favicon">Favicon</a></li>
		{if $site.user_type == "developer"}
		<li><a href="#devSettings">Developer settings</a></li>
		{/if}
	</ul>
	
	<div id="settings">
		
		<form method="post" action="">
	
			<fieldset>
		
				<label>Site name:</label>
				<input type="text" name="name" value="{$site.name}" required="required" placeholder="site name"/>
				<br class="clearBoth"/>
				
				<label>Site email:</label>
				<input type="email" name="email" value="{$site.email}" placeholder="site email"/>
				<br class="clearBoth"/>
				
				<label>Company name:</label>
				<input type="text" name="company_name" value="{$site.company_name}" placeholder="company name"/>
				<br class="clearBoth"/>
				
				<label>Company email:</label>
				<input type="email" name="company_email" value="{$site.company_email}" placeholder="company email"/>
				<br class="clearBoth"/>
				
				<label>Company tel:</label>
				<input type="number" name="company_tel" value="{$site.company_tel}" placeholder="company telephone"/>
				<br class="clearBoth"/>
				
				<label>Address 1:</label>
				<input type="text" name="address_1" value="{$site.address_1}" placeholder="address 1"/>
				<br class="clearBoth"/>
				
				<label>Address 2:</label>
				<input type="text" name="address_2" value="{$site.address_2}" placeholder="address 2"/>
				<br class="clearBoth"/>
				
				<label>Address 3:</label>
				<input type="text" name="address_3" value="{$site.address_3}" placeholder="address 3"/>
				<br class="clearBoth"/>
				
				<label>Postcode / Zip code:</label>
				<input type="text" name="postcode" value="{$site.postcode}" placeholder="postcode"/>
				<br class="clearBoth"/>
				
				<label>Postcode for map:</label>
				<input type="text" name="map_postcode" value="{$site.map_postcode}" placeholder="map postcode"/>
				<br class="clearBoth"/>
				
				<label>Country:</label>
				<input type="text" name="country" value="{$site.country}" placeholder="country"/>
				<br class="clearBoth"/>
				
				<label>Site Description:</label>
				<textarea name="description" placeholder="site description">{$site.description}</textarea>
				<br class="clearBoth"/>
				
				<label>Site Keywords:</label>
				<input type="text" name="keywords" value="{$site.keywords}" placeholder="site keywords"/>
				<br class="clearBoth"/>
				
				<label>Twitter account:</label>
				<input type="text" name="twitter_account" value="{$site.twitter_account}" placeholder="twitter accound"/>
				<br class="clearBoth"/>
				
				<label>Facebook account:</label>
				<input type="text" name="facebook_account" value="{$site.facebook_account}" placeholder="facebook account"/>
				<br class="clearBoth"/>
				
				<label>Youtube account:</label>
				<input type="text" name="youtube_account" value="{$site.youtube_account}" placeholder="youtube account"/>
				<br class="clearBoth"/>
		
				<input type="hidden" name="id" value="1"/>
				<input type="hidden" name="table" value="site"/>
				
				<input type="submit" name="action" value="save"/>
				
			</fieldset>
			
		</form>
		
	</div>
	
	<br class="clearBoth"/>
	
	<div id="favicon">
		
		<h3>favicon</h3>
		<hr/>

		{if $site.favicon}
			
			<form method="post" action="" enctype="multipart/form-data">
				
				<fieldset>
					
					<div class="row">
						
						<div class="imageHolder">
							<img src="{$HOME}{$site.favicon.src}" width="50" alt="favicon"/>
							<div class="inputHolder">
								<input type="radio" name="item{$site.favicon.id}" value="on" checked="checked"/>
							</div>
						</div>
						
						<input type="hidden" name="table" value="images"/>
					
					</div>
					<hr/>
					
					<input type="submit" name="action" value="delete selected"/>
					
				</fieldset>
				
			</form>		
			
		{else}	
		
			<form method="post" action="" enctype="multipart/form-data">
				
				<fieldset>
					
					<label>Upload favicon:</label>
					<input type="file" name="upload" value="" required="required" placeholder="file"/>
					<br class="clearBoth"/>
					
					<input type="hidden" name="belongs_to" value="-3"/>
					
					<input type="hidden" name="table" value="images"/>
					
					<input type="submit" name="action" value="upload"/>
					
				</fieldset>
				
			</form>	
			
		{/if}	
		
	</div>
	
	<br class="clearBoth"/>
	
	{if $site.user_type == "developer"}
	<div id="devSettings">
		
		<form method="post" action="">
	
			<fieldset>
				
				<label>Theme:</label>
				<select name="theme">
					{foreach from=$settings.themes item=theme}
						<option value="{$theme}" {if $theme == $settings.theme}selected="selected"{/if}>{$theme}</option>
					{foreachelse}
						<option value="default">no themes found</option>
					{/foreach}	
				</select>
				<br class="clearBoth"/>
				
				<label>Debug:</label>
				<select name="debug">
					<option value="0" {if $settings.debug == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.debug == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Cache:</label>
				<select name="cache">
					<option value="0" {if $settings.cache == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.cache == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Super cache:</label>
				<select name="super_cache">
					<option value="0" {if $settings.super_cache == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.super_cache == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>News:</label>
				<select name="news">
					<option value="0" {if $settings.news == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.news == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Blog:</label>
				<select name="blog">
					<option value="0" {if $settings.blog == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.blog == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Max news items pp:</label>
				<input type="number" name="max_news" value="{$settings.max_news}" required="required" placeholder="max news items per page"/>
				<br class="clearBoth"/>
				
				<label>Max blog items pp:</label>
				<input type="number" name="max_blog" value="{$settings.max_blog}" required="required" placeholder="max blog items per page"/>
				<br class="clearBoth"/>
				
				<label>Max latest news items:</label>
				<input type="number" name="max_latest_news" value="{$settings.max_latest_news}" required="required" placeholder="max latest news items per page"/>
				<br class="clearBoth"/>
				
				<label>Max latest blog items:</label>
				<input type="number" name="max_latest_blog" value="{$settings.max_latest_blog}" required="required" placeholder="max latest blog items per page"/>
				<br class="clearBoth"/>
				
				<label>Max upload filesize:</label>
				<input type="number" name="max_upload_size" value="{$settings.max_upload_size}" required="required" placeholder="max upload filesize"/>
				<br class="clearBoth"/>
				
				<label>Allowed image types:</label>
				<input type="text" name="allowed_images" value="{$settings.allowed_images}" required="required" placeholder="list of file types seperated by a commer"/>
				<br class="clearBoth"/>
				
				<label>Allowed file types:</label>
				<input type="text" name="allowed_files" value="{$settings.allowed_files}" required="required" placeholder="list of file types seperated by a commer"/>
				<br class="clearBoth"/>
				
				<label>Custom errors:</label>
				<select name="custom_errors">
					<option value="0" {if $settings.custom_errors == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.custom_errors == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Email errors:</label>
				<select name="email_errors">
					<option value="0" {if $settings.email_errors == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.email_errors == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Developer email:</label>
				<input type="email" name="dev_email" value="{$settings.dev_email}" placeholder="dev email"/>
				<br class="clearBoth"/>
				
				<label>Maintenance mode:</label>
				<select name="maintenance">
					<option value="0" {if $settings.maintenance == 0}selected="selected"{/if}>false</option>
					<option value="1" {if $settings.maintenance == 1}selected="selected"{/if}>true</option>
				</select>
				<br class="clearBoth"/>
				
				<label>Your ip:</label>
				<input type="text" name="ip_address" value="{$settings.ip_address}" disabled="disabled"/>
				<input type="hidden" name="ip_address" value="{$settings.ip_address}"/>
				<br class="clearBoth"/>
						
				<input type="hidden" name="id" value="1"/>
				<input type="hidden" name="table" value="settings"/>
				
				<input type="submit" name="action" value="save"/>
				
			</fieldset>
			
		</form>	
		
		<hr/>
		
		<form method="post" action="">
	
			<fieldset>
				
				<input type="submit" name="action" value="clear cache">
				
			</fieldset>
			
		</form>
		
	</div>
	{/if}
	
</section>


