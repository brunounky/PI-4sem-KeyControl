let activeSubmenu = null; 

function toggleSubMenu(button) {
    const submenu = button.nextElementSibling;
  
    if (activeSubmenu && activeSubmenu !== submenu) {
      activeSubmenu.style.display = 'none';
    }
  
    submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
  
    activeSubmenu = submenu.style.display === 'block' ? submenu : null;
  }

  document.addEventListener('click', (event) => {
    if (activeSubmenu && !activeSubmenu.contains(event.target) && !event.target.closest('.btn')) {
      activeSubmenu.style.display = 'none';
      activeSubmenu = null;
    }
  });
