<p>
{foreach from=$page.breadcrumbs item=row name=crumbs}
	<a href="{$row.url}">{$row.name}</a>{if !$smarty.foreach.crumbs.last} &raquo;{/if}
{/foreach}
</p>