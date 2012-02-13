{include file="system/messages.tpl"}

<div class="searchForm">
	<form method="post" acion="">
		<input type="text" name="search" value="" required="required" placeholder="search"/>
		<select name="filter" required="required">
			<option value="pages">pages</option>
			<option value="news">news</option>
			<option value="blog">blog</option>
		</select>	
	<input type="submit" name="action" value="search"/>
	</form>
</div>

<div class="itemList">
	
	{foreach from=$page.search_results item=result}
	<div class="item">
		<h5>{$result.title}</h5>
		<p>{$result.content|truncate:200}...</p>
		<a href="{$result.uri}">Read more...</a>
	</div>
	{foreachelse}
	<div class="item">
		<p>No results found.</p>
	</div>
	{/foreach}
	
</div>



