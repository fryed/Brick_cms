{include file="system/messages.tpl"}

<form method="post" action="">
	
	<fieldset>
		
		<label>subject:</label>
		<input type="text" name="subject" value=""/>
		<br/>
		
		<label>name:</label>
		<input type="text" name="name" value=""/>
		<br/>
		
		<label>address:</label>
		<input type="text" name="address" value=""/>
		<br/>
		
		<label>email:</label>
		<input type="text" name="email" value=""/>
		<br/>
		
		<label>tel:</label>
		<input type="text" name="tel" value=""/>
		<br/>
		
		<label>content</label><br/>
		<textarea rows="5" cols="100" name="content"></textarea>
		
		<input type="hidden" name="table" value="messages"/>
		
		<br/>
		<input type="submit" name="action" value="send message"/>
		
	</fieldset>
	
</form>