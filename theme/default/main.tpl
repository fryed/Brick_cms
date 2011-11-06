<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link href="{$HOME}/admin/lib/css/reset1.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$HOME}/templates/styles/common.css" rel="stylesheet" type="text/css" media="screen"/>

<script type="text/javascript" src="{$HOME}/admin/lib/js/jquery.js"></script>
<script type="text/javascript" src="{$HOME}/templates/scripts/common.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="{if $page.description}{$page.description}{else}{$site.description}{/if}" />
<meta name="keywords" content="{if $page.keywords}{$page.keywords}{else}{$site.keywords}{/if}" />	

<title>{$page.title}</title>

<link rel="icon" href="{$HOME}/templates/images/favicon.ico" type="image/x-icon">

</head>

<body>

<div class="headerNav">
	<h3>header nav</h3>
	{assign var=navType value=$menu.header}
	{include file="system/nav.tpl"}		
</div>

<div class="mainNav">
	<h3>main nav</h3>
	{assign var=navType value=$menu.main}
	{include file="system/nav.tpl"}	
</div>

<h1>{$page.title}</h1>

<h3>Bread crumbs</h3>
{include file="system/breadcrumbs.tpl"}

<h3>page image</h3>
{if $page.main_image}
<img src="{$HOME}{$page.main_image.src}" width="{$page.main_image.width}" height="{$page.main_image.height}" alt="{$page.main_image.description}"/>
{else}
no main image set
{/if}

<p>Created: {$page.created}</p>
<p>id: {$page.id}</p>
<p>name: {$page.name}</p>
<p>url: {$page.uri}</p>

{include file=$page.template}

<h3>images</h3>
{foreach from=$page.images item=image}
	<img src="{$HOME}{$image.src}" width="{$image.width}" height="{$image.height}" alt="{$image.description}"/>
{foreachelse}
	no images found
{/foreach}

<h3>downloads</h3>
{foreach from=$page.downloads item=download}
	<a href="{$HOME}{$download.src}" title="{$download.description}">{$download.name}</a>
	<br/>
{foreachelse}
	no downloads found
{/foreach}

<div class="footerNav">
	<h3>footer nav</h3>
	{assign var=navType value=$menu.footer}
	{include file="system/nav.tpl"}	
</div>

</body>

</html>
