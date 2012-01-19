<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="{$HOME}/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$ADMIN_PATH}/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="http://fonts.googleapis.com/css?family=Lato:400,300,900" rel="stylesheet" type="text/css"/>
<link href="{$ADMIN_PATH}/images/favicon.png" rel="icon">

<!--[if lt IE 9]>
<script src="{$ADMIN_PATH}/js/ieHtml5.js"></script>
<![endif]-->

<title>Brick :: 404</title>

<link rel="icon" href="{$site.favicon.src}" type="image/x-icon">

</head>

<body class="nojs" id="misc">
	
<div class="container">	
	
	<header>
		<div class="pad20">
			<h1 class="logo">Brick::cms</h1>
		</div>
	</header>
	
	<nav class="cmsNav">
		<ul>
			<li class="active">404</li>
		</ul>
	</nav>	 
	
	<section class="mainContent">
		
		<div class="centerPod pod">
			
			<div class="pad20">
			
				<h2>404 :: Page not found</h2>
				<hr/>
			
				<p>Sorry, the page you are looking for cannot be found.</p>
				<p><a href="{$HOME}">Go back to the home page</a></p>
			
			</div>
		
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
