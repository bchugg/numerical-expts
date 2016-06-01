<!DOCTYPE html>
<html lang="en">
<head>
	<title> Introduction - CDPDE | Numerics</title>
	<?php include('../../includes/globalheader.php'); ?>

<?php include('../../includes/CDPDE.php'); ?>

<div class="container">
<h2>Problem Statement</h2>
<p>Mathematically, we can model a physical system undergoing convection and diffusion via the PDE, 
\[\frac{\pd u(\bx,t)}{\pd t} =\nabla\cdot(D\nabla u(\bx,t))-\nabla\cdot(\vec{w}\,u(\bx,t)+R\] where $u:\rr^n\times t\longrightarrow \rr$ is the variable in which we're typically interested, $D$ is the diffusivity of $u$, and $\vec{w}:\rr^n\longrightarrow\rr$ describes the velocity of $u$. $R$ describes any sources or sinks of the system. We'll investigate the convection diffusion PDE in $\rr^2$ when $D$ is contact and where $\bx=\langle x,y\rangle$ and $\vec{w}=W\langle \cos(\theta),\sin(\theta)\rangle$. Furthermore, we'll assume that there are no sources or sinks, i.e., that $R\equiv0$ and that the diffusion of $u$ is constant so that $\nabla u\equiv 0$. Under these simplifications, the equation reduces to
\begin{align}
\frac{\pd u(\bx,t)}{\pd t}
&=D\nabla^2u(\bx,t)-W\langle \cos\theta,\sin\theta\rangle\cdot\nabla u(\bx,t) \\
&=D\left(\frac{\pd^2u(\bx,t)}{\pd x^2}+\frac{\pd^2u(\bx,t)}{\pd y^2}\right) - W\left(\cos(\theta)\frac{\pd u(\bx,t)}{\pd x}+\sin(\theta)\frac{\pd u(\bx,t)}{\pd y}\right) 
\end{align}
The initial condition of the above equation usually has the form
\[u(\bx,0)=\sum_{i=1}^ka_i\exp(-s_i[(x-x_i)^2+(y-y_i)^2])\] 
where $\{(x_i,y_i)\}_{i=1}^k$ are the initial positions of $u$, $s_i$ corresponds its initial intensity at each respective position and $s_i$ is the (inverse) width of the substance. We will solve the equation for $k=2$ and $(x_1,y_1)=(0.25,0.25)$, $(x_2,y_2)=(0.64,0.4)$ and with homogenous Dirichlet Boundary Conditions, $u(\bx,t)=0$ for $x\in\pd\Omega$.
</p>
</div>


<?php include('../../includes/globalfooter.php'); ?>
</html>