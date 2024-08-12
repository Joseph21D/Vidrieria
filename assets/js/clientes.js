const tableLista = document.querySelector("#tableListaProductos tbody");
const tblPendientes = document.querySelector("#tblPendientes");
document.addEventListener("DOMContentLoaded", function () {
  if (tableLista) {
    getListaProductos();
  }
  // DATOS PENDIENTES
  $("#tblPendientes").DataTable({
    ajax: {
      url: base_url + "/clientes/listarPendientes",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      {
        data: "monto",
        render: function (data, type, row) {
          return "<strong>$. </strong>" + data;
        },
      },
      { data: "fecha" },
      { data: "accion" },
    ],
    layout: {
      top: ["pageLength", "buttons", "search"],
      topStart: null,
      topEnd: null,
    },
    buttons,
    language,
  });
});

function getListaProductos() {
  let html = "";
  const url = base_url + "principal/listaProductos";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res.totalPaypal > 0) {
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
            <span class="badge bg-light me-2 fs-5 text-dark">${
              res.moneda + res.total
            } o $/${res.totalPaypal}</span>
          </div>`;
        botonPaypal(res.totalPaypal);
      } else {
        tableLista.innerHTML = `
        <tr>
          <td colspan="5" class="text-center">Carrito Vacio</td>
        </tr>`;
      }
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
  http.send(
    JSON.stringify({
      pedios: datos,
      productos: listaCarrito,
    })
  );
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      Swal.fire({
        title: "¡AVISO!",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        localStorage.removeItem("listaCarrito");
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}

function verPedido(idPedido) {
  var mPedido = new bootstrap.Modal(document.getElementById("modalPedido"));
  const url = base_url + "clientes/verPedido/" + idPedido;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((row) => {
        let subTotal = parseFloat(row.precio) * parseInt(row.cantidad);
        html += `<tr>
                    <td class="text-center">${row.producto}</td>
                    <td class="text-center">
                        <span class="badge bg-warning">${
                          res.moneda + " " + row.precio
                        }</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary">${row.cantidad}</span>
                    </td>
                    <td class="text-center">
                        ${res.moneda + subTotal.toFixed(2)}
                    </td>
                </tr>`;
      });
      document.querySelector("#tablePedidos").innerHTML = html;
      mPedido.show();
    }
  };
}
