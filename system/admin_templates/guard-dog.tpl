<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="{$HOME}/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$ADMIN_PATH}/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>

<!--[if lt IE 9]>
<script src="{$ADMIN_PATH}/js/ieHtml5.js"></script>
<![endif]-->

<title>Brick :: Guard dog</title>

<link rel="icon" href="{$site.favicon.src}" type="image/x-icon">

</head>

<body class="nojs guardDog" id="misc">
	
<div class="container">	
	
	<header>
		<div class="pad20">
			<h1 class="logo">Brick::cms</h1>
		</div>
	</header>
	
	<nav class="cmsNav">
		<ul>
			<li>Guard dog</li>
		</ul>
	</nav>	 
	
	<section class="mainContent">
		
		<div class="centerPod pod">
			
			<div class="pad20">
			
				<h2>Guard dog</h2>
				<hr/>
			
				<p class="bold">Too many incorrect login attempts.</p>
				{if $settings.dev_email}
				<p>If you are the owner of the site and have forgotten your login details please
				email <a href="mailto:{$settings.dev_email}">{$settings.dev_email}</a>.</p>
				{/if}
			
			</div>
		
		</div>
		
	</section>
	
	<footer>
		<div class="pad20">
			<p>&copy; fryed designs 2011</p>
		</div>
	</footer>	
	
</div>	

</body>

</html>
