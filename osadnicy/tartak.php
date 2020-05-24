<?php

	session_start();
	
	if(!isset($_POST['tartak_in']))
	{
		//header('Location: gra.php');
	//	exit();
	}
	
	$_SESSION['brak_drewna'] = 2;
	
	
	
	$dataczas = new DateTime();

	echo "Praca Praca! <br />";
	echo "Drewno : ".$_SESSION['drewno']."</br></br>";	

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
		
		$_SESSION['drewno_flaga'] = 1;

	
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
					$cos->free_result();
				
				//$_SESSION['koniec_drewno'] = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']);
				
				$polaczenie->close();
				header('Location:tartak.php');
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
</head>

<body>
	

	
	<form method=post name="wycinka">
	
		<input type="hidden" name ="wycinka2" >
		<input type="submit" value ="Wyślij robotników do lasu!">
	
	</form>

<?php	
	if($_SESSION['drewno_flaga']==1)
	{
	$dataczas = new DateTime();	// czas obecny
	$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']); // czas ostatniego wydobycia
	$koniec->modify('+2 minutes');
	
	$roznica = $dataczas->diff($koniec);
	if($dataczas<$koniec)
	echo "Kolejny wyrąb możliwy za: ".$roznica->format(' %i min, %s sek </br></br>');	
		
	echo "Poszli my do lasu, narobili my hałasu!</br>";
	echo "Wyrąbano ". $_SESSION['wyrabane_drewno'] . " kłód drewna. </br> </br> ";
	
	echo "Data kolejnego wyrębu drewna ".$koniec->format('Y-m-d H:i:s')."</br></br>";
	}
?>	
	
	
	<form method=post action="gra.php" name="tartak_out" >

	<input type="submit" value="Wyjdź z Tartaku" />
	
	</form>

<?php
	$dataczas = new DateTime();
	echo "Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."<br>";
	

			
			//	S_SESSIOn['wyrobdrewna']   - zmienna trzymajaca czas ostatniej budowy
			
			
	//$roznica = $_SESSION['wyrobdrewna']->diff($koniec);
			
			
			
			//if($_SESSION['wyrobdrewna']<$koniec)
		//	echo "Pozostało premium: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');

			
	
?>















</body>
</html>