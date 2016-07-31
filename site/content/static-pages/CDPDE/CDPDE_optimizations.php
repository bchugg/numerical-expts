<!DOCTYPE html>
<html lang="en">
<head>
	<title> CDPDE | Optimizations </title>
	<?php include('../../includes/globalheader.php'); ?>
	
<?php include('../../includes/CDPDE.php'); ?>

<div class="container">
	<h2>Optimizations</h2>
	<p>Note that our update matrix $A$ is incredibly sparse. In fact, if we input any initial conditions our matrix resembles: </p>
	<img id="sparseA" src="../../../data/CDPDE/sparsityofA" alt="SparseA">

	<pre><output>A has 31525 non-zero elements. 
The fraction of non-zero elements is: 7.323438e-04</output></pre> 

</div>

<?php include('../../includes/globalfooter.php'); ?>
</html>