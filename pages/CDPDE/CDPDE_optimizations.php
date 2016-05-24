<!DOCTYPE html>
<html>
<head>
	<title> CDPDE | Optimizations </title>
	<link rel="stylesheet" type="text/css" href="../../views/CDPDE.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

<?php include('../includes/CDPDE.php'); ?>

<h2>Optimizations</h2>
<p>Note that our update matrix $A$ is incredibly sparse. In fact, if we input any initial conditions our matrix resembles: </p>
<img id="sparseA" src="../../data/CDPDE/sparsityofA" alt="SparseA">

<?php include('../includes/footer.php'); ?>
</html>