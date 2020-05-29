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

	Zug Zug ! </br></br>

    <b>Drewno</b>: <?php echo $_SESSION['drewno']?> </br></br>
	
	<form method="post" action="wydobycie.php" >
	
		<input type="hidden" name ="wycinka" >
		<input type="submit" value ="Wyślij robotników do lasu!">
	
	</form>
	</br>

<?php	
	if(isset($_SESSION['wyrabane_drewno']))
	{
		echo "Poszli my do lasu, narobili my hałasu!</br>";
		echo "Wyrąbano ". $_SESSION['wyrabane_drewno'] . " kłód drewna. </br> </br> ";
		unset($_SESSION['wyrabane_drewno']);
	}
	if(isset($_SESSION['nierabano']))
	{
		echo "Dopiero co my tu karczówkę odwalali! </br>";
		echo "Teraz to my piwo dopijają - odpoczynek zasłuzony zażywają!!</br></br>";
		echo "Kolejny wyrąb możliwy za: ". $_SESSION['roznica_czasu_drewno']->format(' %i min, %s sek ')."</br></br>";
		
		unset($_SESSION['nierabano']);
	}
?>	
	
	
	<form method="post" action="../gra.php"  >
		<input type="submit" value="Wyjdź z Tartaku" />
	</form>
	</br>

<?php
	$dataczas = new DateTime();
	echo "Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."<br>";
?>


</body>
</html>