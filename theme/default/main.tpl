<!DOCTYPE html>
<html lang="en">
	
<head>
	
<meta charset="utf-8" />

<base href="{$HOME}/"/>

<meta name="description" content="{if $page.description}{$page.description}{else}{$site.description}{/if}"/>
<meta name="keywords" content="{if $page.keywords}{$page.keywords}{else}{$site.keywords}{/if}"/>	

<link href="system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$THEME}/css/common.css" rel="stylesheet" type="text/css" media="screen"/>
<link href='http://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
<link href="{$site.favicon.src}" rel="icon">

<script type="text/javascript" src="system/lib/js/jquery.js"></script>
<script type="text/javascript" src="{$THEME}/js/common.js"></script>

<title>{$page.title}</title>

</head>

<body>
	
<div class="headerNav">
	{assign var=navType value=$menu.header}
	{include file="system/nav.tpl"}		
</div>
	
<div class="container">
	
	<div class="header">
		
		<div class="pad20">
		
			<a href="{$HOME}">
				<img src="{$site.logo.src}" alt="{$site.logo.description}"/>
			</a>
		
		</div>
		
	</div>
	
	<div class="nav">
		{assign var=navType value=$menu.main}
		{include file="system/nav.tpl"}	
		<ul class="mainNav floatRight">
			<li><a href="news">News</a></li>
			<li><a href="blog">Blog</a></li>
			<li><a href="search">Search</a></li>
		</ul>
	</div>
	
	<div class="bread">
		{include file="system/breadcrumbs.tpl"}
	</div>
	
	<div class="content">
		
		<div class="pad20">
			
			<div class="mainCol">
				
				<h1>{$page.title}</h1>
			
				{include file=$page.template}
				
				<div class="gallery">
					<h4>Gallery:</h4>
					{foreach from=$page.images item=image}
					<div class="imgHolder">
						<a href="{$HOME}/{$image.src}">
							<img src="{$HOME}/{$image.src}" alt="{$image.description}"/>
						</a>
					</div>
					{foreachelse}
						<p>No images found.</p>
					{/foreach}
				</div>
					
			</div>
			
			<div class="rightCol">
				
				{if $page.section == "/blog"}
				<div class="pod">
					<div class="pad10">
						
						<h3>Categories</h3>
						{foreach from=$blog.menu item=category}
						
							<h5>{$category.name}</h5>
							{foreach from=$category.pages item=article}
								<ul>
									<li><a href="{$HOME}{$article.url}">{$article.name}</a></li>
								</ul>
							{foreachelse}
								<p>No articles found.</p>
							{/foreach}
							
						{foreachelse}
							<p>No categories found.</p>
						{/foreach}
						
					</div>
				</div>
				{/if}
				
				{if $page.section == "/news"}
				<div class="pod">
					<div class="pad10">
						
						<h3>Categories</h3>
						{foreach from=$news.menu item=category}
						
							<h5>{$category.name}</h5>
							{foreach from=$category.pages item=article}
								<ul>
									<li><a href="{$HOME}{$article.url}">{$article.name}</a></li>
								</ul>
							{foreachelse}
								<p>No articles found.</p>
							{/foreach}
							
						{foreachelse}
							<p>No categories found.</p>
						{/foreach}
						
					</div>
				</div>
				{/if}
				
				<div class="pod">
					<div class="pad10">
						
						<h3>Hero image:</h3>
						{if $page.main_image}
						<div class="imgHolder">
							<img src="{$HOME}/{$page.main_image.src}" alt="{$page.main_image.description}"/>
						</div>
						{else}
						<p>No main image set.</p>
						{/if}
						
					</div>
				</div>
				
				<div class="pod">
					<div class="pad10">
						
						<h3>Page details:</h3>
						<ul>
							<li><strong>Name : </strong>{$page.name}</li>
							<li><strong>Id : </strong>{$page.id}</li>
							<li><strong>Uri : </strong>{$page.uri}</li>
							<li><strong>Created : </strong>{$page.created}</li>
						</ul>
						
					</div>
				</div>
				
				<div class="pod">
					<div class="pad10">
						
						<h3>Downloads:</h3>
						<ul>
						{foreach from=$page.downloads item=download}
							<li><a href="{$HOME}/{$download.src}" title="{$download.description}">{$download.name}</a></li>
						{foreachelse}
							<li>No downloads found.</li>
						{/foreach}
						</ul>
						
					</div>
				</div>
				
			</div>
			
			<br class="clearBoth"/>
		
		</div>
	
	</div>
	
	<div class="hr"></div>
	
	<div class="footer">
		
		<div class="pad20">
		
			<p>&copy; fryed designs</p>
			
			<div class="footerNav">
				{assign var=navType value=$menu.footer}
				{include file="system/nav.tpl"}	
			</div>
			
			<br class="clearBoth"/>
		
		</div>
		
	</div>
	
</div>

</body>

</html>
