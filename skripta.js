		
	var ukupnoPoDanu = document.forma_rezervacija.ukupnoPoDanu.value;

	function odlazak(){
			var sad = new Date();
  			var datumDolaska = document.getElementById('dolazakDatum').value;
  			var brojNocenja = document.getElementById('brojNocenja').value;

  			if (!datumDolaska){
  					datumDolaska = new Date();
  				} else if (new Date(datumDolaska) < sad){
  					alert("Izaberite ispravan datum");
  				}
  			var danas = new Date().getTime();
  			var datum = new Date(datumDolaska).getTime() + brojNocenja*3600*24*1000;
  			if(datum < danas) datum = danas;
  			var odlazakDatum = new Date(datum);
            var dan 	= odlazakDatum.getDate();
            var mesec   = odlazakDatum.getMonth()+1;
            var godina  = odlazakDatum.getFullYear();
            document.forma_rezervacija.odlazakDatum.value = dan+"."+mesec+"."+godina+".";
        	document.forma_rezervacija.ukupnoZaUplatu.value = ukupnoPoDanu * brojNocenja;
        	if (document.forma_rezervacija.ukupnoZaUplatu.value == 0) alert("Morate izabrati broj nocenja.");
        }

	function placanje(){
			var smestaj = document.forma_rezervacija.brKreveta.value;
			var odlazakDatum = document.forma_rezervacija.odlazakDatum.value;
			var emailSirovo = document.forma_rezervacija.email.value;
			var imePattern = /^[a-zA-ZšŠđĐžŽčČćĆ]+$/;
			var prezimePattern = /^[a-zA-ZšŠđĐžŽčČćĆ]+((-|\s)[a-zA-ZšŠđĐžŽčČćĆ]+)?$/;
			var ime = document.forma_rezervacija.ime.value;
			var prezime = document.forma_rezervacija.prezime.value;
			var imeTest = imePattern.test(ime);
			var prezimeTest = prezimePattern.test(prezime);


			var emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
			var emailTest = emailPattern.test(emailSirovo);
			var visa = document.forma_rezervacija.visa.checked;
			var mastercard = document.forma_rezervacija.mastercard.checked;
			var brojkartice = document.forma_rezervacija.brojKartice.value;
			var karticaPattern = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
			var kartica = karticaPattern.test(brojkartice);
			
			if(!smestaj || !odlazakDatum){
					alert("Morate izabrati smestaj i vreme boravka.");
				} else if (document.forma_rezervacija.ukupnoZaUplatu.value == 0){
					alert("Morate izabrati broj nocenja.");
				} else if(!imeTest || !prezimeTest || !emailTest){
					alert("Morate pravilno uneti Vase podatke.");
				} else if(!visa && !mastercard){
					alert("Morate izabrati karticu.");
				} else if(!brojkartice){
					alert("Morate uneti broj kartice.");
				} else if(!kartica){
					alert("Pogresili ste pri unosu kartice.");
				} else if(!document.forma_rezervacija.usloviKoriscenja.checked){
					alert("Morate prihvatiti uslove koriscenja sajta."); 
				} else {
					alert("Uspesno ste izvrsili placanje.");
					window.open('rezervacije.php', '_blank');
					document.getElementById("rezervacija_stil").action = "obradaPlacanja.php";
			}
		}
