const btnRegister = document.querySelector("#btnRegister");
const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");
const frmRegister = document.querySelector("#frmRegister");
const registrarse = document.querySelector("#registrarse");
const login = document.querySelector("#login");
// Datos de Registro
const nombreRegistro = document.querySelector("#nombreRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const claveRegistro = document.querySelector("#claveRegistro");
// Datos de Login
const correoLogin = document.querySelector("#correoLogin");
const claveLogin = document.querySelector("#claveLogin");
const inputBusqueda = document.querySelector("#inputModalSearch");
var modalLogin = new bootstrap.Modal(document.getElementById("modalLogin"));

document.addEventListener("DOMContentLoaded", function () {
  btnRegister.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegister.classList.remove("d-none");
  });
  btnLogin.addEventListener("click", function () {
    frmRegister.classList.add("d-none");
    frmLogin.classList.remove("d-none");
  });
  // Registro
  registrarse.addEventListener("click", function () {
    if (
      nombreRegistro.value == "" ||
      correoRegistro.value == "" ||
      claveRegistro.value == ""
    ) {
      Swal.fire({
        title: "¡AVISO!",
        text: "Todos los campos son Requeridos",
        icon: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("nombre", nombreRegistro.value);
      formData.append("correo", correoRegistro.value);
      formData.append("clave", claveRegistro.value);
      const url = base_url + "clientes/registroDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire({
            title: "¡AVISO!",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            setTimeout(() => {
              enviarCorreo(correoRegistro.value, res.token);
            }, 2000);
          }
        }
      };
    }
  });
  // Login
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || claveLogin.value == "") {
      Swal.fire({
        title: "¡AVISO!",
        text: "Todos los campos son Requeridos",
        icon: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("claveLogin", claveLogin.value);
      const url = base_url + "clientes/loginDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire({
            title: "¡AVISO!",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });
  // Busqueda
  inputBusqueda.addEventListener('keyup', function(e){
      const url = base_url + "principal/busqueda/" + e.target.value;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          let html = '';
          res.forEach(producto => {
            html += `<div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="${ base_url + 'principal/detail/' + producto.id }">
                            <img src="${ producto.imagen }" class="card-img-top" alt="${ producto.nombre }">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">${ 'S/.' + producto.precio }</li>
                            </ul>
                            <a href="${ base_url + 'principal/detail/' + producto.id }" class="h2 text-decoration-none text-dark">${ producto.nombre }</a>
                            <p class="card-text">
                            ${ producto.descripcion }
                            </p>
                            <p class="text-muted">Reseñas (24)</p>
                        </div>
                    </div>
                </div>`
          })
          document.querySelector('#resultBusqueda').innerHTML = html;
        }
      };
  })
});

function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("correo", correo);
  formData.append("token", token);
  const url = base_url + "clientes/enviarCorreo";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(formData);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      Swal.fire({
        title: "¡AVISO!",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}

function abrirModalLogin() {
  myModal.hide();
  modalLogin.show();
}