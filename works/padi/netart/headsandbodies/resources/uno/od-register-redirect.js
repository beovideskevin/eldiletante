// How to add a new country
// 1. add to the nro_country list
// 2. add an array including all languages provided by the NRO and register_ids
var nro_country = new Array (
'ar', //Argentina
'au', //Australia Pacific
'fj', // Australia Pacific
'at', //Austria-CEE
'be', //Belguim
'br', //Brazil
'ca', //Canada
'cz', //Czech Republic
'fr', //France
'de', //Germany
'gr', //Greece
'in', //India
'it', //Italy
'lu', //Luxembourg
'nl', //Netherlands
'mx', //Mexico
'nz', //New Zealand
'es', //Spain
'ch', //Switzerland
'gb', //UK
'us', //US
'pl' //Poland
);

var arab_countries = new Array (
'dz', //Algeria    Arab speaking countries follow
'bh', //Bahrain
'km', //Comoros
'dj', //Djibouti
'eg', //Egypt
'iq', //Iraq
'jo', //Jordan
'kw', //Kuwait
'lb', //Lebanon
'ly', //Libya
'mr', //Mauritania
'mo', //Morocco
'om', //Oman
'ps', //Palestine
'qa', //Qatar |
'sa', //Saudi
'so', //Somalia
'sd', //Sudan
'sy', //Syria
'tn', //Tunisia
'ae', //UAE
'ye' //Yemen
);

var store = new Array();

//create the language for all arabic speaking countries
for(i=0;i<arab_countries.length;i++) {
  store[arab_countries[i]] = new Array (
    'Arabic  ',
    '2545879'
  );

}


// Argentina
store["ar"] = new Array (
  'Spanish',
  '1964044'
);

//Australia
store["au"] = new Array (
  'English',
  '1961779'
);

// Fiji part of Australia Pacific
store["fj"] = new Array (
  'English',
  '1961779'
);

store["be"] = new Array (
  'Dutch',
  '1962882',
  'French',
  '1962656'
);

//Austria-CEE
store['at'] = new Array (
  'German',
  '1979366'
);

//Brazil
store['br'] = new Array (
  'Portuguese',
  '1979387'
);

//Canada
 store['ca'] = new Array (
  'English',
  '1961789',
  'French',
  '1962652'
);

//Czech Republic
store['cz'] = new Array (
  'Czech  ',
  '2727597'
);

//France
// No register for France. Using generic
store['fr'] = new Array (
  'French',
  '1962650'
);

//Germany
store['de'] = new Array (
  'German',
  '1979356'
);

//Greece
store['gr'] = new Array (
  'Greek',
  '2405071'
);


//India
store['in'] = new Array (
  'English',
  '1961802'
);

//Italy
store['it'] = new Array (
  'Italian',
  '2546075'
);

//Luxembourg
store['lu'] = new Array (
  'French',
  '1962654'
);

//Netherlands
store['nl'] = new Array (
  'Dutch',
  '1962880'
);

//Mexico
store['mx'] = new Array (
  'Spanish',
  '1963950'
);

//New Zealand
store['nz'] = new Array (
  'English',
  '1961804'
);

//Spain
store['es'] = new Array (
  'Spanish',
  '1963861'
);

//Switzerland
store['ch'] = new Array (
  'German',
  '1979364',
  'French',
  '2481281'
);

// UK
store['gb'] = new Array (
  'English',
  '1961797'
);

// US
store['us'] = new Array (
  'English',
  '1961784'
);

// Poland
store['pl'] = new Array (
  'Polish',
  '2545856'
);


// General
store["general"] = new Array (
  'English',
  '1961367'
);

// General
store["1961367"] = new Array (
  'English',
  '1961367'
);

function languageDropChange (formObj)
{
	var box = formObj.country_id;
	var country = box.options[box.selectedIndex].value;
	if (country == "") return;

        // Check if country is in the list of NROs
        // if not, then make it general
        var list = store["general"];
        for(i=0;i<nro_country.length;i+=1)
        {
	    if(country == nro_country[i]) {
               list = store[country];
               break;
            }
        }

	//check if country is in the list of Arab speaking NROs
        for(i=0;i<arab_countries.length;i+=1)
        {
            if(country == arab_countries[i]) {
               list = store[country];
               break;
            }
        }


       if (country == "us") {
          formObj.action = "http://members.greenpeace.org/member/signup.php?email=the_email_address";
          if(document.getElementById('nro_signup')) {
              document.getElementById('nro_signup').style.display = "none";
          }
          if(document.getElementById('od_nro_signup')) {
              document.getElementById('od_nro_signup').style.display = "none";
          }
       } else {
          formObj.action = "http://prefs.greenpeace.org/user-register/signup";
          if(document.getElementById('nro_signup')) {
             document.getElementById('nro_signup').style.display = "";
          }
          if(document.getElementById('od_nro_signup')) {
             document.getElementById('od_nro_signup').style.display = "";
          }
      }




	var box2 = formObj.register_id;
	box2.options.length = 0;

	// Check if site language is listed in NRO languages
        // and if not include it in the local choices
        var foundMatch;
	for(i=0;i<list.length;i+=2)
	{
		box2.options[i/2] = new Option(list[i],list[i+1]);
                if(list[i] == store["general"][0]) foundMatch = true;
                // Fudge it for the US so it only displays English
                if(country == "us") foundMatch = true;

	}

        if(!foundMatch) {
               box2.options[i/2] = new Option(store["general"][0],store["general"][1]);
        }
}



function isemail (formObj) {
       if ((formObj.email.value.indexOf('@') < 1 ||

(formObj.email.value.indexOf('.',formObj.email.value.indexOf('@')+2) < 0)
          || (formObj.email.value.length < formObj.email.value.indexOf('.',formObj.email.value.indexOf('@')+2) + 3 ))
          && (formObj.email.value.length > 0) )
       {
          formObj.email.focus()
          formObj.email.select()
          return false;
       }
       else {
          return true;
       }
}

function isblank(s) {
    for (var i = 0; i < s.length; i++) {
        var c = s.charAt(i); 
        if ((c != ' ') && (c != '\n') && (c != '\t')) {
           return false; 
        } 
    } 
    return true; 
}

function verify(formObj) {

    if (!isemail(formObj) || isblank(formObj.email.value)) {
        formObj.email.focus()
        formObj.email.select()
        alert("Please enter a valid email address (e.g. activist@supporters.com)");
        return false;
    }

    if (formObj.country_id.value == "general") {
        alert("Please choose a country");
        return false;
    }

    /*###################################*/
    /* added by roman.mora@greenpeace.de */
    /* last modified: 09.06.2006         */
    /*###################################*/

    if (formObj.country_id.value == "de" && formObj.register_id.value == "1979356") {

        /* create 18 hidden fields */
        i = 1;
        while (i <= 18) {

            Feld = document.createElement("input");
            Attribut_1 = document.createAttribute("id");
            Attribut_2 = document.createAttribute("type");
            Attribut_3 = document.createAttribute("name");
            Attribut_4 = document.createAttribute("value");
            Attribut_1.nodeValue = "Feld_" + i;
            Attribut_2.nodeValue = "hidden";
            Attribut_3.nodeValue = "";
            Attribut_4.nodeValue = "";

            Feld.setAttributeNode(Attribut_1);
            Feld.setAttributeNode(Attribut_2);
            Feld.setAttributeNode(Attribut_3);
            Feld.setAttributeNode(Attribut_4);
            formObj.appendChild(Feld);

            i++;

        }

        /* assign a TYPO3-name for each field */

        document.getElementById("Feld_1").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][campaign_adcode]";
        document.getElementById("Feld_2").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][access_adcode]";
        document.getElementById("Feld_3").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][userstate]";
        document.getElementById("Feld_4").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][phoneprefix]";
        document.getElementById("Feld_5").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][phonenumber]";
        document.getElementById("Feld_6").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][mobileprefix]";
        document.getElementById("Feld_7").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][mobilenumber]";
        document.getElementById("Feld_8").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][salutation]";
        document.getElementById("Feld_9").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][yearofbirth]";
        document.getElementById("Feld_10").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][firstname]";
        document.getElementById("Feld_11").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][lastname]";
        document.getElementById("Feld_12").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][email]";
        document.getElementById("Feld_13").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][addition]";
        document.getElementById("Feld_14").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][street]";
        document.getElementById("Feld_15").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][town]";
        document.getElementById("Feld_16").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][country]";
        document.getElementById("Feld_17").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][title]";
        document.getElementById("Feld_18").name = "tx_frontendformslib[data][tx_a21gpdcampaign_users][postcode]";

        /* assign values for each field */

        PositionSubmit = formObj.elements.length -1;
        
        formObj.elements[PositionSubmit -17].value = "300000";  // campaign_adcode
        formObj.elements[PositionSubmit -16].value = "300004";  // access_adcode
        formObj.elements[PositionSubmit -15].value = "1";       // userstate
        formObj.elements[PositionSubmit -14].value = "";        // phoneprefix
        formObj.elements[PositionSubmit -13].value = "";        // phonenumber
        formObj.elements[PositionSubmit -12].value = "";        // mobileprefix
        formObj.elements[PositionSubmit -11].value = "";        // mobilenumber
        formObj.elements[PositionSubmit -10].value = "0";       // salutation
        formObj.elements[PositionSubmit -9].value = "";         // yearofbirth
        formObj.elements[PositionSubmit -8].value = "";         // firstname
        formObj.elements[PositionSubmit -7].value = "";         // lastname
        formObj.elements[PositionSubmit -6].value = "";         // email
        formObj.elements[PositionSubmit -5].value = "";         // addition
        formObj.elements[PositionSubmit -4].value = "";         // street
        formObj.elements[PositionSubmit -3].value = "";         // town
        formObj.elements[PositionSubmit -2].value = "DEU";      // country
        formObj.elements[PositionSubmit -1].value = "";         // title
        formObj.elements[PositionSubmit].value = "";            // postcode
     
        /* diable the gpi hidden fields */

        formObj.elements[0].value = "";
        formObj.elements[1].value = "";
        formObj.elements[2].value = "";
        formObj.elements[3].value = "";
        formObj.elements[4].value = "";
        formObj.elements[5].value = "";
        formObj.elements[6].value = "";

        /* assign a different access_adcode if user is interessted in other issues as well */

        if (formObj.nro_signup_p.checked == true) {
            formObj.elements[PositionSubmit -17].value = "111111";
            formObj.action = "http://www.greenpeace.de/mitmachen/registrieren/?campaign_adcode=111111&access_adcode=300004";
        } else {
            formObj.action = "http://www.greenpeace.de/mitmachen/registrieren/?campaign_adcode=300000&access_adcode=300004";
        }

        formObj.elements[PositionSubmit -6].value = formObj.email.value ;
        formObj.elements[PositionSubmit].name = "tx_frontendformslib[submittype][submit]";
        formObj.method = "post";

    }

    /*###################################*/

    return true;

}
