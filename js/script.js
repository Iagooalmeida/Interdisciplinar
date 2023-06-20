window.addEventListener('DOMContentLoaded', function() {
    const titles = document.querySelectorAll('.collapse-title');
  
    titles.forEach(function(title) {
      title.addEventListener('click', function() {
        const content = this.nextElementSibling;
        
        if (content.style.display === 'none') {
          content.style.display = 'block';
        } else {
          content.style.display = 'none';
        }
      });
    });
  });
  