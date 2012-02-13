<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="{$HOME}/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$HOME}/system/admin_templates/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{$HOME}/system/admin_templates/css/jHtmlArea.css" rel="stylesheet" type="text/css" media="screen"/>

<script type="text/javascript" src="{$HOME}/system/lib/js/jquery.js"></script>
<script type="text/javascript" src="{$HOME}/system/admin_templates/js/jHtmlArea.js"></script>
<script type="text/javascript" src="{$HOME}/system/admin_templates/js/popup.js"></script>
<script type="text/javascript" src="{$HOME}/system/admin_templates/js/admin.js"></script>

<!--[if lt IE 9]>
<script src="{$ADMIN_PATH}/js/ieHtml5.js"></script>
<![endif]-->

<title>Brick :: Setup</title>

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
			<li class="active">Setup</li>
		</ul>
	</nav>	 

	<section class="messages">
		{if $setup.errors}
		<div class="errorBox">
			<p>
				{foreach from=$setup.errors item=error}
					{$error}<br/>
				{/foreach}
			</p>
		</div>
		{/if}
	</section>
	
	<section class="mainContent">

		<div class="centerPod pod">
			
			<div class="pad20">
		
				<!--STAGE 1 SETUP-->
				{if $setup.step == 1}
				
				<h2>Setup - step 1</h2>
				<hr/>
				
				<form method="post" action="">
					
					<fieldset>
						
						<h4>Enter user details</h4>
						
						<p>Go to phpMyAdmin or equivelent and create a user, then enter the details below</p>
						
						<label>DB User:</label>
						<input type="text" name="DB_user" value="" required="required" placeholder="userame"/>
						<br class="clearBoth"/>
						
						<label>DB password:</label>
						<input type="password" name="DB_pass" value="" required="required" placeholder="password"/>
						<br class="clearBoth"/>
						
						<input type="submit" name="DB_adduser" value="add user"/>
						
					</fieldset>
					
				</form>
				
				{/if}
				
				<!--STAGE 2 SETUP-->
				{if $setup.step == 2}
				
				<h2>Setup - step 2</h2>
				<hr/>
				
				<form method="post" action="">
					
					<fieldset>
						
						<h4>Create database</h4>
						
						<label>DB name:</label>
						<input type="text" name="DB_name" value="" required="required" placeholder="database name"/>
						<br class="clearBoth"/>
						
						<input type="submit" name="DB_create" value="create database"/>
						
					</fieldset>
					
				</form>
				
				{/if}
			
			</div>
		
		</div>
					
		<br class="clearBoth"/>

	</section>
	
	<footer>
		
		<div class="pad20">
			<p>&copy; fryed designs 2011</p>
		</div>
		
	</footer>
	
</div>

</body>

</html>