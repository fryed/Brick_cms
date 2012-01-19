<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="{$HOME}/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$ADMIN_PATH}/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$ADMIN_PATH}/css/jHtmlArea.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="http://fonts.googleapis.com/css?family=Lato:400,300,900" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="{$HOME}/system/lib/js/jquery.js"></script>
<script type="text/javascript" src="{$ADMIN_PATH}/js/jHtmlArea.js"></script>
<script type="text/javascript" src="{$ADMIN_PATH}/js/popup.js"></script>
<script type="text/javascript" src="{$ADMIN_PATH}/js/editNav.js"></script>
<script type="text/javascript" src="{$ADMIN_PATH}/js/admin.js"></script>

<!--[if lt IE 9]>
<script src="{$ADMIN_PATH}/js/ieHtml5.js"></script>
<![endif]-->

<title>Brick :: {$page.title}</title>

<link rel="icon" href="{$site.favicon.src}" type="image/x-icon">

</head>

<body class="nojs" data-area="{$page.active}">
	
<div class="container">
	
	<section class="topBar">
		
		<div class="clearCache">
				
			<form method="post" action="">
				<fieldset>
					<input type="submit" name="action" value="clear cache" title="clear cache">
				</fieldset>
			</form>
			
		</div>
		
		<div class="innerTopRight">

			<div class="inbox">
				<p>
					<a href="{$ADMIN_HOME}/inbox">inbox:</a>
					<a href="{$ADMIN_HOME}/inbox" class="messageNo">{$site.messages}</a>
				</p>
			</div>
			
			<div class="logDetails">
				<p>Logged in as {$site.user}. <a href="{$ADMIN_HOME}/logout">Logout</a></p>
			</div>
			
		</div>
		
	</section>
	
	<header>
		
		<div class="pad20">
			<h1 class="logo">Brick::cms</h1>
		</div>
		
	</header>
	
	<nav class="cmsNav">
		{include file="cms-nav.tpl"}
	</nav>
	
	<section class="messages">
		{include file="messages.tpl"}
	</section>
	
	<section class="mainContent">
		
		<div class="pad20">
			
			<section class="leftCol col">
				{include file="sidebar.tpl"}
			</section>
			
			{include file=$page.template}

			<br class="clearBoth"/>
			
		</div>
		
	</section>
	
	<footer>
		
		<div class="pad20">
			<p>&copy; fryed designs {$smarty.now|date_format:"%Y"}</p>
		</div>
		
	</footer>
	
</div>

</body>

</html>