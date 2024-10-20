function toggleSubMenu(button) {

    const submenu = button.closest('tr').nextElementSibling;
    if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'table-row'; 
    } else {
        submenu.style.display = 'none'; 
    }
}