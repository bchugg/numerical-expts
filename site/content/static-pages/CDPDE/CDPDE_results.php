<!DOCTYPE html>
<html lang="en">
<head>
	<title> Results | CDPDE </title>
	<?php include('../../includes/globalheader.php'); ?>

<?php include('../../includes/CDPDE.php'); ?>

<div class="container">
	<h2>Results</h2>
	
	<p> We use the technical computing platform <a href="http://www.mathworks.com/products/matlab/">$\textit{Matlab}$</a> to implement our mathematical formulation of the problem. </p>
	<p>We will carry out the computation for the wind parameters $W=1$, $\theta=\pi/2$ and initial pollution parameters $a_1=2,a_2=1,s_1=100,s_2=150$. We will also fix $D\equiv 0.65$.</p>

	<hr> 

	<p> First we demonstrate the results of optimizing the matrix calculations by taking advantage of the sparsity of our matrix $A$. Originally, we compute the solution with the time step of $\Delta t=0.025$. Not having optimized anything, we get the output:
	<pre><output>Original time taken to solve system: 1.862284e+02</output></pre>
	After converting $A$ into a sparse matrix and solving the system we get:
	<pre><output>Time taken to solve system using sparse matrix: 4.631899e-01
Using a spare matrix calculation our speedup factor is: 9.975128e-01</output></pre>
	<p>That is, percent wise, after optimizing we have a speedup factor of approximately 99%. With such a fast speedup, we can lower $\Delta t$ to get more accurate solutions. Below, we've plotted the contour plots for the solutions with $\Delta t=0.025$ and $\Delta t=0.005$. </p>

	<div class="col-sm-6 center">
		<figure>
			<img id="contour2" src="../../../data/CDPDE/contour1" alt="Contour" width="600px" 	height="500px">
			<figcaption><small><strong>Figure 1: </strong>Contour plot of solution at various times using $\Delta t=0.025$</small></figcaption>	
		</figure>
	</div>
	<div class="col-sm-6 center">
		<figure>
			<img id="contour2" src="../../../data/CDPDE/contour2" alt="Contour" width="600px" height="500px">	
			<figcaption><small><strong>Figure 2: </strong>Contour plot of solution at various times using $\Delta t=0.005$</small></figcaption>	
		</figure>
	</div>
	
	<p>Interestingly, however, based on the figures above a smaller time step does not seemed to have changed the solution in any drastic way.</p>
	
	<hr> 

	<p>Now, our convection diffusion equation is presumably modelling some sort of substance/fluid. Suppose that we want to measure the amount of this fluid at some point on the grid throughout the day. 
	<div class="col-sm-4">
 		<figure>
	 		<img id="pollevel" src="../../../data/CDPDE/polLevelxk" alt="PollutionLevel" width="350" height="350" align="middle">
			<figcaption><small><strong>Figure 3: </strong>Amount of flud at location $\vec{x}_I$ over time.</small></figcaption>	
	 	</figure>
 	</div>
	For simplicity, let us do the measurement at the point $\bx_P=(x,y)=(0.5,0.5)$, and let $(t_0,t_f)=(0,0.25)$ denote the beginning and end of the time period in which we're interested. Define, \[\rho(t)\equiv u(\bx_P,t)\] to be the amount of fluid at this point as a function of time, and let \[\Psi\equiv\int_{t_0}^{t_f}\rho(t)dt\] be the total amount of fluid at $\bx_P$ over the entire time period. </p>
	<p>We have the values for $u(/bx_P,t)$ over time from our solution. Therefore, we can numerically evaluate the value of $\Psi$. We use a <a href="https://en.wikipedia.org/wiki/Trapezoidal_rule">Composite Trapezoidal Rule</a> to do this. Plotting the amount of pollution at position $\bx_P=(0.5,0.5)$ versus time yields Figure 3. 
 	Using a composite trapezoidal rule to calculate $\Psi$ yields
	<pre><output>Psi = 3.181789e-02</output></pre></p>

	<br /> <br />
	<h3>What if we don't know the parameters?</h3>
	<p>Practically speaking, it would be very uncommon for us to know the initial flow strengths of the fluid and the speed and direction of the wind (let us take a moment to thank <a href="https://en.wikipedia.org/wiki/Chaos_theory">Chaos theory</a> for that last one). As such we will estimate these values based on certain probability distributions: 
	</p>
	<ul>
		<li>
			<strong>Initial flow strengths, </strong>$a_1,a_2$. We assume that the fluid follows the exponential distribution, \[p_{\{a_1,a_2\}}(x)=\frac{1}{\lambda}e^{-x/\lambda}\] where $\lambda$ is the mean of the distribution. We have one distribution for each initial location of the fluid. We will set their means to be their intensity values used above, namely $\lambda_1=a_1$, $\lambda_2=a_2$. To generate random values from these distributions we will use the built-in Matlab function <code><a href="http://www.mathworks.com/help/stats/exprnd.html">exprnd()</a></code>. 
		</li>
		<li>
			<strong>Wind direction, </strong>$\theta$. Simply put, we will assume the wind blows in any direction so that $p_\theta(\theta)=\frac{1}/{2\pi}$ for $\theta\in[0,2\pi]$.  
		</li>
		<li>
			<strong>Wind Speed, </strong>$W$. We will assume that wind speed follows the <a href="https://en.wikipedia.org/wiki/Weibull_distribution">Weibull distribution</a>. It has been shown that the Weibull distribution is a fairly accurate distribution for wind speeds. We will use this distribution with shape and scale two. 
		</li>
	</ul>
	
	<p>Now, we want the expected amount of fluid at the point $\bx_P$. For simplicity, we will make the assumption that the variables being analyzed are independent of one another. That is, we calculate their joint probability distribution as $p(W,\theta,a_1,a_2)=p_W(W)p_\theta(\theta)p_{\{a_1,a_2\}}(a_1),p_{\{a_1,a_2\}}(a_2)$. Therefore, the expected amount of fluid at $\bx_P$ over $[t_0,t_f]$ becomes \[\mathbb{E}[\Psi]=\int_{0}^{2\pi}\int_0^\infty\int_0^\infty\int_0^\infty\Psi(W,\theta,a_1,a_2)p_W(W)p_\theta(\theta)p_{\{a_1,a_2\}}(a_1),p_{\{a_1,a_2\}}(a_2)\]</p>
	<p>We use the Monte Carlo method to estimate the above equation. We repeatedly sample the four parameters from their respective distributions, and using those values to compute $\Psi$. Therefore, each sampling will require us to resolve the PDE using new parameters. 
	Then, we can approximate the expected value of $\Psi$ with the formula \[\mathbb{E}[K]\approx \frac{1}{N}\sum_{i=1}^NW\left(W^{(n)},\theta^{(n)},a_1^{(n)},a_2^{(n)}\right)\]</p>
	<p>We used $N=100$ iterations for the approximation. This gives us 
	<pre><output>Expected total pollution experienced, E[K] = 2.341709e-02</output></pre>
	</p>
	<p>In an attempt to provide a quantitative answer to the question of our accuracy, we use <a href="https://en.wikipedia.org/wiki/Confidence_interval">confidence intervals.</a> First, we compute the mean, standard deviation and standard error and get
	<pre><output>The sample mean is: 2.341709e-02
The sample standard deviation is: 3.702424e-02
The standard error of the mean is: 3.702424e-03</output></pre></p>
	<p>Now, we may assume the distribution of means is normally distributed around the population mean. Let us calculate the 95% and 99% confidence intervals of this error. 
	For 95%, let $\alpha=0.05$.  Since $N>10$, with 95% certainty we may postulate that \[\mu\in\left(\overline{X}-z_{\alpha/2}\frac{s_x}{\sqrt{n}},\overline{X}+z_{\alpha/2}\frac{s_x}{\sqrt{n}}\right)=(0.016,0.0306)\] where $z_{\alpha/2}=1.96$ and $\overline{X}$ is the sample mean.  
	For 99%, let $\alpha=0.01$. With 99\% certainty we may postulate that \[\mu\in\left(\overline{X}-z_{\alpha/2}\frac{s_x}{\sqrt{n}},\overline{X}+z_{\alpha/2}\frac{s_x}{\sqrt{n}}\right)=(0.014,0.033)\] where $z_{\alpha/2}=2.58$. 
	Therefore, we can see with high certainty that our sample is representative of the true mean ($\mu$) -- therefore our uncertainty with $N=100$ is very low. 
	</p>

	<p></p>

</div>

<?php include('../../includes/globalfooter.php'); ?>
</html>