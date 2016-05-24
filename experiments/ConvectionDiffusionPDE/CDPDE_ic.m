function ic = CDPDE_ic(nn,d,a1,a2,s1,s2)
% Return initial conditions for Convection Diffusion PDE 
% nn = nx*ny, a1,a2,s1,s2 are constants defined in I.C
ic = zeros(nn,1);
n = sqrt(nn);
for i = 2:n-1
    for j = 2:n-1
        g = CDPDE_G(i,j,n);
        y = d*(i-1);      % y-coordinate
        x = d*(j-1);      % x-coordinate
        u = a1*exp(-s1*((x-0.25)^2+(y-0.25)^2)) ... 
            + a2*exp(-s2*((x-0.65)^2+(y-0.4)^2));
        ic(g) = u;
    end
end
end