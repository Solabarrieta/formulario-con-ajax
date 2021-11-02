      <?php
        $errorCount = 0;

        //Inicializamos las variables que van a contener la información enviada por el formulario de login
        $correo = ""; 
        $enun = "";
        $correct = "";
        $inc1 = "";
        $inc2 = "";
        $inc3 = "";
        $compl = "";
        $tema = "";
        //var_dump($_POST);
        //die(print_r($_POST,1));
        //if (isset($_POST['botonPreg'])){ //Si se ha pulsado el submit con nombre "botonPreg" se comienza a procesar el formulario

          
          $correo = $_POST['correo']; 
          $enun = $_POST['enun'];
          $correct = $_POST['correct'];
          $inc1 = $_POST['inc1'];
          $inc2 = $_POST['inc2'];
          $inc3 = $_POST['inc3'];
          $compl = $_POST['dif'];
          $tema = $_POST['tema'];
          $imagen_nombre = $_FILES['subirImagen']['name'];
          $imagen_loc_tmp = $_FILES['subirImagen']['tmp_name']; //El directorio temporal donde está la imagen al subirla mediante el formulario.
          $nombre_imagen_separado = explode(".", $imagen_nombre); //Separamos el nobmre de la imagen para obtener su extensión.
          $imagen_extension = strtolower(end($nombre_imagen_separado)); //Cogemos la extensión.
          $nuevo_nombre_imagen = md5(time() . $imagen_nombre) . '.' . $imagen_extension; //Se le da un nombre único a la imagen que se va a guardar en el servidor.
          $imagen_dir = "../images/".$nuevo_nombre_imagen; //La base de datos guardará los directorios de las imagenes en el servidor.

          //Validación en servidor 
          $er = "/^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/";
          $er2 = "/^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/";
          $er3 = "/^[a-zA-Z]+@ehu\.(eus|es)$/";
          if($correo == ""){
            $errorCount += 1;
            echo"correo incorrecto";
          }
          else if(!(preg_match($er,$correo) || preg_match($er2,$correo) || preg_match($er3,$correo))){
            $errorCount += 1;
          }
          else if($enun == '') {
            $errorCount += 1;
          }
          else if(strlen($enun) < 10){
              $errorCount += 1;
          }
          else if($correct == '') {
              $errorCount += 1;
          }
          else if($inc1 == '') {
              $errorCount += 1;
          }
          else if($inc2 == '') {
              $errorCount += 1;
          }
          else if($inc3 == '') {
              $errorCount += 1;;
          }
          else if($compl == '') {
            $errorCount += 1;
          }
          else if($tema == '') {
            $errorCount += 1;
          }
          
          if($errorCount == 0){ //Si no hay errores
            /*Inserción en la base de datos.
            Conectamos con la base de datos mysql*/
            include 'DbConfig.php';
            $conn = mysqli_connect($server, $user, $pass, $basededatos);
            $conn->set_charset("utf8");

            if(!$conn){
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "INSERT INTO preguntas (correo, enun, correct, inc1, inc2, inc3, compl, tema, imagen) VALUES ('$correo', '$enun', '$correct', '$inc1', '$inc2', '$inc3', '$compl', '$tema', '$imagen_dir')";
            $anadir = mysqli_query($conn, $sql);
            if(!$anadir){
            }
            else{
              //Si se puede introducir la pregunta, entonces guardamos la imagen en el directorio images y la añadimos.
              move_uploaded_file($imagen_loc_tmp, $imagen_dir);
              //Inserción en XML.
              $xml = simplexml_load_file("../xml/Questions.xml");
              $pregunta = $xml->addChild('assesmentItem');
              $pregunta->addAttribute('subject', $tema);
              $pregunta->addAttribute('author', $correo);
              $itembody = $pregunta->addChild('itemBody');
              $itembody->addChild('p', $enun);
              $correctresponse = $pregunta->addChild('correctResponse');
              $correctresponse->addChild('response', $correct);
              $incorrectresponse = $pregunta->addChild('incorrectResponses');
              $incorrectresponse->addChild('response', $inc1);
              $incorrectresponse->addChild('response', $inc2);
              $incorrectresponse->addChild('response', $inc3);

              $domxml = new DOMDocument('1.0');
              $domxml->preserveWhiteSpace = false;
              $domxml->formatOutput = true;
              $domxml->loadXML($xml->asXML());
              $domxml->save('../xml/Questions.xml');

              //Inserción en JSON
              $json = file_get_contents('../json/Questions.json');
              $tempArr = json_decode($json);
              $arrayInc = array($inc1, $inc2, $inc3);
              $pregunta = new stdClass();
              $pregunta->subject=$tema;
              $pregunta->author=$correo;
              $pregunta->itemBody=array("p"=>$enun);
              $pregunta->correctResponse=array("value"=>$correct);
              $pregunta->incorrectResponses=array("value"=>$arrayInc);
              $preguntaarray[0] = $pregunta;
              array_push($tempArr->assessmentItems, $preguntaarray[0]);
              $jsonData = json_encode($tempArr, JSON_PRETTY_PRINT);
              file_put_contents("../json/Questions.json", $jsonData);
            }
          }
        //}	