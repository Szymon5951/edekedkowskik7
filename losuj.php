<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

		//100
	if(isset($_POST['losuj_100']))
	{
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
						$losowa_100 = rand(1,100);
						$login = $_SESSION['user'];
						$tresc = " wylosowal $losowa_100 z zakresu 1 do 100";
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
	
			//10
		if(isset($_POST['losuj_10']))
	{
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
						$losowa_100 = rand(1,10);
						$login = $_SESSION['user'];
						$tresc = " wylosowal $losowa_100 z zakresu 1 do 10";
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
				//6
		if(isset($_POST['losuj_6']))
	{
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
						$losowa_100 = rand(1,6);
						$login = $_SESSION['user'];
						$tresc = " wylosowal $losowa_100 z zakresu 1 do 6";
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
	
		if(isset($_POST['losuj_8']))
	{
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
						$losowa_100 = rand(1,8);
						$login = $_SESSION['user'];
						$tresc = " wylosowal $losowa_100 z zakresu 1 do 8";
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
	
			if(isset($_POST['losuj_4']))
	{
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
						$losowa_100 = rand(1,4);
						$login = $_SESSION['user'];
						$tresc = " wylosowal $losowa_100 z zakresu 1 do 4";
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

	
?>
