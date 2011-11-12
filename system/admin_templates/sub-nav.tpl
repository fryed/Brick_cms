<ul class="subNav">
	
{foreach from=$subNav item=row}

	<li class="{if $row.active == true} active {/if} {if $row.external == true} external {/if} {if $row.enabled == false} disabled {/if} {if $row.subNav} hasChildren {/if}">
		
		<a href="{if $row.external != true}{$ADMIN_HOME}{/if}{$row.url}">{$row.name}</a>
		
		<div class="inputHolder" data-id="{$row.page_id}" data-url="{$row.url}">
			
			<input type="hidden" name="menu_order-{$row.id}" class="order" value="{$row.menu_order}"/>
			<input type="hidden" name="parent-{$row.id}" class="parent" value=""/>
			<input type="checkbox" class="delete" name="item{$row.id}"/>
			
		</div>
		
		{if $row.subNav}
			{assign var=subNav value=$row.subNav}
			{include file="sub-nav.tpl"}
		{/if}
		
	</li>
	
{/foreach}

</ul>