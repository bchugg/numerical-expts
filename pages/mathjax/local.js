// Local configuration file for LaTeX integration into HTML files

MathJax.Hub.Config({
  tex2jax: { 
    inlineMath: [['$','$'], ['\\(','\\)']], 
  },
  TeX: {
    Macros: {
      RR: "{\\mathbb{R}}",
      pd: "{\\partial}"
    }
  }
});

MathJax.Hub.Configured();