{$page.content}

<div class="itemList">
	
	<h4>Blog posts:</h4>

	{foreach from=$blog.pages item=article}
	<div class="item">
		<h5>{$article.name}</h5>
		{$article.content}
		<a href="{$HOME}{$article.url}">Read article...</a>
	</div>
	{foreachelse}
	<div class="item">
		<p>No articles found.</p>
	</div>
	{/foreach}
	
	{include file="system/paging.tpl"}

</div>