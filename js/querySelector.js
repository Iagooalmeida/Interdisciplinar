// var elemento = document.querySelector('.cabecalho');


// window.addEventListener('scroll', function() {
//     var scrollPosition = window.scrollY;
//     var elementoPosition = elemento.offsetTop;
  
//     if (scrollPosition > elementoPosition) {
//       elemento.style.top = '-37px'; // Exemplo de subir o elemento em 50 pixels
//     } else {
//       elemento.style.top = '0'; // Retornar o elemento à sua posição original
//     }
//   });
 

// // document.addEventListener('scroll', function() {
// //     var scrollPosition = window.pageYOffset;
// //     elemento.style.top = (-scrollPosition) + 'px';
// //   });
  
var elemento = document.getElementById('cabecalho');
var ultimoScroll = window.pageYOffset;

window.onscroll = function() {
  var novoScroll = window.pageYOffset;

  if (ultimoScroll > novoScroll) {
    elemento.style.transform = 'translateY(0)';
  } else {
    elemento.style.transform = 'translateY(-24%)';
  }

  ultimoScroll = novoScroll;
};
