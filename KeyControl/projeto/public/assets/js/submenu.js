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

  function removeSelected(selectId) {
    const select = document.getElementById(selectId);
    select.selectedIndex = 0; 
    select.value = "";

    const form = select.closest('form');
    if (form) {
        form.submit(); 
    }
}

function checkSelection(selectId) {
    const select = document.getElementById(selectId);
    const removeIcon = document.querySelector(`span[data-select="${selectId}"]`);

    if (select.value === "") {
        removeIcon.style.display = 'none';
    } else {
        removeIcon.style.display = 'block';
    }
}
