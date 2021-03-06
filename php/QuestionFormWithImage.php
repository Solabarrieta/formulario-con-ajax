<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <style>
          .imgPrev {
            display: block;
            width: auto;
            height: 100%;
          }
        </style>
        <?php if (isset($_GET['correo'])){ ?>
          <form id="fquestion" name="fquestion" action="AddQuestionWithImage.php?correo=<?php echo $_GET["correo"]; ?>" enctype="multipart/form-data"  method = "POST" onsubmit = "return validacion()" actionstyle="width: 60%; margin: 0px auto;">
        <?php }else{ ?>  
          <form id="fquestion" name="fquestion" action="AddQuestionWithImage.php" enctype="multipart/form-data"  method = "POST" onsubmit = "return validacion()" actionstyle="width: 60%; margin: 0px auto;">
        <?php }?> 
        <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
            <caption style="text-align:left">
              <h2>Pregunta para el quiz</h2> 
            </caption>
            <tr>
              <td align="right">Dirección de correo (*): </td>
              <?php if (isset($_GET['correo'])){                                           
                echo '<td align="left"><input type="text" id="correo" name="correo" autofocus value ="'.$_GET["correo"].'"></td>';
               }else{ ?>  
                <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
              <?php }?>
            </tr>
            <tr>
              <td align="right">Enunciado de la pregunta (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="enun" name="enun" autofocus placeholder="Ej: Elemento HTML para añadir una tabla"></td>
            </tr>
            <tr>
              <td align="right">Respuesta correcta (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="correct" name="correct" autofocus placeholder="Ej: <TABLE>"></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 1 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc1" name="inc1" autofocus></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 2 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc2" name="inc2" autofocus></td>
            </tr>
            <tr>
              <td align="right">Respuesta incorrecta 3 (*): </td>
              <td align="left"><input style="width: 600px;" type="text" id="inc3" name="inc3" autofocus></td>
            </tr>
            <tr>
              <td align="right">Complejidad: </td>
              <td align="left">
                <select name="dif" id="dif" form="fquestion">
                  <option value="1">1 - Baja</option>
                  <option value="2">2 - Media</option>
                  <option value="3">3 - Alta</option>
                </select> 
              </td>
            </tr>
            <tr>
              <td align="right">Tema (*): </td>
              <td align="left"><input type="text" id="tema" name="tema" autofocus></td>
            </tr>
            <tr>
              <td align="right">Imagen: </td>
              <td align="left"><input id="subirImagen" name="subirImagen" type="file" onchange="" accept="image/png, image/jpeg"></td>
            </tr>
            <tr>
              <td></td>
              <td align ="left"><img id="preview" name="preview"  class="imgPreview" src="" height="200"></td>
            </tr>
            <tr>
            <td></td>
              <td align ="left"><button type="button" id="borrarImagen" name="borrarImagen">Borrar Imagen</button></td>    
            </tr>
            <tr>
            <td></td>
              <td align="left"><input type="submit" id="botonPreg" name="botonPreg" value="Enviar solicitud"></button></td>
            </tr>
          </table>
        </form>
    </div>
  </section>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <script type="text/javascript" src="../js/RemoveImageInForm.js"></script>
  <!-- <script type="text/javascript" src="../js/ValidateFieldsQuestionJQ.js"></script> -->
  <?php include '../html/Footer.html' ?>
</body>
</html>
