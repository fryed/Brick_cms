<ul class="subNav">
{foreach from=$subNav item=row}
	<li class="{if $row.active == true} active {/if} {if $row.external == true} external {/if}">
		{if $row.external}
		<a href="{$row.url}">{$row.name}</a>
		{else}
		<a href="{$HOME}{$row.url}">{$row.name}</a>
		{/if}
		{if $row.subNav}
			{assign var=subNav value=$row.subNav}
			{include file="system/sub-nav.tpl"}
		{/if}
	</li>
{/foreach}
</ul>