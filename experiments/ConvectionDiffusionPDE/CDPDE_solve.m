function [u,t] = CDPDE_solve(A,u,numsteps)
% Carries out the numerical approximation to the solution of the 
% Convection Diffusion PDE, where Au_{i+1}=u_i for 1<=i<=numsteps
% Also returns t, time taken to carry out the computation

tic;
for ii = 2:numsteps
    u(:,ii) = A\u(:,ii-1);
end
t = toc;
end