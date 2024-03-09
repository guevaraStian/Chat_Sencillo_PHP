<!--
Aplicacion de chat de manera sencilla

-->


<?php
session_start();

function createForm(){
?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table align="center">
          <tr><td colspan="2">Por favor, Ingrese su nombre para iniciar sesión!</td></tr>
          <tr><td>Tu nombre: </td>
          <td><input class="text" type="text" name="nombre" /></td></tr>
          <tr><td colspan="2" align="center">
             <input class="text" type="submit" name="submitBtn" value="Login" />
          </td></tr>
        </table>
      </form>
<?php
}

if (isset($_GET['u'])){
   unset($_SESSION['nombre_nick']);
}

// Procesar información de inicio de sesión
if (isset($_POST['submitBtn'])){
      $nombre_nick    = isset($_POST['nombre']) ? $_POST['nombre'] : "Unnamed";
      $_SESSION['nombre_nick'] = $nombre_nick;
}

$nombre_nick = isset($_SESSION['nombre_nick']) ? $_SESSION['nombre_nick'] : "Hidden";   
?>

<!DOCTYPE >
<html>
<head>
   <title>Chat Sencillo </title>
   <link href="css/style.css" rel="stylesheet" type="text/css" />
   <link href="/css/globe.png" rel="shortcut icon">
    <script language="javascript" type="text/javascript">
    <!--
      var httpObject = null;
      var link = "";
      var timerID = 0;
      var nombre_nick = "<?php echo $nombre_nick; ?>";

      // Obtener el objeto HTTP
      function getHTTPObject(){
         if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
         else if (window.XMLHttpRequest) return new XMLHttpRequest();
         else {
            alert("Tu navegador no soporta AJAX.");
            return null;
         }
      }   

      // Cambiar el valor del campo outputText
      function setOutput(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML += response;
            objDiv.scrollTop = objDiv.scrollHeight;
            var inpObj = document.getElementById("msj");
            inpObj.value = "";
            inpObj.focus();
         }
      }

      // Cambiar el valor del campo outputText
      function setAll(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML = response;
            objDiv.scrollTop = objDiv.scrollHeight;
         }
      }

      // Implementar la lógica 
      function doWork(){    
         httpObject = getHTTPObject();
         if (httpObject != null) {
            link = "mensaje.php?nick="+nombre_nick+"&msj="+document.getElementById('msj').value;
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setOutput;
            httpObject.send(null);
         }
      }

      // Implementar la lógica   
      function doReload(){    
         httpObject = getHTTPObject();
         var randomnumber=Math.floor(Math.random()*10000);
         if (httpObject != null) {
            link = "mensaje.php?all=1&rnd="+randomnumber;
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setAll;
            httpObject.send(null);
         }
      }

      function UpdateTimer() {
         doReload();   
         timerID = setTimeout("UpdateTimer()", 5000);
      }
    
    
      function keypressed(e){
         if(e.keyCode=='13'){
            doWork();
         }
      }
    //-->
    </script>   
</head>

   
<center><div id="logo">&nbsp;</div></center><br>
   
   <body onload="UpdateTimer();">
    <div id="main">
      <div id="titulo_aplicacion">Chat Sencillo </div>
      <div id="icon">&nbsp;</div>
<?php 

if (!isset($_SESSION['nombre_nick']) ){ 
    createForm();
} else  { 
      $nombre    = isset($_POST['nombre']) ? $_POST['nombre'] : "Unnamed";
      $_SESSION['nombre_nick'] = $nombre;
    ?>
      
     <div id="result">
     <?php 
        $data = file("mensajechat.html");
        foreach ($data as $line) {
        	echo $line;
        }
     ?>
      </div>
      <div id="areaenvio" onkeyup="keypressed(event);">
         Mensaje: <input type="text" name="msj" size="30" id="msj" />
         <button onclick="doWork();">Enviar</button>
      </div>   
<?php            
    }

?>
    </div>
</body>   