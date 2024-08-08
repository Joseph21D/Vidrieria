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
                    <td class="text-center">
                        <img class="img-thumbnail rounded-circle" src="${
                          producto.imagen
                        }" alt="" width="100">  
                    </td>
                    <td>
                        ${producto.nombre}
                    </td>
                    <td class="text-center">
                        <span class="badge bg-warning fs-6">${
                          res.moneda + producto.precio
                        }</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary fs-6">${
                          producto.cantidad
                        }</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success fs-6">${
                          res.moneda + producto.subTotal
                        }</span>
                    </td>
                </tr>`;
      });
      tableLista.innerHTML = html;
      document.querySelector("#totalProducto").innerHTML = `
        <div class="d-flex justify-content-end align-items-center">
          <h5 class="mb-0 me-3 text-primary fw-bold fs-4"><strong>TOTAL:</strong></h5>
          <span class="badge bg-light me-2 fs-5 text-dark">${res.moneda + res.total} o $/${
        res.totalPaypal
      }</span>
        </div>`;
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
          registrarPedido(orderData);
        });
      },
    })
    .render("#paypal-button-container");
}

function registrarPedido(datos) {
  const url = base_url + "clientes/registrarPedido";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(datos));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      //const res = JSON.parse(this.responseText);
    }
  };
}
