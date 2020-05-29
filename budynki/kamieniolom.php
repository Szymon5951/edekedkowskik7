<?php
	session_start();
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Osadnicy - gra przeglądarkowa</title>
	
	
</head>
<body>
	
	Praca Praca ! </br></br>

    <b>Kamień</b>: <?php echo $_SESSION['kamien']?> </br></br>
		
	<form method="post" action="wydobycie.php">

		<input type="hidden" name ="kopanie" >
		<input type="submit" value ="Wyślij robotników po kamszoty!">
	
	</form>
	</br>
	
<?php	
	if(isset($_SESSION['wykopany_kamien']))
	{
		echo "Robotnicze chopy my są! Kamień podśpiewując kopią! </br>";
		echo "Wykopano ". $_SESSION['wykopany_kamien']. " kamienia. </br></br></br>";
		unset($_SESSION['wykopany_kamien']);
	}
	if(isset($_SESSION['niekopano']))
	{
		echo "Nie no prosze kapitana, kilof rozdupcony - kolana przetarte! </br>";
		echo "Przerwa powiadamy!</br></br>"	;
		echo "Kolejny raz możliwy za: ". $_SESSION['roznica_czasu_kamien']->format(' %i min, %s sek ')."</br></br>";
		
		unset($_SESSION['niekopano']);
	}
?>	

	
	<form method="post" action="../gra.php"  >
		<input type="submit" value="Wyjdź z Kamieniołomu" />
	</form>
	</br>


<?php
	$dataczas = new DateTime();
	echo "Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."<br>";
?>




</body>
</html>