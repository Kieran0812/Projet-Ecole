var long;
var lat;
var tt=2;
document.addEventListener('DOMContentLoaded', function (){
   if ("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(function(position){
            tt=1;
            long=position.coords.longitude;
            lat=position.coords.latitude;
            getweather(tt);
        })
   }
});

function manualsearch(){
    tt=2;
    getweather(tt);
}

function getweather(tt) {
    //initialisation HTTPRequest
    var xhttp = new XMLHttpRequest();
    //on lui affecte une fonction quand HTTPREQUEST reçoit des informations
        xhttp.onreadystatechange = function() {
            //vérification que la requête HTTP est effectuée (readyState 4) et qu'elle s'est bien passée (status 200)
            if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
				var obj=JSON.parse(xhttp.responseText);
                document.getElementById("currenttown").innerText=obj.name; // donne le nom de la ville
                document.getElementById("currenttemp").innerText=obj.main.temp+"°C"; // donne la temperature °C
                document.getElementById("currentweather").innerText=obj.weather[0].description; // donne la description du temps
                var ico = obj.weather[0].icon;//recuperation de l'icone
                document.getElementById("iconimg").src="http://openweathermap.org/img/wn/"+ico+"@2x.png";// donne l'image de l'icone
            }
        };
        if(tt==1){
            xhttp.open("GET", "http://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+long+"&lang=fr&appid=182c69067164e7bb7fd14ccfadce5f83&units=metric", true);
        }
        else{
            xhttp.open("GET", "http://api.openweathermap.org/data/2.5/weather?q="+document.getElementById("town").value+"&lang=fr&appid=182c69067164e7bb7fd14ccfadce5f83&units=metric", true);
        }
        
        xhttp.send(); 
        var dbob = document.getElementById('verif');               
        if(dbob != undefined){ // regarde si y'a déja le début de tableau sioui supprime les elements dbob et BOB
            var t = document.getElementById('debutBOB');//selection de la div a supprime
            var tf = document.getElementById('BOB');//selection de la div a supprime
            t.remove();// supprime la div
            tf.remove();// supprime la div           
            regleur();    
        }
        var existetab = document.getElementById('BOB');
        if(existetab != undefined){
            debutBob();
            forecast(0, tt); 
        }       
}
function forecast(btn){  
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj=JSON.parse(xhttp2.responseText);
            //selecteur de jour           
            var tempo = obj.list[0].dt_txt;// recuperation de la date et heure 2020-11-10 18:00 
            var formtempo = new Date(tempo);// formatage de la date et heure
            var current = formtempo.getHours();// recuperation de l'heure
            var hoursleft = ((24 - current)/3);// calcul du temps restant
            switch (btn){
                case 1://aujourd'hui
                    var i = 0; // valeur de départ
                    var imax= hoursleft; // valeur max              
                    var tf = document.getElementById('BOB');//selection de la div a supprime
                    tf.remove();// supprime la div             
                    regleur();   
                break;
                case 2://demain
                    var i = hoursleft;
                    var imax= hoursleft+8;
                    var tf = document.getElementById('BOB');
                    tf.remove();             
                    regleur();   
                break;
                case 3://après-demain
                    var i = hoursleft+8;
                    var imax= i+8;
                    var tf = document.getElementById('BOB');
                    tf.remove();             
                    regleur();   
                break;
                case 4://le jour d'après
                    var i = hoursleft+16;
                    var imax= i+8;
                    var tf = document.getElementById('BOB');
                    tf.remove();             
                    regleur();   
                break;
                case 5://5 jour plus tard
                    var i = hoursleft+24;
                    var imax= i+8;
                    var tf = document.getElementById('BOB');
                    tf.remove();             
                    regleur();   
                break;
                default://a default aujourd'hui
                    var i = 0;
                    var imax= hoursleft;
            }
            for (var j=i;j<imax;j++){//recuperation de donné voulu de BOB
                var dt = obj.list[j].dt_txt;//date et heure 
                var ftemp = obj.list[j].main.temp+"°C"; // temperature prévu
                var fweather = obj.list[j].weather[0].description; // description prévu
                var ficon =obj.list[j].weather[0].icon;//icone prévu
                //convertisseur de la date
                var formdt=new Date(dt);
                var mt = formdt.getMonth()+1;// donne le mois (note: +1 vu que ca part de 0 et non de 1)
                var td = formdt.getDate()+"/"+mt+"/"+formdt.getFullYear()+" "+formdt.getHours()+":00"; // donne date au format jj/mm/yyyy hh:00               
                // construction du tableau
                var divmaster = document.getElementById('BOB');// ancre dans l'html
                var divpupets =document.createElement('div'); // div conteneur sert pour le css
                var divdate=document.createElement('div'); // date au format jj/mm/yyyy hh:mm
                divdate.className="date";
                divdate.innerText= td;
                var divtemp=document.createElement('div'); // temperature °C
                divtemp.className="temp";
                divtemp.innerText=ftemp;
                var divweather=document.createElement('div'); // description du temps
                divweather.className="desc";
                divweather.innerText=fweather;
                var divicon=document.createElement('div'); //icone visuel
                divicon.className="icone";
                var imgicon=document.createElement('img');
                imgicon.src="http://openweathermap.org/img/wn/"+ficon+"@2x.png";
                // gestion des enfants
                divmaster.appendChild(divpupets); // divmaster est le père de divpupets
                divpupets.appendChild(divdate); // divmaster est le grand-père de divdate, divpupets est le père de divdate
                divpupets.appendChild(divtemp);
                divpupets.appendChild(divweather);
                divpupets.appendChild(divicon);
                divicon.appendChild(imgicon);
            }
        }
    };
    if(tt==1){
        xhttp2.open("GET", "http://api.openweathermap.org/data/2.5/forecast?lat="+lat+"&lon="+long+"&lang=fr&appid=182c69067164e7bb7fd14ccfadce5f83&units=metric", true);
    }
    else{
        xhttp2.open("GET", "http://api.openweathermap.org/data/2.5/forecast?q="+document.getElementById("town").value+"&lang=fr&appid=182c69067164e7bb7fd14ccfadce5f83&units=metric", true);
    }
        xhttp2.send();
}
// constructeur du début de tableau
function debutBob() {
    var dmaster = document.getElementById('debutBOB');// ancre dans l'html
    var ddate = document.createElement('div'); // crée une div 
    ddate.innerHTML="Date et Heure";// mise en html des valeurs
    var dtemp = document.createElement('div');
    dtemp.innerHTML="Température";
    var dweather = document.createElement('div');
    dweather.innerHTML ="Description"
    var dicon = document.createElement('div');
    dicon.innerHTML="Icone";
    var verif = document.createElement('div');
    verif.id="verif";

    dmaster.appendChild(ddate); // dmaster est le père de ddate
    dmaster.appendChild(dtemp);
    dmaster.appendChild(dweather);
    dmaster.appendChild(dicon);
    dmaster.appendChild(verif);
}

function regleur(){ // recrée les elements html debutBOB et BOB
    var body = document.getElementById('body');  //selection de l'element html père
    var db = document.createElement('div'); // création de la div fils
    db.id = "debutBOB";// affectation de l'id
    db.className ="dBob";// affectation de la class
    var tb = document.createElement('div');
    tb.id = "BOB";
    tb.className = "Bob";
    body.appendChild(db);//annonce que body est le père de db
    body.appendChild(tb);
 
}