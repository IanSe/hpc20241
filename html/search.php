<?php
require('./../conn/conn.php');
$name = $company = $mail = $result = "";
$ans = $resps = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$control = 0;

if (empty($_GET["ml"])) {
    $control = 1;
}else{
    $control = 2;
    $mail = $_GET["ml"];
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo 'MAIL NO VALIDO';
    }else if($conn->query("SELECT * FROM `empresa` WHERE `mail` = '$mail'")){
      $resultado = $conn->query("SELECT * FROM `empresa` WHERE `mail` = '$mail'");
      $resultado->data_seek(0);

      while($fila = $resultado->fetch_assoc())
      {
          $name = $fila['user'];
          $company = $fila['company'];
          $ans[0] = $fila['Res1'];
          $ans[1] = $fila['Res2'];
          $ans[2] = $fila['Res3'];
          $ans[3] = $fila['Res4'];
          $ans[4] = $fila['Res5'];
          $ans[5] = $fila['Res6'];
          $ans[6] = $fila['Res7'];
          $ans[7] = $fila['Res8'];
          $ans[8] = $fila['Res9'];
          $ans[9] = $fila['Res10'];
          $ans[10] = $fila['Res11'];
          $ans[11] = $fila['Res12'];
          $ans[12] = $fila['Res13'];
          $ans[13] = $fila['Res14'];
          $result = $fila['result'];
          
      }
      for($i=0;$i<14;$i++){
        if($ans[$i] == 3){
            $resps[$i] = 'Si';
        }
        if($ans[$i] == 2){
            $resps[$i] = 'Probablemente';
        }
        if($ans[$i] == 1){
            $resps[$i] = 'No';
        }
      }
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Resultados</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="testbox">
      <form action="search" method="get">
        <div class="banner">
            <?php if($control == 1): ?>
                <h1>Escribe por favor el correo que usaste para buscar tus resultados, en caso de no encontrarlos seras redireccionado al form de nuevo para volver a hacerlo</h1>
            <?php elseif($control != 0 && $control != 0): ?> 
                <h1>Hola <?= $name ?> a continuacion te mostraremos tus resultados
                Segun los datos que pusiste determinamos que el tipo de arquitectura que necesita tu empresa es <b><?= $result ?></b></h1>
            <?php endif; ?> 
        </div>
        <br/>
        <p>
        <center>
        <?php if($control == 1): ?>
            <div class="item">
                <label for="ml">Mail<span>*</span></label>
                <input id="ml" type="text" name="ml"/>
            </div>
            <div class="btn-block">
                <input type="submit" value="Buscar"></input>
            </div>
            <?php elseif($control != 1 && $control != 0): ?> 
                Aqui se muestra la hoja de respuesta que contestaste 
            <?php endif; ?> 
        </center>
        </p>
        <br/>
        <?php if($control != 1 && $control != 0): ?>
        <div class="question">
          <label>1.¿Estás dispuesto a administrar tus propios servidores? (Opción única).</label>
          <div class="question-answer">
            <div>
              <input disabled checked type="radio" value="3" id="radio_1" name="question1"/>
              <label for="radio_1" class="radio"><span><?= $resps[0] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>2.¿Dispones de suficientes recursos para iniciar tus servidores?</label>
          <div class="question-answer">
            <div>
              <input disabled checked type="radio" value="3" id="radio_2" name="question2"/>
              <label for="radio_1" class="radio"><span><?= $resps[1] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>3.¿El uso de tu nube sería de una comunidad u organización para lograr un fin común?Opción única. </label>
          <div class="question-answer">
            <div>
              <input disabled checked type="radio" value="3" id="radio_3" name="question3"/>
              <label for="radio_1" class="radio"><span><?= $resps[2] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>4.¿Te gustaría que tu Nube tuviera propiedades  exclusivas?</label>
          <div class="question-answer">
            <div>
              <input disabled checked type="radio" value="3" id="radio_4" name="question4"/>
              <label for="radio_1" class="radio"><span><?= $resps[3] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>5.¿Sabes como administrar servidores?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_12" name="question5"/>
              <label for="radio_12" class="radio"><span><?= $resps[4] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>6.¿Te parece relevante que tarde menos tiempo en comunicarse con los equipos?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_15" name="question6"/>
              <label for="radio_15" class="radio"><span><?= $resps[5] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>7.¿Requieres de escalar tus servicios rápidamente?Opción única. </label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_18" name="question7"/>
              <label for="radio_18" class="radio"><span><?= $resps[6] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>8.¿Te preocupa la seguridad de tu información y servicios?Opción única. </label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_20" name="question8"/>
              <label for="radio_20" class="radio"><span><?= $resps[7] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>9.¿Quieres tener tu propio centro de datos?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_22" name="question9"/>
              <label for="radio_22" class="radio"><span><?= $resps[8] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>10.¿Te gustaría que tú modelo fuera extremadamente flexible y escalable?Opción única. </label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_24" name="question10"/>
              <label for="radio_24" class="radio"><span><?= $resps[9] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>11.¿Te gustaría trabajar con proyectos grandes?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_27" name="question11"/>
              <label for="radio_27" class="radio"><span><?= $resps[4] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>12.¿Estas dispuesto a que el usuario pueda acceder a los servicios y gestionar los componentes alquilados a través de internet?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_30" name="question12"/>
              <label for="radio_30" class="radio"><span><?= $resps[4] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>13.¿Quieres que tu nube incluya cargas de trabajo perimetrales?</label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_32" name="question13"/>
              <label for="radio_32" class="radio"><span><?= $resps[4] ?></span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>14.¿Estas dispuesta que los usuarios y las organizaciones afecten el rendimiento? Opción única. </label>
          <div class="question-answer">
            <div>
              <input  disabled checked type="radio" value="3" id="radio_34" name="question14"/>
              <label for="radio_34" class="radio"><span><?= $resps[4] ?></span></label>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </form>
    </div>
  </body>
</html>