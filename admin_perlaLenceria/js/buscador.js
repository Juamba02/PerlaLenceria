const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('.fila-principal');

    searchInput.addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      for (const row of tableRows) {
        const orderId = row.cells[0].innerText.toLowerCase();
        const clientName = row.cells[4].innerText.toLowerCase();
        if (orderId.includes(searchValue) || clientName.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    });