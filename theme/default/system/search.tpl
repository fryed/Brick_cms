<h2>search</h2>

{include file="system/messages.tpl"}

<form method="post" action="">
	
	<fieldset>
		
		<label>Search:</label>
		<input type="text" name="search" value=""/>
		
		<label>filter:</label>
		<select name="filter">
			<option value="pages">pages</option>
			<option value="news">news</option>
			<option value="blog">blog</option>
		</select>	
		
		<input type="submit" name="action" value="search"/>
		
	</fieldset>
	
</form>

{foreach from=$page.search_results item=result}
	<h3>{$result.title}</h3>
	<br/>
	{$result.name}
	<br/>
	{$result.content}
	<br/>
	<br/>
{foreachelse}
	no results found
{/foreach}