<ul class="subNav">
{foreach from=$subNav item=row}
	<li class="{if $row.active == true} active {/if} {if $row.external == true} external {/if}">
		<a href="{$HOME}{$row.url}">{$row.name}</a>
		{if $row.subNav}
			{assign var=subNav value=$row.subNav}
			{include file="system/sub-nav.tpl"}
		{/if}
	</li>
{/foreach}
</ul>