{include file="system/messages.tpl"}

<div class="contactForm">
	
	<h4>Contact us:</h4>
	
	<form method="post" action="">
	
		<input type="text" name="subject" value="" required="required" placeholder="subject"/>
		
		<input type="text" name="name" value="" required="required" placeholder="name"/>
		
		<input type="text" name="address" value="" required="required" placeholder="address"/>
		
		<input type="email" name="email" value="" required="required" placeholder="email"/>
		
		<input type="number" name="tel" value="" required="required" placeholder="phone"/>
		
		<textarea name="content" required="required" placeholder="message"></textarea>
		
		<input type="hidden" name="table" value="messages"/>
		
		<input type="submit" name="action" value="send message"/>
	
	</form>
	
</div>