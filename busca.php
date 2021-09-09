<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="js/jquery/jquery.js"></script>
     <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style type="text/css">
        #autoCompletedList {
          color: hsl(0, 0%, 0%);
          padding: 0;
          margin: 0;
          list-style-type: none;
        }
        #autoCompletedList li {
          background: #424242;
          padding: 5px;
          color: hsl(0, 0%, 100%);
          border-bottom: dotted 1px hsl(0, 0%, 58%);
        }
        #autoCompletedList li:hover {
          background: hsl(0, 0%, 36%);
          cursor: pointer;
        }
    </style>
</head>
<body>
<form method="post" ation="" name="formulario" id="formulario">
  <div class="form-group">
    <label for="inputName" class="col-sm-1-12 col-form-label">Buscar: </label>
    <div class="col-sm-1-12">
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Buscar">
    </div>
  </div>
</form>
<script type="text/javascript">
    nombre.addEventListener('keyup', (event) => {
    // create List if not exist
    if (!document.querySelector("#autoCompletedList")) {
        ul = document.createElement('ul');
        ul.setAttribute('id', 'autoCompletedList');
        nombre.after(ul);
    }
 
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState < 4) { }
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
     
            var res = this.responseText;
            alert(res);
            // remove elements
            lista = document.querySelector('#autoCompletedList');
            lista.innerHTML = "";
 
            if (!res.error) {
 
                for (i = 0; i < res.datos.length; i++) {
 
                    let id = res.datos[i].id;
                    let nombre = res.datos[i].nombre;
 
                    li = document.createElement("li");
                    li.setAttribute('class', 'item' + res.datos[i].id);
                    li.innerHTML = res.datos[i].nombre;
                    lista.prepend(li);
 
                    document.querySelector('.item' + id).addEventListener('click', () => {
                        document.querySelector("#nombre").value = nombre;
                        lista.innerHTML = "";
                    })
                }
            }
 
        }
    }
    xhr.open('post','php/buscaproducto.php', true);
    // form data
    let form = document.querySelector('#formulario');
    data = new FormData(form);
    xhr.send(data);
 
})
</script>
</body>
</html>

