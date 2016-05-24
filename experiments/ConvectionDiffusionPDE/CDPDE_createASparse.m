function A = CDPDE_createASparse(nx,ny,Am,Bm,Cm,Dm,Em)
% Create matrix A used for solving backward Euler for Convection 
% Diffusion PDE, but create with inherent sparsity

n = nx*ny;
B = zeros(n,5);
B(:,1) = 1;
for row = ny+1:n-ny-1
    if (mod(row,ny) ~= 1 && mod(row,ny) ~= 0)
        B(row,1) = Am;
        B(row+ny,2) = -Bm;
        B(row-ny,3) = -Cm;
        B(row+1,4) = -Dm;
        B(row-1,5) = -Em;
    end
end

d = [0,ny,-ny,1,-1];
A = spdiags(B,d,n,n);

end