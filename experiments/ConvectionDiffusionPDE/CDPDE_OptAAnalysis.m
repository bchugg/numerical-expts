% File to analyze the speedup gained by optimizing the matrix A

% Define constants 

W = 1;
D = 0.05;
theta = pi/2;

dt = 0.025;                   % timestep
t_final = 0.25;
numsteps = t_final/dt + 1;

nx = 81; ny = 81;  
dx = 1/(nx-1); dy = 1/(ny-1); % space step

u = zeros(nx*ny,numsteps);
u(:,1) = CDPDE_ic(nx*ny,dx,2,1,100,150);


%% Analyze time difference 

% Set matrix elements based on update rule
[Am,Bm,Cm,Dm,Em] = CDPDE_createAElements(W,theta,D,dt,dx,dy);

% Create matrix A 
A = CDPDE_createA(nx,ny,Am,Bm,Cm,Dm,Em);
spy(A);
title('Sparsity of matrix A');
filepath = '../../data/CDPDE/sparsityofA';
saveas(gcf, filepath, 'jpeg');

%% Solve PDE using original A

[u,t1] = CDPDE_solve(A,u,numsteps);
fprintf('Original time taken to solve system: %d\n', t1);

%% Solve PDE using sparsity of matrix A and compare times

SA = sparse(A);
[u,t2] = CDPDE_solve(SA,u,numsteps);
fprintf('Time taken to solve system using sparse matrix: %d\n', t2);

saved_time = t1 - t2;
speedup_factor = saved_time / t1;
fprintf('Using a sparse matrix calculation our speedup factor is: %d\n', speedup_factor);

