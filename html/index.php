<?php
// Definir las variables con vadenas vacias
$nameErr = $emailErr =  $cmpErr = "";
$name = $email = $cmp = "";
$ans = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$sum = 0;
$result = array("Privada", "Publica", "Hibrida");
$ansres = $result[0];
	
//Llamamos a la conexion a la base de datos 
require('./../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
  if (empty($_GET["fname"])) {    
	  $nameErr = "El nombre es requerido";
  } else {
    $fname = test_input($_GET["fname"]);
    $last = test_input($_GET['lname']);
    $name = $fname.' '.$last;
  }
  
  if (empty($_GET["eaddress"])) {
    $emailErr = "El correo es requerido";
  } else {
    $email = test_input($_GET["eaddress"]);
    // Verificar si es un correo correcto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de correo no válido";
    }
  }

  if (empty($_GET["title"])) {
    $cmp = "";
  } else {
    $cmp = test_input($_GET["title"]);
  }

  if(!empty($_GET["question1"])){
    $ans = array();
    for($i=0;$i<14;$i++){
      $ans[$i] = $_GET["question".$i+1];
      $sum += $ans[$i];
    }
    if($sum>=14 && $sum<= 23){
      $ansres = $result[2];
    }
    else if($sum>=24 && $sum<= 28){
      $ansres = $result[2];
    }
    else if($sum>28){
      $ansres = $result[0];
    }
  }

  if($name != "" && $ans[0] != 0){
	$sql = "INSERT INTO empresa(user, company, mail, Res1, Res2, Res3, Res4, Res5, Res6, Res7, Res8, Res9, Res10, Res11, Res12, Res13, Res14, ResSumTot, result) VALUES
    	('".$name."', '".$cmp."', '".$email."','".$ans[0]."','".$ans[1]."','".$ans[2]."','".$ans[3]."','".$ans[4]."','".$ans[5]."','".$ans[6]."','".$ans[7]."','".$ans[8]."','".$ans[9]."','".$ans[10]."','".$ans[11]."','".$ans[12]."','".$ans[13]."','".$sum."','".$ansres."')";
  echo $sql;
	if ($conn->query($sql) === TRUE) {
    	header('Location: search?q=Registro hecho correctamente&ml='.$email);
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
  }

// Cerrar la conexión.
$conn->close();
}
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tipo de nube que eres</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="testbox">
      <form action="index" method="get">
        <div class="banner">
          <h1>Contesta esta encuesta y descubre que tipo de nube necesita tu negocio</h1>
        </div>
        <br/>
        <p>
        <center>Contesta la encuesta para descubrir que tipo de nube necesitas en tu empresa, si ya haz contestado previamente puedes consultar <a href="./search"> tus resultados aqui </a>
        </center>
        </p>
        <br/>
        <div class="colums">
          <div class="item">
            <label for="fname">Nombre<span>*</span></label>
            <input id="fname" type="text" name="fname" required/>
          </div>
          <div class="item">
            <label for="lname">Apellido<span>*</span></label>
            <input id="lname" type="text" name="lname" required/>
          </div>
          <div class="item">
            <label for="title">Empresa<span>*</span></label>
            <input id="title" type="text" name="title" required/>
          </div>
          <div class="item">
            <label for="eaddress">Email<span>*</span></label>
            <input id="eaddress" type="text"   name="eaddress" required/>
          </div>
        </div>
        <div class="question">
          <label>1.¿Estás dispuesto a administrar tus propios servidores? (Opción única).</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_1" name="question1"/>
              <label for="radio_1" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_2" name="question1"/>
              <label for="radio_2" class="radio"><span>Probablemente</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_3" name="question1"/>
              <label for="radio_3" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>2.¿Dispones de suficientes recursos para iniciar tus servidores?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_4" name="question2"/>
              <label for="radio_4" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_5" name="question2"/>
              <label for="radio_5" class="radio"><span>Suficiente para uno basico</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_6" name="question2"/>
              <label for="radio_6" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>3.¿El uso de tu nube sería de una comunidad u organización para lograr un fin común?Opción única. </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_7" name="question3"/>
              <label for="radio_7" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_8" name="question3"/>
              <label for="radio_8" class="radio"><span>Probablemente</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_9" name="question3"/>
              <label for="radio_9" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>4.¿Te gustaría que tu Nube tuviera propiedades  exclusivas?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_10" name="question4"/>
              <label for="radio_10" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_11" name="question4"/>
              <label for="radio_11" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>5.¿Sabes como administrar servidores?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_12" name="question5"/>
              <label for="radio_12" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_13" name="question5"/>
              <label for="radio_13" class="radio"><span>Cosas basicas</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_14" name="question5"/>
              <label for="radio_14" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>6.¿Te parece relevante que tarde menos tiempo en comunicarse con los equipos?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_15" name="question6"/>
              <label for="radio_15" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_16" name="question6"/>
              <label for="radio_16" class="radio"><span>Probablemente</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_17" name="question6"/>
              <label for="radio_17" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>7.¿Requieres de escalar tus servicios rápidamente?Opción única. </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_18" name="question7"/>
              <label for="radio_18" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_19" name="question7"/>
              <label for="radio_19" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>8.¿Te preocupa la seguridad de tu información y servicios?Opción única. </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_20" name="question8"/>
              <label for="radio_20" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_21" name="question8"/>
              <label for="radio_21" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>9.¿Quieres tener tu propio centro de datos?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_22" name="question9"/>
              <label for="radio_22" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_23" name="question9"/>
              <label for="radio_23" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>10.¿Te gustaría que tú modelo fuera extremadamente flexible y escalable?Opción única. </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_24" name="question10"/>
              <label for="radio_24" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_25" name="question10"/>
              <label for="radio_25" class="radio"><span>Si, pero no mucho</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_26" name="question10"/>
              <label for="radio_26" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>11.¿Te gustaría trabajar con proyectos grandes?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_27" name="question11"/>
              <label for="radio_27" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_28" name="question11"/>
              <label for="radio_28" class="radio"><span>Aveces</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_29" name="question11"/>
              <label for="radio_29" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>12.¿Estas dispuesto a que el usuario pueda acceder a los servicios y gestionar los componentes alquilados a través de internet?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_30" name="question12"/>
              <label for="radio_30" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_31" name="question12"/>
              <label for="radio_31" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>13.¿Quieres que tu nube incluya cargas de trabajo perimetrales?</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_32" name="question13"/>
              <label for="radio_32" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_33" name="question13"/>
              <label for="radio_33" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>14.¿Estas dispuesta que los usuarios y las organizaciones afecten el rendimiento? Opción única. </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="3" id="radio_34" name="question14"/>
              <label for="radio_34" class="radio"><span>Si</span></label>
            </div>
            <div>
              <input  type="radio" value="2" id="radio_35" name="question14"/>
              <label for="radio_35" class="radio"><span>Pueede que si</span></label>
            </div>
            <div>
              <input  type="radio" value="1" id="radio_36" name="question14"/>
              <label for="radio_36" class="radio"><span>No</span></label>
            </div>
          </div>
        </div>
        <div class="btn-block">
          <input type="submit" value="Enviar"></input>
        </div>
      </form>
    </div>
  </body>
</html>