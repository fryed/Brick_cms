<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#inbox">Inbox</a></li>
	</ul>
	
	<div id="inbox">
		
		<h3>Messages</h3>
		<hr/>
		
		<form method="post" action="">

			<fieldset>
			
				<table cellpadding="0" cellspacing="0" border="0">
					
					<thead>
						<th>From:</th>	
						<th>Status:</th>	
						<th>Subject:</th>	
						<th>Read:</th>	
						<th class="check"></th>	
					</thead>
						
					{foreach from=$page.messages item=message}
					
					<tr class="{$message.status}">
						<td>{$message.name}</td>
						<td>{$message.status}</td>
						<td>{$message.subject}</td>
						<td><a href="{$ADMIN_HOME}/inbox/{$message.id}">View message</a></td>
						<td><input type="checkbox" name="item{$message.id}"/></td>
					</tr>
				
					{foreachelse}
					<tr>
						<td><p>Inbox empty.</p></td>
					</tr>
					{/foreach}
				
				</table>
				
				<br class="clearBoth"/>
				
				<input type="hidden" name="table" value="messages"/>
				<input type="submit" name="action" value="delete selected"/>
		
			</fieldset>
		
		</form>
		
	</div>
	
</section>
