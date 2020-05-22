<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


	if(isset($_POST['send']))
	{
		if(empty($_POST['tresc']))
		{
			echo "Nie można wysłać pustej wiadomości! </br>";
		}
		else
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
						$_SESSION['zmienna'] = 1;
					
						$login = $_SESSION['user'];
						$tresc = $_POST['tresc'];
						//aktualizacja bazy danych czatu
						$sql_dodaj_wiadomosc = "INSERT INTO czat SET nazwa='$login', tresc='$tresc'";
						
					//	"UPDATE uzytkownicy SET drewno=drewno+$wyrabane_drewno WHERE user = '$login' ";
						$polaczenie->query($sql_dodaj_wiadomosc);
					
					
					
					

						header('Location: gra.php');

						$polaczenie->close();
						
				}
			
			}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}


		}
		
		unset($_POST['send']);
	}
	

	
?>
