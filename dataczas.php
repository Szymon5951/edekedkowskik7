	echo time(). "</br>";
	
	//echo mktime(19,37,0,4,2,2005). "</br>";
	//echo microtime(). "</br>";
	
	echo date('Y-m-d H:i:s'). "</br>";
	//echo date('d.m.Y'). "</br>";
	
	require_once "miesiac.php";
	wyswietl_miesiac();

	//Wykorzystanie klasy Datatime do odczytania godziny
	$dataczas = new  DateTime();
	
	echo $dataczas->format('Y-m-d H:i:s'). "</br>". print_r($dataczas);

	$dzien = 20;
	$miesiac = 7;
	$rok = 1678;
	
	if(checkdate($miesiac,$dzien,$rok))
	{
		echo "</br>jest git";
	}

