function [EK,solns,K] = CDPDE_ExpPol(mean_a1,mean_a2,N,g,D,nx,ny,dx,dy,dt,numsteps)
% Gives expected pollution, EK, from [0,tf] of Kindergation at location g in 
% solution over N trials. Also records each solution for use in statistical
% analysis afterwards

ui = zeros(nx*ny,numsteps);
K = zeros(N,1);
solns = zeros(nx*ny,numsteps,N);   %solns(:,:,k) is k-th solution
EK = 0;

for ii = 1:N
    w = wblrnd(2,2);         % Sample from Weibull distribution
    a1 = exprnd(mean_a1);    % Sample from exponential distribution
    a2 = exprnd(mean_a2);    % Sample from exponential distribution
    theta = rand * 2*pi;     % Sample from [0,2pi], uniform
  
    % Initial conditions and create update matrix
    ui(:,1) = CDPDE_ic(nx*ny,dx,a1,a2,100,150);
    [Ami,Bmi,Cmi,Dmi,Emi] = CDPDE_createAElements(w,theta,D,dt,dx,dy);
    Ai = sparse(CDPDE_createA(nx,ny,Ami,Bmi,Cmi,Dmi,Emi));
    
    %Solve
    ui = CDPDE_solve(Ai,ui,numsteps);
    kti = ui(g,:);
    Ki = trapz(kti)*dt;
    K(ii) = Ki;
    solns(:,:,ii) = ui;
    
    %Update Solution 
    EK = EK + Ki;
end

EK = EK/N;


end