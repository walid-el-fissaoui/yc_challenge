window.addEventListener("DOMContentLoaded", () => {

  const products = new Array();

  const table = document.querySelector("table");

  function updateTableRows() {
    const row = table.querySelector("tbody");
    row.innerHTML = "";
    products.forEach((product) => {
      const productRow = `<tr>
      <td>
      <img src="${
        product[0]
      }" class="img-fluid" style="width: 50px" alt="product image">
      </td>
      <td>${product[1]}</td>
      <td>${product[2]}</td>
      <td>${product[3]}</td>
      <td>${product[4] ?? ""}</td>
      <td>${product[5]}</td>
    </tr>
    `;
      row.insertAdjacentHTML("beforeend", productRow);
    });
  }

  async function fetchProducts(url) {
    products.length = 0;
    const jsonString = await fetch(url, {
      method: "GET",
    });
    const data = await jsonString.json();
    if (data) {
      products.push(...data);
      updateTableRows()
    }
  }
  
  
  fetchProducts(table.getAttribute("data-fetch"), table);

  const filterForm = document.getElementById("filter-by-category");
  filterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let url = filterForm.getAttribute("action");
    const selectedCategory = filterForm.querySelector("select").value;
    url += `?cat=${selectedCategory}`;
    fetchProducts(url, table);
  });

  const sortWidget = document.getElementById("sort-by-price");
  const sortWidgetButton = sortWidget.querySelector("button");
  const sortWidgetType = sortWidget.querySelector("select");
  sortWidgetButton.addEventListener("click", (e) => {
    const sortingType = sortWidgetType.value;
    if(sortingType === "asc") {
      products.sort((a,b) => a[3] - b[3])
    }
    else {
      products.sort((a,b) => b[3] - a[3])
    }
    updateTableRows();
  });
});
