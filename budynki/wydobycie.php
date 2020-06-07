<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


	// połączenie zeby updatowac dane
	require_once "../connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);

	try
	{
		//połączenie się z baza danych mysql
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else// no i tu soczek :D
		{
			// KAMIENIOŁOM	
			if(isset($_POST['kopanie']))
			{
				$czas_obecny = new DateTime();
				$czas_ostatniego_wykopu =  DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobkamienia']);
				$czas_ostatniego_wykopu->modify('+2 minutes');
				$_SESSION['roznica_czasu_kamien'] = $czas_obecny->diff($czas_ostatniego_wykopu);

				if($czas_ostatniego_wykopu < $czas_obecny)
				{

					$_SESSION['wykopany_kamien'] = rand(40, 60);
					$wykopany_kamien = $_SESSION['wykopany_kamien'];
					$login = $_SESSION['user'];
					
					//aktualizacja wykopanego kamieniaw bazie danych
					$sql_dodaj_kamien = "UPDATE uzytkownicy SET kamien=kamien+$wykopany_kamien WHERE user = '$login' ";
					$polaczenie->query($sql_dodaj_kamien);
					
					//aktualizacja daty ostatniego wyrąbu w bazie danych
					$wyrobkamienia= new DateTime();		
					$sql_dodaj_wyrobkamienia = "UPDATE uzytkownicy SET wyrobkamienia='{$wyrobkamienia->format('Y-m-d H:i:s')}' WHERE user='$login' ";
					$polaczenie->query($sql_dodaj_wyrobkamienia);
					
					// aktualizacja wybąbanego drewna w zmiennej sesyjnej
					$sql_pobierz_kamien = "SELECT * FROM uzytkownicy WHERE user = '$login'";
					$cos = $polaczenie->query($sql_pobierz_kamien);
					$wiersz = $cos->fetch_assoc();
					$_SESSION['kamien'] = $wiersz['kamien'];

					//aktualizacja date ostatniego wyrąbu w zmiennej sesyjnej
					$_SESSION['wyrobkamienia'] = $wiersz['wyrobkamienia'];
					
						
						
					//$_SESSION['koniec_drewno'] = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']);
						
					

				}
				else
				{
					$_SESSION['niekopano'] = 1;
				}
				
				header('Location:kamieniolom.php');
				$polaczenie->close();
				exit();

			}
			else
			{
				header('Location:../gra.php');
			}
			
			// TARTAK
			if(isset($_POST['wycinka']))
			{
				$czas_obecny = new DateTime();
				$czas_ostatniej_wycinki =  DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']);
				$czas_ostatniej_wycinki->modify('+2 minutes');
				$_SESSION['roznica_czasu_drewno'] = $czas_obecny->diff($czas_ostatniej_wycinki);

				if($czas_ostatniej_wycinki < $czas_obecny)
				{

					$_SESSION['wyrabane_drewno'] = rand(40, 60);
					$wyrabane_drewno = $_SESSION['wyrabane_drewno'];
					$login = $_SESSION['user'];
					
					//aktualizacja wykopanego kamieniaw bazie danych
					$sql_dodaj_drewno = "UPDATE uzytkownicy SET drewno=drewno+$wyrabane_drewno WHERE user = '$login' ";
					$polaczenie->query($sql_dodaj_drewno);
					
					//aktualizacja daty ostatniego wyrąbu w bazie danych
					$wyrobdrewna= new DateTime();		
					$sql_dodaj_wyrobdrewna = "UPDATE uzytkownicy SET wyrobdrewna='{$wyrobdrewna->format('Y-m-d H:i:s')}' WHERE user='$login' ";
					$polaczenie->query($sql_dodaj_wyrobdrewna);
					
					// aktualizacja wybąbanego drewna w zmiennej sesyjnej
					$sql_pobierz_drewno = "SELECT * FROM uzytkownicy WHERE user = '$login'";
					$cos = $polaczenie->query($sql_pobierz_drewno);
					$wiersz = $cos->fetch_assoc();
					$_SESSION['drewno'] = $wiersz['drewno'];

					//aktualizacja date ostatniego wyrąbu w zmiennej sesyjnej
					$_SESSION['wyrobdrewna'] = $wiersz['wyrobdrewna'];
					
						
						
					//$_SESSION['koniec_drewno'] = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['wyrobdrewna']);
						
					

				}
				else
				{
					$_SESSION['nierabano'] = 1;
				}
				
				header('Location:tartak.php');
				$polaczenie->close();
				exit();

			}
			else
			{
				header('Location:../gra.php');
			}
			
			
		$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br />Informacja developerska: '.$e;
	}
	


	
?>



