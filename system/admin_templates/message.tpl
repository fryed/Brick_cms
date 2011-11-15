<section class="mainCol col">

	<h1>{$page.title}</h1>
	<hr/>
	
	<ul id="tabs">
		<li><a href="#message">Message</a></li>
	</ul>
	
	<div id="message">
		
		<h3>{$page.message.subject}</h3>
		<hr/>
		
		<div class="messageLeft">
			<p><span class="bold">From:</span> {$page.message.name}</p>
			<p><span class="bold">Email:</span> <a href="mailto:{$page.message.email}">{$page.message.email}</a></p>
			<p><span class="bold">Sent:</span> {$page.message.sent|date_format}</p>
			<p><span class="bold">Status:</span> {$page.message.status}</p>
		</div>
		
		<div class="messageRight">
			<p><span class="bold">Message:</span><br/> {$page.message.content}</p>
		</div>
	
		<hr/>
		<a class="button" href="{$HOME}/admin/inbox">back to inbox</a>
		
		<br class="clearBoth"/>
		
	</div>
	
</section>

