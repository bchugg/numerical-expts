// Local configuration file for LaTeX integration into HTML files

MathJax.Hub.Config({
  tex2jax: { 
    inlineMath: [['$','$'], ['\\(','\\)']], 
  },
  TeX: {
    extensions: ["AMSmath.js, AMSsymbols.js"],
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