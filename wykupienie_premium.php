<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


	if(isset($_POST['add_premium']))
	{
			// połączenie zeby updatowac nowo napisana wiadomosc 
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
					$drewno = $_SESSION['drewno'];
					
					if($drewno > 1000)
					{
						$login = $_SESSION['user'];
						
						//aktualizacja dni premium w bazie danych
						$sql_dodaj_premium = "UPDATE uzytkownicy SET dnipremium=dnipremium + INTERVAL 1 DAY WHERE user='$login'";
						$polaczenie->query($sql_dodaj_premium);

						//pobranie 1000 drewna
						$sql_pobierz_drewno = "UPDATE uzytkownicy SET drewno = drewno - 1000  WHERE user= '$login'";
						$polaczenie->query($sql_pobierz_drewno);


						// aktualizacja dni premium w zmiennej sesyjnej
						$sql_pobierz_dnipremium = "SELECT * FROM uzytkownicy WHERE user = '$login'";
						$cos = $polaczenie->query($sql_pobierz_dnipremium);
						$wiersz = $cos->fetch_assoc();
						$_SESSION['dnipremium'] = $wiersz['dnipremium'];
						// aktualizacja drewna w zmiennej sesyjnej
						$_SESSION['drewno'] = $wiersz['drewno'];
					
						$cos->free_result();

						$_SESSION['brak_drewna'] = 1;

						$polaczenie->close();
					}
					else
					{
						$_SESSION['brak_drewna'] = 0;
					}

					
					header('Location: gra.php');
						
				}
			
			}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}


		
		unset($_POST['add_premium']);
	}
	

	
?>
