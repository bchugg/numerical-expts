function A = CDPDE_createA(nx,ny,Am,Bm,Cm,Dm,Em)
% Return matrix A that is used to solve Backward Euler at each 
% time step
n = nx*ny;
A = eye(n,n);

for row = ny+1:n-ny-1
    if (mod(row,ny) ~= 1 && mod(row,ny) ~= 0)
        A(row,row) = Am;
        A(row,row+ny) = -Bm;
        A(row,row-ny) = -Cm;
        A(row,row+1) = -Dm;
        A(row,row-1) = -Em;
    end
end

end