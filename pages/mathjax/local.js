// Local configuration file for LaTeX integration into HTML files

MathJax.Hub.Config({
  tex2jax: { 
    inlineMath: [['$','$'], ['\\(','\\)']], 
  },
  TeX: {
    Macros: {
      // GLOBAL CONSTANTS
      rr: "{\\mathbb{R}}",
      pd: "{\\partial}",
      bx: "{\\textbf{x}}",
      bo: "{\\mathcal{O}}",
      bu: "{\\textbf{u}}"
    }
  }
});

MathJax.Hub.Configured();