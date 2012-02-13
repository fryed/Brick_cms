{include file="system/messages.tpl"}

{$page.content}

<div class="itemList">
	
	<h4>Comments:</h4>
	
	{foreach from=$page.comments item=comment}
	<div class="item">
		<h5>{$comment.name} - <span class="date">{$comment.created}</span></h5>
		<p>Comment:{$comment.comment}</p>	
	</div>
	{foreachelse}	
	<div class="item">
		<p>No comments found.</p>
	</div>
	{/foreach}

</div>

<form method="post" action="">
	
	<h4>Add comment:</h4>
	<input type="text" name="name" value="" required="required" placeholder="name"/>
	<textarea name="comment" required="required" placeholder="comment"></textarea>
	
	<input type="hidden" name="belongs_to" value="{$page.id}"/>
	<input type="hidden" name="table" value="blog_comments"/>
	<input type="submit" name="action" value="add comment"/>	
		
</form>

<br/>