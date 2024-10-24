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
    select.selectedIndex = 0;  // Reseta a seleção para o primeiro item (default)
    select.value = "";  // Limpa o valor do select

    const form = select.closest('form');  // Encontra o formulário mais próximo
    if (form) {
        form.submit();  // Submete o formulário após limpar a seleção
    }
}

function checkSelection(selectId) {
  const select = document.getElementById(selectId);
  const removeIcon = document.querySelector(`span[data-select="${selectId}"]`);

  if (select.value === "") {
      removeIcon.style.display = 'none';  // Esconde o ícone se não houver seleção
  } else {
      removeIcon.style.display = 'block';  // Mostra o ícone se houver uma seleção
  }
}