const tableLista = document.querySelector("#tableListaProductos tbody");
document.addEventListener("DOMContentLoaded", function () {
  if (tableLista) {
    getListaProductos();
  }
});

function getListaProductos() {
  const url = base_url + "principal/listaProductos";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((producto) => {
        html += `<tr>
                    <td>
                        <img class="img-thumbnail rounded-circle" src="${
                            producto.imagen
                        }" alt="" width="100">  
                    </td>
                    <td>${producto.nombre}</td>
                    <td>
                        <span class="badge bg-warning">${
                            res.moneda + " " + producto.precio
                        }</span>
                    </td>
                    <td>
                        <span class="badge bg-primary">${
                            producto.cantidad
                        }</span>
                    </td>
                    <td>
                        ${producto.subTotal}
                    </td>
                </tr>`;
      });
      tableLista.innerHTML = html;
      document.querySelector("#totalProducto").textContent =
        "Total: " + res.moneda + res.total;
      botonPaypal(res.totalPaypal);
    }
  };
}

function botonPaypal(total) {
  paypal
    .Buttons({
      style: {
        color: "blue",
        shape: "pill",
        label: "pay",
        height: 40,
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          application_context: {
            shipping_preference: "NO_SHIPPING",
          },
          purchase_units: [
            {
              amount: {
                currency_code: "USD",
                value: total,
              },
            },
          ],
        });
      },

      onApprove: (data, actions) => {
        return actions.order.capture().then(function (orderData) {
          console.log(
            "Capture result",
            orderData,
            JSON.stringify(orderData, null, 2)
          );
          var transaction = orderData.purchase_units[0].payments.captures[0];
          alert(
            "Transaction " +
              transaction.status +
              ": " +
              transaction.id +
              "\n\nSee console for all available details"
          );
        });
      },
    })
    .render("#paypal-button-container");
}
