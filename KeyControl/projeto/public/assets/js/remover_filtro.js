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