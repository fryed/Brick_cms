{include file="system/messages.tpl"}

{$page.content}

<h3>comments</h3>

{foreach from=$page.comments item=comment}
	
	<p>by:{$comment.name}</p>
	<p>on:{$comment.created}</p>
	<p>Comment:{$comment.comment}</p>	
	<hr/>
	
{foreachelse}	
	
	no comments found
	
{/foreach}

<form method="post" action="">
	
	<fieldset>
		
		<legend>Add comment</legend>
		
		<label>Name:</label>
		<input type="text" name="name" value=""/>
		<br/>
		<textarea name="comment" rows="10" cols="100"></textarea>
		
		<input type="hidden" name="belongs_to" value="{$page.id}"/>
		<input type="hidden" name="table" value="blog_comments"/>
		<br/>
		<input type="submit" name="action" value="add comment"/>	
		
	</fieldset>
	
</form>

<br/>