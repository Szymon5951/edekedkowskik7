<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


			// połączenie zeby wyswietlic ostatnie 10 wiadomosci
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
					
						//pobranie 10 ostatnich wiadomosci z bazy
						$query = "SELECT * FROM czat ORDER BY id DESC LIMIT 10;";
						$rezultat = @$polaczenie->query($query);
						$_SESSION['result'] =$rezultat;

					
						$polaczenie->close();
						
				}
			
			}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}



	
	
	
	
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Osadnicy - gra przeglądarkowa</title>
	
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />
	

	<script type="text/javascript" >
			var rok = <?php $dataczas = new DateTime(); echo $dataczas->format('Y') ?>;
		var miesiac = <?php $dataczas = new DateTime(); echo $dataczas->format('m') ?>;
		var dzien = <?php $dataczas = new DateTime(); echo $dataczas->format('d') ?>;
	
		var godzina = <?php $dataczas = new DateTime(); echo $dataczas->format('H') ?>;
		var minuta = <?php $dataczas = new DateTime(); echo $dataczas->format('i') ?>;
		var sekunda = <?php $dataczas = new DateTime(); echo $dataczas->format('s') ?>;
		function odliczanie()
		{

		//var godzina = <?php $dataczas = new DateTime(); echo $dataczas->format('H') ?>;
		//var minuta = <?php $dataczas = new DateTime(); echo $dataczas->format('i') ?>;
		//var sekunda = <?php $dataczas = new DateTime(); echo $dataczas->format('s') ?>;
		sekunda = sekunda + 1;
		if(sekunda == 60)
		{
			sekunda = 0;
			minuta = minuta + 1;
			if(minuta == 60)
			{
				minuta = 0;
				godzina = godzina + 1;
			}
		}
		
			
		
		if(sekunda < 10)
		{
			sek = "0" + sekunda;
		}
		else
		{
			sek = sekunda;
		}

		if(minuta < 10)
		{
			min = "0" + minuta;
		}
		else
		{
			min = minuta;
		}

		if(miesiac < 10)
		{
			miech = "0" + miesiac;
		}
		
		document.getElementById("clock").innerHTML = 
		dzien + "." + miech + "." + rok + " | " + godzina + ":" + min + ":" + sek;
		
		
		setTimeout("odliczanie()", 1000);
		}
		
	</script>


	
	
</head>

<body onload="odliczanie();">



	<p>Witaj <?php echo $_SESSION['user']?>! [ <a href="logout.php">Wyloguj się!</a> ]</p>
	
	
	<p><b>Drewno</b>: <?php echo $_SESSION['drewno']?>
	| <b>Kamień</b>: <?php echo $_SESSION['kamien']?>
	| <b>Zboże</b>: <?php echo $_SESSION['zboze']?> </p>
	
	


	
	<p><b>E-mail</b>: <?php echo $_SESSION['email'] ?>
	<br /><b>Data wygaśnięcia premium</b>: <?php echo $_SESSION['dnipremium'] ?> </p>
	
	<form method="post" action="budynki/tartak.php" >

		<input type="submit" value="Przejdź do Tartaku" />
	
	</form>
	</br>
	
	
	<form method="post" action="budynki/kamieniolom.php">

		<input type="submit" value="Przejdź do Kamieniołomu" />
	
	</form>
	</br>
	
	
	
	
	
	Data i czas serwera: <span id="clock"></span> </br> 
	
<?php
		
	$dataczas = new DateTime();
	
	$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
	
	$roznica = $dataczas->diff($koniec);
	
	if($dataczas<$koniec)
	echo "Pozostało premium: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
	else
	echo "Premium nieaktywne od: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');	

	
?>

    <div >
		
		
		<form  method="post" action="wykupienie_premium.php" name="add_premium">
			

				<input type="hidden" name="add_premium"/>
				
				<h4> Wykup dzień premium za 1000 jednostek drewna </h4>
				<p><input type="submit" value="Wykup" name="submit_btn"/></p>
				
				
				
		</form>
		
    </div>

<?php

	if(isset($_SESSION['brak_drewna']))
	{
	if($_SESSION['brak_drewna'] == 0)
	{echo "Nie stać cię na premium</br>";}
	else if ($_SESSION['brak_drewna'] == 1)
	{echo "Zakupiono dzień premium</br>";}
	
	
	unset($_SESSION['brak_drewna']);
	
	}

	
?>

    <div id="strona">
		<h1>Czat</h1>
		<div id="content">
			<form  method="post" action="dodaj_wpis.php" name="czat">
			
				<div class="fnazwa">
					<label for="nazwa">
						<p>Nazwa: <?php echo $_SESSION['user']?> </p>
					</label>
				</div>
				
				<textarea name="tresc" rows="5" cols="40"></textarea>
				<input name="send" type="hidden" />
				
				
				<p><input type="submit" value="Wyślij" name="submit_btn"/></p>
				
				
				
			</form>
		</div>
    </div>
	

    <ul>
    <?php

	//	$_SESSION['tablica'] = array(100,200,100);

		/* associative array */
		while($row = mysqli_fetch_array($_SESSION['result'], MYSQLI_ASSOC))
		{
			printf ("%s (%s)\n </br>", $row["nazwa"], $row["tresc"]);
		}

    ?></ul>






</body>
</html>