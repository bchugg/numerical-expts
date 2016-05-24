function [Am,Bm,Cm,Dm,Em] = CDPDE_createAElements(W,theta,D,dt,dx,dy)
% Create matrix elements that are the non-zero entries in the matrix A

Am = 1 + 2*D*dt*(1/dx^2+1/dy^2);
Bm = dt*(D/dx^2-W*cos(theta)/(2*dx));
Cm = dt*(D/dx^2+W*cos(theta)/(2*dx));
Dm = dt*(D/dy^2-W*sin(theta)/(2*dy));
Em = dt*(D/dy^2+W*sin(theta)/(2*dy));
end
