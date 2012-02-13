{$page.content}

<div class="itemList">
	
	<h4>News articles:</h4>

	{foreach from=$news.pages item=article}
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