var xmlhttp = getRequestObject();
var string;

function getRequestObject()
{
if (window.XMLHttpRequest)
  {
  // IE7+, Firefox, Chrome, Opera, Safari
  return (new XMLHttpRequest());
  }
else if (window.ActiveXObject)
  {
   // IE6, IE5
  return(new ActiveXObject("Microsoft.XMLHTTP"));
  }
else
  {
  // a böngészõ nem támogatja egyik típusú kérésobjektumot sem
  return(null);
  }
}

function adatok(felh){		//egy játéksorozat kérdéseinek száma, amit az admin állít be
	if (xmlhttp != null){	
			url = "adatok_ajax.php?felh="+felh;
			xmlhttp.onreadystatechange = handleResponse;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
	}
	else{
		alert ('sajnalom, de a bongeszoje nem tamogatja az XMLHttpRequest objektumot.');
		return;
	}
}

function handleResponse(){ // kerdesek, illetve valaszok megjelenitese
		if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
			string = xmlhttp.responseText;		//megkapom a válaszokat
			string = string.split('|');		//feldaraboljuk a kapott stringet (username,firstname,surname)
				document.getElementById('user').innerHTML = "Username: " + string[0];
				document.getElementById('firstname').innerHTML = "Firstname: " + string[1];
				document.getElementById('surname').innerHTML = "Becenév: " + string[2];
		}
}

