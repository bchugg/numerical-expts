// Local configuration file for LaTeX integration into HTML files

MathJax.Hub.Config({
  tex2jax: { 
    inlineMath: [['$','$'], ['\\(','\\)']], 
  },
  TeX: {
    Macros: {
      rr: "{\\mathbb{R}}",
      pd: "{\\partial}",
      bx: "{\\textbf{x}}"
    }
  }
});

MathJax.Hub.Configured();