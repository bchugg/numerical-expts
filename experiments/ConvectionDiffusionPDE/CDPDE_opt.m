function K = CDPDE_opt(x,u,D,dt,dx,dy,nx,ny,numsteps) 
% Solve PDE with fixed a1,a2,s1,s2 to solve optimize problem where 
% x(1) = W, x(2) = theta

% Create A
[Am,Bm,Cm,Dm,Em] = CDPDE_createAElements(x(1),x(2),D,dt,dx,dy);
A = sparse(CDPDE_createA(nx,ny,Am,Bm,Cm,Dm,Em));

% Solve
u = CDPDE_solve(A,u,numsteps);

% Pollution experienced in one day at (0.5,0.5)
g = CDPDE_G(40,40,ny);   
kt = u(g,:);
K = trapz(kt)*dt;
end