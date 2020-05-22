<?php

	// sesja jest to pojemnik na dane globalne w obrebie plikow php na serwerze
	session_start();
	
	if(!isset($_POST['login']) || !isset($_POST['haslo']))
	{
		header('Location: index.php');
		exit();
	}
	

	require_once "connect.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno . " Opis: ". $polaczenie->connect_error;
	}
	else
	{

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		// ochrona przed wstrzykiwaniem SQL
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		
		
	
		
		// if sprawsza czy zapytanie sql zapisane jest poprawnie a real escape broni przed wstrzykiwaniem
		if($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			// zapisuje ile wierszy zostalo zwrocone( 1 albo 0 bo albo ktos sie zalogowal albo nie)
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0)
			{
				// ta tablicja asocjacyjna spisuje nazwy poszczegonych kolumn w wierszu( jak login,pass,id,itemki w grze)
				$wiersz = $rezultat->fetch_assoc();
				
				// porównuje hasło z bazy(zahasowane) z haslem podanym przez uzytkownika(funkcja je sobie hasuje)
				if(password_verify($haslo, $wiersz['pass']))
				{
				
					//zmienna inforumujaca index.php o tym ze ktos jest zalogowany
					$_SESSION['zalogowany'] = true;
					
					//ktos sie zalogowal

					
					
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['user'] = $wiersz['user'];
					$_SESSION['drewno'] = $wiersz['drewno'];
					$_SESSION['kamien'] = $wiersz['kamien'];
					$_SESSION['zboze'] = $wiersz['zboze'];
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['dnipremium'] = $wiersz['dnipremium'];
					
					unset($_SESSION['blad']);
					
					
					$rezultat->free_result();
					header('Location: gra.php');
				}
				else
				{
					//nie ma takiego uzytkownika albo zły pass
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
					
				}
				
				
				
			}
			else 
			{
				//nie ma takiego uzytkownika albo zły pass
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
		}
		

		$polaczenie->close();
		
	}
?>