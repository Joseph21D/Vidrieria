const btnAddDeseo = document.querySelectorAll(".btnAddDeseo");
const btnAddCarrito = document.querySelectorAll(".btnAddCarrito");
const btnDeseo = document.querySelector("#btnCantidadDeseo");
const btnCarrito = document.querySelector("#btnCantidadCarrito");
const verCarrito = document.querySelector("#verCarrito");
const tableListaCarrito = document.querySelector("#tableListaCarrito tbody");

var myModal = new bootstrap.Modal(document.getElementById("myModal"));
let listaDeseo, listaCarrito;

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("listaDeseo") != null) {
    listaDeseo = JSON.parse(localStorage.getItem("listaDeseo"));
  }
  if (localStorage.getItem("listaCarrito") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
  }
  for (let i = 0; i < btnAddDeseo.length; i++) {
    btnAddDeseo[i].addEventListener("click", function () {
      let idProducto = btnAddDeseo[i].getAttribute("prod");
      agregarDeseo(idProducto);
    });
  }
  for (let i = 0; i < btnAddCarrito.length; i++) {
    btnAddCarrito[i].addEventListener("click", function () {
      let idProducto = btnAddCarrito[i].getAttribute("prod");
      agregarCarrito(idProducto, 1);
    });
  }
  cantidadDeseo();
  cantidadCarrito();

  verCarrito.addEventListener("click", function () {
    getListaCarrito();
    myModal.show();
  });
});

function agregarDeseo(idProducto) {
  if (localStorage.getItem("listaDeseo") == null) {
    listaDeseo = [];
  } else {
    let listaExiste = JSON.parse(localStorage.getItem("listaDeseo"));
    for (let i = 0; i < listaExiste.length; i++) {
      if (listaExiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          title: "¡AVISO!",
          text: "El producto ya se encuentra en la Lista de Deseos",
          icon: "warning",
        });
        return;
      }
    }
    listaDeseo.concat(localStorage.getItem("listaDeseo"));
  }
  listaDeseo.push({
    idProducto: idProducto,
    cantidad: 1,
  });
  localStorage.setItem("listaDeseo", JSON.stringify(listaDeseo));
  Swal.fire({
    title: "¡AVISO!",
    text: "Producto Agregado a la Lista de Deseos",
    icon: "success",
  });
  cantidadDeseo();
}

function cantidadDeseo() {
  let listas = JSON.parse(localStorage.getItem("listaDeseo"));
  if (listas != null) {
    btnDeseo.textContent = listas.length;
  } else {
    btnDeseo.textContent = 0;
  }
}

function agregarCarrito(idProducto, cantidad, accion = false) {
  if (localStorage.getItem("listaCarrito") == null) {
    listaCarrito = [];
  } else {
    let listaExiste = JSON.parse(localStorage.getItem("listaCarrito"));
    for (let i = 0; i < listaExiste.length; i++) {
      if (accion) {
        eliminarListaDeseo(idProducto);
      }
      if (listaExiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          title: "¡AVISO!",
          text: "El producto ya esta Agregado",
          icon: "warning",
        });
        return;
      }
    }
    listaCarrito.concat(localStorage.getItem("listaCarrito"));
  }
  listaCarrito.push({
    idProducto: idProducto,
    cantidad: cantidad,
  });
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  Swal.fire({
    title: "¡AVISO!",
    text: "Producto Agregado al Carrito",
    icon: "success",
  });
  cantidadCarrito();
}

function cantidadCarrito() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listas != null) {
    btnCarrito.textContent = listas.length;
  } else {
    btnCarrito.textContent = 0;
  }
}

function getListaCarrito() {
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
                    <td class="text-center">${producto.nombre}</td>
                    <td class="text-center">
                        <span class="badge bg-warning">${
                          res.moneda + " " + producto.precio
                        }</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary">${
                          producto.cantidad
                        }</span>
                    </td>
                    <td class="text-center">
                        ${res.moneda + producto.subTotal}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger btnDeleteCart" type="button" prod="${
                          producto.id
                        }"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>`;
      });
      tableListaCarrito.innerHTML = html;
      document.querySelector("#totalGeneral").textContent = res.moneda + res.total;
      btnEliminarCarrito();
    }
  };
}

function btnEliminarCarrito() {
  let listaEliminar = document.querySelectorAll(".btnDeleteCart");
  for (let i = 0; i < listaEliminar.length; i++) {
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      eliminarListaCarrito(idProducto);
    });
  }
}

function eliminarListaCarrito(idProducto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["idProducto"] == idProducto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  getListaCarrito();
  cantidadCarrito();
  Swal.fire({
    title: "¡AVISO!",
    text: "Producto Eliminado del Carrito",
    icon: "success",
  });
}
