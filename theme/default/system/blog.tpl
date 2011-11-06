<h2>Blog List</h2>

{$page.content}

<br/>

<h2>Blog List</h2>

{foreach from=$blog.menu item=category}

	<h3>{$category.name}</h3>
	
	{foreach from=$category.pages item=article}
		
		{if $article.main_image}
		<img src="{$HOME}{$article.main_image.src}" width="{$article.main_image.width}" height="{$article.main_image.height}" alt="{$article.main_image.description}"/>
		{else}
		no main image set
		{/if}
		<br/>
		{$article.name}
		<br/>
		<a href="{$HOME}{$article.url}">Read article...</a>
		<br/>
		<hr/>
		
	{foreachelse}
		No articles found
	{/foreach}
	
{foreachelse}
	No categories found
{/foreach}

<div style="background:#ccc; padding:10px;">
	
<h3>Blog pages</h3>

{foreach from=$blog.pages item=article}
	{if $article.main_image}
	<img src="{$HOME}{$article.main_image.src}" width="{$article.main_image.width}" height="{$article.main_image.height}" alt="{$article.main_image.description}"/>
	{else}
	no main image set
	{/if}
	<br/>
	{$article.name}
	<br/>
	<a href="{$HOME}{$article.url}">Read article...</a>
	<br/>
	<hr/>
{foreachelse}
	no articles found
{/foreach}

{include file="system/paging.tpl"}

</div>