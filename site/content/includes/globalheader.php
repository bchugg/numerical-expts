<!-- Global Header to be inherited by every page on the site -->
<!-- Continues and closes <head> tag, opens <body> tag -->

<!DOCTYPE html>
	<?php include('bootstrap.php'); ?>
	<?php include('mathjax.php'); ?>
	<link rel="stylesheet" type="text/css" href="../../views/stylesheets/headerfooter.css">
</head>
<body style="padding-top:70px">
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/~benchugg/num_expts/">Numerics</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Projects
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/~benchugg/num_expts/site/content/static-pages/CDPDE/CDPDE_intro.php">Convection Diffusion PDE</a></li>
				</ul>
			</li> 
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="/~benchugg/num_expts/site/content/static-pages/about.php">About</a></li>
			<li><a href="/">My Index</a></li>
		</ul>
	</div>
</nav>
