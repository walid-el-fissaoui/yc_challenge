window.addEventListener("DOMContentLoaded", async () => {
  const table = document.querySelector("table");
  const url = table.getAttribute("data-fetch");
  const jsonString = await fetch(url, {
    method: "GET",
  });
  const data = await jsonString.json();
  if (data) {
    data.forEach((product) => {
      const productRow = `<tr>
        <td>
        <img src="${product[0]}" class="img-fluid" style="width: 50px" alt="product image">
        </td>
        <td>${product[1]}</td>
        <td>${product[2]}</td>
        <td>${product[3]}</td>
        <td>${product[4] ?? ''}</td>
        <td>${product[5]}</td>
      </tr>
      `;
      table.querySelector("tbody").insertAdjacentHTML('beforeend',productRow);
    });
  }
});
