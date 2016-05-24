<!DOCTYPE html>
<html>
<head>
	<title> CDPDE | Formulation </title>
	<link rel="stylesheet" type="text/css" href="../../views/CDPDE.css">
</head>
<body>
<!-- LOCAL CONSTANTS --> 
$
\newcommand{\ma}{\mathcal{A}}
\newcommand{\mb}{\mathcal{B}}
\newcommand{\mc}{\mathcal{C}}
\newcommand{\md}{\mathcal{D}}
\newcommand{\me}{\mathcal{E}}
\newcommand{\g}{G(i,j)}
$

<?php include('../includes/header.php'); ?>

<?php include('../includes/CDPDE.php'); ?>
<h2>Mathematical Formulation</h2>
<p>To spatially discretize the PDE, we use the centred difference approximations to the first and second derivatives, i.e., 
\[\left.\frac{df(x,t)}{dx}\right|_{x=x_0}=\frac{f(x_0+h,t)-f(x_0-h,t)}{2h}+\bo(h^2)\approx\frac{f(x_0+h,t)-f(x_0-h,t)}{2h} \]
\[\left.\frac{d^2f(x,t)}{dx^2}\right|_{x=x_0}=\frac{f(x_0+h,t)-2f(x_0,t)+f(x_0-h,t)}{h^2}+\bo(h^2) 
\approx \frac{f(x_0+h,t)-2f(x_0,t)+f(x_0-h,t)}{h^2}\] We model the equation on the uniform grid with $n_x=n_y=81$ points such that the spacing between adjacent grid points is constant: $\Delta _x=\Delta _y=1/80$. Let $u_{i,j}(t)$ describe the spatially discretized variable at the grid points, with $i\in\{1,2,\ldots,n_y\}$, $j\in\{1,2,\ldots,n_x\}$ representing the vertical and horizontal grid points, respectively. 

Therefore we may write the PDE discreetly as 
\begin{align*}
\frac{d}{dt}u_{i,j}(t)&=\frac{D}{(\Delta_x)^2}(u_{i,j+1}(t)-2u_{i,j}(t)+u_{i,j-1}(t))+\frac{D}{(\Delta_y)^2}(u_{i+1,j}(t)-2u_{i,j}(t)+u_{i-1,j}(t)) \\
&\qquad-\left[W\cos\theta\left(\frac{u_{i,j+1}(t)-u_{i,j-1}(t)}{2\Delta_x}\right)+W\sin\theta\left(\frac{u_{i+1,j}(t)-u_{i-1,j}(t)}{2\Delta_y}\right)\right] 
\end{align*}

If $\vec{y}\,'(t)\equiv f(t,\vec{y})$ then via the Taylor expansion of $\vec{y}$ we can obtain the backward Euler approximation: $\vec{y}_{i+1}=\vec{y}_i+\Delta tf(t_{i+1},\vec{y}_{i+1})$. Therefore we can complete the discretization of the PDE in time as 
\begin{align*}
u_{i,j,\tau+1}&=u_{i,j,\tau}+\Delta t\left\{\frac{D}{(\Delta_x)^2}(u_{i,j+1,\tau+1}-2u_{i,j,\tau+1}+u_{i,j-1,\tau+1})+\frac{D}{(\Delta_y)^2}(u_{i+1,j,\tau+1}-2u_{i,j,\tau+1}\right. \\
&\qquad+\left.u_{i-1,j,\tau+1})-W\left[\cos\theta\left(\frac{u_{i,j+1,\tau+1}-u_{i,j-1,\tau+1}}{2\Delta_x}\right)+\sin\theta\left(\frac{u_{i+1,j,\tau+1}-u_{i-1,j,\tau+1}}{2\Delta_y}\right)\right]\right\}
\end{align*} 
where $\tau$ is the discrete time index running from 1 to the final time step, $t_f$.</p>

<p>We now have a system of $n_xn_y$ ordinary differential equations and their update rules. To write the system in matrix notation, we need a way to represent the system at a given time $t$ as a vector. To do so we use column-major order so that the state of the system at time step $\tau$ will be represented as 
\[\bu_\tau=\begin{bmatrix}u_{1,1,\tau} \\ u_{2,1,\tau} \\ \vdots \\ u_{n_y,1,\tau} \\ u_{1,2,\tau} \\ \vdots \\ u_{n_y,n_x,\tau} \end{bmatrix}\] For convenience, we define a function $G(i,j)$ which sends a grid point to its linear index based on column-major order. It's easy to see that $G$ has the form $G(i,j)=i+(j-1)n_y$. The motivation behind this is as follows: we'd like to send the first $(1,1),(2,1),\ldots,(n_y,1)$ elements to the first $n_y$ spots, i.e., the first "block" of the array, so we want $(i,1)\mapsto i$. Then we want, for fixed $j$, $(1,j),(2,j),\ldots,(n_y,j)$ mapped to the $j$-th block in the array, so $(i,j)\mapsto i+(j-1)n_y$.</p>

<p>Now, to write the update rule as a linear system of the form \[A\bu_{\tau+1}=\bu_\tau\] we describe the non-zero entries of $A$. Note that we can write the update rule as \begin{align*}
u_{i,j,\tau}&=u_{i,j,\tau+1}+2D\Delta t\left(\frac{1}{\Delta_x^2}+\frac{1}{\Delta_y^2}\right)u_{i,j,\tau+1}-\Delta t\left(\frac{D}{\Delta_x^2}-W\frac{\cos\theta}{2\Delta_x}\right)u_{i,j+1,\tau+1}\\
&\qquad -\Delta t\left(\frac{D}{\Delta_x^2}+W\frac{\cos\theta}{2\Delta_x}\right)u_{i,j-1,\tau+1}-\Delta t\left(\frac{D}{\Delta_y^2}-W\frac{\sin\theta}{2\Delta_y}\right)u_{i+1,j,\tau+1}\\ 
&\qquad-\Delta t\left(\frac{D}{\Delta_y^2}+W\frac{\sin\theta}{2\Delta_y}\right)u_{i-1,j,\tau+1} \\
&=\ma u_{i,j,\tau+1}-\mb u_{i,j+1,\tau+1}
-\mc u_{i,j-1,\tau+1}-\md u_{i+1,j,\tau+1}-
\me u_{i-1,j,\tau+1}
\end{align*} where \[\ma=1+2D\Delta t\left(\frac{1}{\Delta_x^2}+\frac{1}{\Delta_y^2}\right),\quad\mb=\Delta t\left(\frac{D}{\Delta_x^2}-W\frac{\cos\theta}{2\Delta_x}\right),\quad \mc =\Delta t\left(\frac{D}{\Delta_x^2}+W\frac{\cos\theta}{2\Delta_x}\right)\]
\[\md=\Delta t\left(\frac{D}{\Delta_y^2}-W\frac{\sin\theta}{2\Delta_y}\right),\quad\me=\Delta t\left(\frac{D}{\Delta_y^2}+W\frac{\sin\theta}{2\Delta_y}\right)\]
Consider an arbitrary $u_{i,j,\tau}$. Its update rule depends on $u_{i,j,\tau+1}$ which is found at $A_{\g,\g}$ when we multiply $A\textbf{u}_{\tau+1}$; $u_{i,j+1,\tau+1}$ which is found at  $A_{\g,\g+n_y}$, $u_{i,j-1,\tau+1}$ which is found at $A_{\g,\g-n_y}$; $u_{i+1,j}$ which is found at $A_{\g,\g+1}$ and $u_{i-1,j,\tau+1}$ which is found at $A_{\g,\g-1}$. Therefore, for all $(i,j)$ not on the boundary we have \[A_{\g,\g}=\ma\] \[A_{\g,G(i,j+1)}=-\mb\] \[A_{\g,G(i,j-1)}=-\mc\] \[A_{\g,G(i+1,j)}=-\md\] \[A_{\g,G(i-1,j)}=-\me\] To enforce the boundary conditions we set all rows corresponding to boundary points are the rows of the identity matrix. This ensures that they do not evolve over time and stay at 0. Therefore, our system resembles: \[
\begin{bmatrix}
1 \\ 
& \ddots & \ddots \\
&& -\mc & \ldots & -\me & \ma & -\md & \ldots &-\mb & \\
& \ & -\mc & \ldots & -\me & \ma & -\md & \ldots &-\mb &\\
& \ & \ & \ & \ & \ddots & \ddots \\
&&&&&&1 \\
& \ & \ & \ & \ &&& \ddots & \ddots \\
&& \ & \ & -\mc & \ldots & -\me & \ma & -\md & \ldots &-\mb \\
&& \ & \ & \ & -\mc & \ldots & -\me & \ma & -\md & \ldots &-\mb \\
&&&&&&&&\ddots & \ddots  \\
&&&&&&&&&1\\
&&&&&&&&&&\ddots &\ddots \\
&&&&&&&&&&&&1\\
&&&&&&&&&&&&&1
\end{bmatrix}
\begin{bmatrix}
u_{1,1,\tau+1} \\
u_{2,1,\tau+1} \\
\vdots \\
\vdots \\
u_{n_x,j,\tau+1} \\
u_{1,2,\tau+1} \\
\vdots \\
\vdots \\
u_{n_x,2,\tau+1}\\
u_{1,3,\tau+1} \\
\vdots \\
\vdots \\
u_{n_x,n_y,\tau+1}
\end{bmatrix}=\bf{u}_{\tau}
\]
Where ones occur at all the corresponding rows of $\textbf{u}_{i,j,\tau+1}$ with $i\in\{1,n_y\}$ or $j\in\{1,n_x\}$. 
</p>

<!-- Footer TODO, abstract global header-->
<p class="footer">
	Page maintained by <a href="main.html">Ben Chugg</a>
</p>

</html>