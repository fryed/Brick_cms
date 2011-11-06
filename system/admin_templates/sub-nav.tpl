<ul class="subNav">
	
{foreach from=$subNav item=row}

	<li class="{if $row.active == true} active {/if} {if $row.external == true} external {/if} {if $row.enabled == false} disabled {/if} {if $row.subNav} hasChildren {/if}">
		
		<a href="{if $row.external != true}{$ADMIN_HOME}{/if}{$row.url}">{$row.name}</a>
		
		<div class="inputHolder">
		
			<input type="text" name="menu_order-{$row.id}" value="{$row.menu_order}"/>
			
			{if $row.uri != "/"}

			<select name="parent-{$row.id}">
				<option value=">-1">top level</option>
				{foreach from=$site.pages item=section}
					{if $section.url != "/" && $section.url != $row.url}
					<option value="{$section.url}>{$section.id}" {if  $row.section == $section.url}selected="selected"{/if}>{$section.url}</option>
					{/if}
				{/foreach}
			</select>
			
			<input type="checkbox" name="item{$row.id}"/>
			
		{/if}
		
		</div>
		
		{if $row.subNav}
			{assign var=subNav value=$row.subNav}
			{include file="sub-nav.tpl"}
		{/if}
		
	</li>
	
{/foreach}

</ul>