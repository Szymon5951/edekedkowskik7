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
		}
			

		
		if(sekunda < 10)
		{
			sek = "0" + sekunda;
		}
		else
		{
			sek = sekunda;
		}
		
		
		
		document.getElementById("clock").innerHTML =
		 godzina + ":" + minuta + ":" + sek;
		
		
		setTimeout("odliczanie()", 1000);
		}

	