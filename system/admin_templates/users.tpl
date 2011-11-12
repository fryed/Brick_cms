<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#users">Users</a></li>
		{if $site.user_type != "user"}
		<li><a href="#add">Add user</a></li>
		{/if}
	</ul>
	
	<div id="users">
		
		<h3>User list</h3>
		<hr/>
		
		{foreach from=$site.users item=user}
		
		<div class="row">
	
			<form method="post" action="">
	
			{if $site.user_type == "developer"}
			
				<h4>User: {$user.username}</h4>
				<p><span class="bold">Email:</span> {$user.email}</p>
				<p><span class="bold">User type:</span> {$user.type}</p>

			{elseif $site.user_type == "master" && $user.type != "developer"}
			
				<h4>{$user.username}</h4>
				<p><span class="bold">Email:</span> {$user.email}</p>
				<p><span class="bold">User type:</span> {$user.type}</p>
			
			{elseif $site.user_type == "user" && $user.username == $user}
			
				<h4>{$user.username}</h4>
				<p><span class="bold">Email:</span> {$user.email}</p>
				<p><span class="bold">User type:</span> {$user.type}</p>
			
			{/if}
			
				<fieldset class="slider">
					
					<br class="clearBoth"/>
					
					<h4>Edit {$user.username}</h4>
					<hr/>
					
					<label>Username:</label>
					<input type="text" name="username" value="{$user.username}" required="required" placeholder="username"/>
					<br class="clearBoth"/>
					
					<label>Email:</label>
					<input type="email" name="email" value="{$user.email}" required="required" placeholder="email"/>
					<br class="clearBoth"/>
					
					<label>Password:</label>
					<input type="password" name="password" value="----------" required="required"/>
					<br class="clearBoth"/>
					
					<label>Repeat password:</label>
					<input type="password" name="password2" value="----------" required="required"/>
					<br class="clearBoth"/>
					
					{if $site.user_type != "user"}
					<label>User type:</label>
					<select name="type">
						{if $site.user_type == "developer"}<option {if $user.type == "developer"}selected="selected"{/if} value="developer">developer</option>{/if}
						<option {if $user.type == "master"}selected="selected"{/if} value="master">master</option>
						<option {if $user.type == "user"}selected="selected"{/if} value="user">user</option>
					</select>
					<br class="clearBoth"/>
					{/if}	
					
					<input type="hidden" name="table" value="users"/>
					<input type="hidden" name="id" value="{$user.id}"/>
					
					<input type="submit" name="action" value="edit user"/>
					{if $site.user_type != "user"}<input type="submit" name="action" class="delete" value="delete"/>{/if}
					
				</fieldset>
				
			</form>	
		
		</div>	
		<hr/>
		
	{foreachelse}
		<p>No users found.</p>
	{/foreach}
		
	</div>
	
	<br class="clearBoth"/>
	
	{if $site.user_type != "user"}
	<div id="add">
	
		<form method="post" action="">

			<fieldset>
				
				<label>Username:</label>
				<input type="text" name="username" value="" required="required" placeholder="username"/>
				<br class="clearBoth"/>
				
				<label>Email:</label>
				<input type="email" name="email" value="" required="required" placeholder="email"/>
				<br class="clearBoth"/>
				
				<label>Password:</label>
				<input type="text" name="password" value="" required="required" placeholder="password"/>
				<br class="clearBoth"/>
				
				<label>Repeat password:</label>
				<input type="text" name="password2" value="" required="required" placeholder="repeat password"/>
				<br class="clearBoth"/>
				
				<label>User type:</label>
				<select name="type">
					{if $site.user_type == "developer"}<option value="developer">developer</option>{/if}
					<option value="master">master</option>
					<option value="user">user</option>
				</select>
				<br class="clearBoth"/>	
				
				<input type="hidden" name="table" value="users"/>
				
				<input type="submit" name="action" value="add user"/>
				
			</fieldset>
			
		</form>
		
	</div>
	{/if}
	
</section>
