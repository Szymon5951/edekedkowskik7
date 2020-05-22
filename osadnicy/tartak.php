<?php

	session_start();

	
	
	if(!isset($_POST['tartak_in']))
	{
		//header('Location: gra.php');
	//	exit();
	}
	
	
	
	
	$dataczas = new DateTime();

	echo "Praca Praca! <br />";


	if(isset($_POST['drewno_flaga']))
	{
		$_SESSION['drewno_flaga'] = 0;	
	}


	if(isset($_POST['wycinka2']))
	{
	//	echo "Poszli my do lasu, narobili my hałasu!</br></br>";
		$_SESSION['wyrabane_drewno'] = rand(1, 100);
	//	echo "Wyrąbano ". $wyrabane_drewno ." kłód drewna. </br> </br> ";
		unset($_POST['wycinka2']);
		


	
		// połączenie zeby updatowac wartosc drewna i godzine ostatniego wyrębu
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
	
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
						
				
				// jezeli nie minely jeszcze dwie minuty
				
				$czas_obecny = new DateTime();
				echo "czas obecny: ".$czas_obecny->format('Y-m-d H:i:s')."<br>";
				
				$czas_ostatniego_wyrabu =  DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']); // czas ostatniego wydobycia
				echo "czas ostatniego wyrabu: ".$czas_ostatniego_wyrabu->format('Y-m-d H:i:s')."<br>";
				$czas_ostatniego_wyrabu->modify('+2 minutes');
				
				$roznica_czasu = $czas_obecny->diff($czas_ostatniego_wyrabu);
				
				if($czas_ostatniego_wyrabu < $czas_obecny)
				{
					$_SESSION['drewno_flaga'] = 1;
					
					$login = $_SESSION['user'];
					
					$wyrabane_drewno = $_SESSION['wyrabane_drewno'];
					
					//aktualizacja wyrabanego drewna w bazie danych
					$sql_dodaj_drewno = "UPDATE uzytkownicy SET drewno=drewno+$wyrabane_drewno WHERE user = '$login' ";
					$polaczenie->query($sql_dodaj_drewno);
				
					//aktualizacja daty ostatniego wyrąbu w bazie danych
					$koniec = new DateTime();		
					$sql_dodaj_wyrobdrewna = "UPDATE uzytkownicy SET wyrobdrewna='{$koniec->format('Y-m-d H:i:s')}' WHERE user='$login' ";
					$polaczenie->query($sql_dodaj_wyrobdrewna);
				


					// aktualizacja wybąbanego drewna w zmiennej sesyjnej
					$sql_pobierz_drewno = "SELECT * FROM uzytkownicy WHERE user = '$login'";
					$cos = $polaczenie->query($sql_pobierz_drewno);
					$wiersz = $cos->fetch_assoc();
					$_SESSION['drewno'] = $wiersz['drewno'];

					//aktualizacja date ostatniego wyrąbu w zmiennej sesyjnej
					$_SESSION['wyrobdrewna'] = $wiersz['wyrobdrewna'];
				
					// sexi :D 

					
					//$_SESSION['koniec_drewno'] = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']);
					
					$polaczenie->close();
					//header('Location:tartak.php');
				}
				else
				{
					echo " </br>Dopiero co my tu karczówkę odwalali! </br>";
					echo " Teraz to my piwo dopijają - odpoczynek zasłuzony zażywają! </br></br> ";
				}
				
					echo "Drewno : ".$_SESSION['drewno']."</br></br>";	
				
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

	}
	




	
	

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Osadnicy - gra przeglądarkowa</title>
	

	
	
	<script type="text/javascript" src="timer.js">
		
	
	</script>
	
	
</head>

<body onload="odliczanie();">
	

	
	<form method="post" name="wycinka">
	
		<input type="hidden" name ="wycinka2" >
		<input type="submit" value ="Wyślij robotników do lasu!">
	
	</form>

<?php	

	$dataczas = new DateTime();	// czas obecny
	$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']); // czas ostatniego wydobycia
	$koniec->modify('+2 minutes');
	
	$roznica = $dataczas->diff($koniec);
	
	
	if($dataczas<$koniec)
	echo "Kolejny wyrąb możliwy za: ".$roznica->format(' %i min, %s sek </br></br>');	

	if($_SESSION['drewno_flaga']==1)
	{	
	echo "Poszli my do lasu, narobili my hałasu!</br>";
	echo "Wyrąbano ". $_SESSION['wyrabane_drewno'] . " kłód drewna. </br> </br> ";
	
	echo "Data kolejnego wyrębu drewna ".$koniec->format('Y-m-d H:i:s')."</br></br>";
	$_SESSION['drewno_flaga']=0;
	}
?>	
	
	
	



	
	<form method="post" action="gra.php" name="tartak_out" >
		<input type="submit" value="Wyjdź z Tartaku" />
	</form>

<?php
	$dataczas = new DateTime();
	echo "Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."<br>";
?>















</body>
</html>