<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="{$HOME}/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$ADMIN_PATH}/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>

<script type="text/javascript" src="{$HOME}/system/lib/js/jquery.js"></script>
<script type="text/javascript" src="{$ADMIN_PATH}/js/admin.js"></script>

<title>Brick :: Login</title>

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
			<li>Login</li>
		</ul>
	</nav>	 
	
	<section class="messages">
		{include file="messages.tpl"}
	</section>
	
	<section class="mainContent">
		
		<div class="centerPod pod">
			
			<div class="pad20">
			
				<h2>Login</h2>
				<hr/>
			
				<form method="post" action="">
					
					<fieldset>
						
						<label for="username">Username:</label>
						<input type="text" id="username" name="username"/>
						<br class="clearBoth"/>
						
						<label for="password">Password:</label>
						<input type="password" id="password" name="password"/>
						<br class="clearBoth"/>
						
						<input type="submit" name="action" value="LogIn"/>
						
					</fieldset>
					
				</form>
			
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
