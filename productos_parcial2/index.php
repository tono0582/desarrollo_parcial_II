<!doctype html>
<html lang="en">
  <head>
    <title>PRODUCTOS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
      <h1>Formulario Productos</h1>
      <div class="container">     
        <form class="d-flex" action="" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label"><b>Producto</b></label>
                    <input type="text" name="txt_producto" id="txt_producto" class="form-control" required>                 
                </div>
                <div class="mb-3">
                  <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                  <select class="form-select" name="drop_marca" id="drop_marca">
                    <option value=0>---- Marca ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select idMarca as id, marca from marcas;");
                    $resultado = $db_conexion->use_result();
                    while($fila = $resultado->fetch_assoc()){
                        echo"<option value=".$fila['id'].">". $fila['marca'] ."</option>";
                    }
                    $db_conexion ->close();
                    ?>
                  </select>
                </div>                              
                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_costo" class="form-label"><b>Costo</b></label>
                    <input type="number" name="txt_costo" id="txt_costo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_venta" class="form-label"><b>Venta</b></label>
                    <input type="number" name="txt_venta" id="txt_venta" class="form-control" required>
                </div>                
                <div class="mb-3">
                    <label for="lbl_existencia" class="form-label"><b>Existencia</b></label>
                    <input type="text" name="txt_existencia" id="txt_existencia" class="form-control" required>
                </div>                 
                <div class="mb-3">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
                </div>                
            </div>
        </form>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Descripcion</th>
                    <th>Costo</th>
                    <th>Venta</th>
                    <th>Existencia</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("SELECT p.idProductos as id, p.producto,p.idMarca,m.marca as marca,p.descripcion,p.precio_costo,p.precio_venta,p.existencia
                    FROM productos as p inner join marcas as m on p.idMarca=m.idMarca");
                    $resultado = $db_conexion->use_result();
                    while($fila = $resultado->fetch_assoc()){
                        echo"<tr data-id=".$fila['id'].">";
                        echo"<td>".$fila['producto']."</td>";
                        echo"<td>".$fila['marca']."</td>";
                        echo"<td>".$fila['descripcion']."</td>";
                        echo"<td>".$fila['precio_costo']."</td>";
                        echo"<td>".$fila['precio_venta']."</td>";
                        echo"<td>".$fila['existencia']."</td>";
                        echo "<td>";
                        echo "<a href='editar.php?id=".$fila['id']."' class='btn btn-warning'>Editar</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "<a href='eliminar.php?id=".$fila['id']."' class='btn btn-danger'>Eliminar</a>";
                        echo "</td>";
                        echo"</tr>";
                    }
                    $db_conexion ->close();
                    ?>
                </tbody>
        </table>
        
      </div>
<?php 
    if(isset($_POST["btn_agregar"])){
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $txt_producto =utf8_decode( $_POST["txt_producto"]);
        $drop_marca =utf8_decode( $_POST["drop_marca"]);
        $txt_descripcion =utf8_decode( $_POST["txt_descripcion"]);
        $txt_costo =utf8_decode( $_POST["txt_costo"]);
        $txt_venta =utf8_decode( $_POST["txt_venta"]);
        $txt_existencia =utf8_decode( $_POST["txt_existencia"]);
        $sql="INSERT INTO productos (producto, idMarca, descripcion, precio_costo, precio_venta, existencia) 
        VALUES ('".$txt_producto."',".$drop_marca.",'".$txt_descripcion."',".$txt_costo.",".$txt_venta.",".$txt_existencia.");";
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            echo"Exito";
            echo '<script language="javascript">alert("Producto Agregado con Exito");</script>';
            print "<script>window.setTimeout(function() { window.location = '/productos_parcial2/index.php' }, 1);</script>";
        }else{
            echo"Error" . $sql . "<br>".$db_conexion ->close();

        }

    }

?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>