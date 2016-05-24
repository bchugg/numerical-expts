function i = CDPDE_contours(u,S,times,c,dt,fileout)
% Create contour plot of solution u 
l = length(times);
nx = size(S,1);
ny = nx;

%Gather data from solution in column major order
for i = 1:l
    for x = 1:nx
        for y = 1:ny
            row = x + (y-1)*ny;
            S(x,y,i) = u(row,times(i));
        end
    end
end

% Save figure with contours 
clear figure;
colorbar;
for i = 1:l
    subplot(l,1,i);
    contour(S(:,:,i),c), colorbar;
    header = sprintf('Contour Plot of solution at t=%d', (times(i)-1)*dt);
    title(header);
end
print(fileout, '-dpng');
end
