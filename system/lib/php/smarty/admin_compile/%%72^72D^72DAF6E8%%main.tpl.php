<?php /* Smarty version 2.6.20, created on 2011-11-05 16:14:51
         compiled from main.tpl */ ?>
<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
<meta charset="utf-8" />

<link href="<?php echo $this->_tpl_vars['HOME']; ?>
/system/lib/css/reset.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $this->_tpl_vars['ADMIN_PATH']; ?>
/css/admin.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $this->_tpl_vars['ADMIN_PATH']; ?>
/css/jHtmlArea.css" rel="stylesheet" type="text/css" media="screen"/>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['HOME']; ?>
/system/lib/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ADMIN_PATH']; ?>
/js/jHtmlArea.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ADMIN_PATH']; ?>
/js/popup.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ADMIN_PATH']; ?>
/js/admin.js"></script>

<title>Brick :: <?php echo $this->_tpl_vars['page']['title']; ?>
</title>

<link rel="icon" href="<?php echo $this->_tpl_vars['site']['favicon']['src']; ?>
" type="image/x-icon">

</head>

<body class="nojs">
	
<div class="container">
	
	<section class="topBar">
		
		<div class="clearCache">
				
			<form method="post" action="">
				<fieldset>
					<input type="submit" name="action" value="clear cache">
				</fieldset>
			</form>
			
		</div>
		
		<div class="innerTopRight">

			<div class="inbox">
				<p>
					<a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/inbox">inbox:</a>
					<a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/inbox" class="messageNo"><?php echo $this->_tpl_vars['site']['messages']; ?>
</a>
				</p>
			</div>
			
			<div class="logDetails">
				<p>Logged in as <?php echo $this->_tpl_vars['site']['user']; ?>
. <a href="<?php echo $this->_tpl_vars['ADMIN_HOME']; ?>
/logout">Logout</a></p>
			</div>
			
		</div>
		
	</section>
	
	<header>
		
		<div class="pad20">
			<h1 class="logo">Brick::cms</h1>
		</div>
		
	</header>
	
	<nav class="cmsNav">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cms-nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</nav>
	
	<section class="messages">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</section>
	
	<section class="mainContent">
		
		<div class="pad20">
			
			<section class="leftCol col">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidebar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</section>
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['page']['template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<br class="clearBoth"/>
			
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