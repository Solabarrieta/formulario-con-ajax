<div id='page-wrap'>
<header class='main' id='h1'>
<?php if(!isset($_GET['correo'])){ ?>

  
  <span class="right"><a href="SignUp.php">Registro</a></span>
  <span class="right"><a href="LogIn.php">Login</a></span>
  <?php }else{ ?>
  <span class="right"><a href="LogOut.php">Logout</a><?php echo ' '.$_GET['correo']?></span>
  <?php } ?>

</header>
<nav class='main' id='n1' role='navigation'>
  <?php if(isset($_GET['correo'])){ ?>
  <span><a href="Layout.php?correo=<?php echo $_GET["correo"]; ?>"> Inicio</a></span>
  <span><a href="Credits.php?correo=<?php echo $_GET["correo"]; ?>">Creditos</a></span>
  <span><a href="QuestionFormWithImage.php?correo=<?php echo $_GET["correo"]; ?>"> Insertar Pregunta </a></span>
  <span><a href="ShowQuestionsWithImage.php?correo=<?php echo $_GET["correo"]; ?>"> Ver Preguntas </a></span>
  <span><a href="ShowXMLQuestionsWithImage.php?correo=<?php echo $_GET["correo"]; ?>"> Ver Preguntas XML</a></span>
  <span><a href="ShowJsonQuestionsWithImage.php?correo=<?php echo $_GET["correo"]; ?>"> Ver Preguntas JSON</a></span>

  <?php }else { ?>
  <span><a href="Layout.php"> Inicio</a></span>
  <span><a href="Credits.php">Creditos</a></span>
  <?php }?>
   
</nav>

<!--<script type="text/javascript" src="../js/todos.js"></script>-->