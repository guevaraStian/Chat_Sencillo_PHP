<?php 
	if (isset($_GET['msj'])){
		if (file_exists('mensajechat.html')) {
		   $f = fopen('mensajechat.html',"a+");
		} else {
		   $f = fopen('mensajechat.html',"w+");
		}
      $nick = isset($_GET['nick']) ? $_GET['nick'] : "Hidden";
      $msj = isset($_GET['msj']) ? htmlspecialchars($_GET['msj']) : ".";
      $line = "<p><span class=\"nombre\">$nick: </span><span class=\"txt\">$msj</span></p>";
		fwrite($f,$line."\r\n");
		fclose($f);
		
		echo $line;
		
	} else if (isset($_GET['all'])) {
	   $flag = file('mensajechat.html');
	   $content = "";
	   foreach ($flag as $value) {
	   	$content .= $value;
	   }
	   echo $content;

	}
?>	
