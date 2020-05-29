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