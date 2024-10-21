function toggleSubMenu(button) {
    const submenu = button.nextElementSibling; 
    if (submenu.style.display === "none" || submenu.style.display === "") {
        submenu.style.display = "block"; 
    } else {
        submenu.style.display = "none"; 
    }
}