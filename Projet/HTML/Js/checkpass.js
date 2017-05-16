function checkPass(){

    var champA = document.getElementById("pass").value;
    var champB = document.getElementById("checkpass").value;
    var message=  document.getElementById("message");





    if (champA == champB) {
        strHTML="<p>mot de passe ok</p>";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = false;
        document.getElementById("pseudocheck").className = "form-group has-success has-feedback";

        return true

    }





    else {
        strHTML="<p>Attention le mot de passe ne correspond pas!</p>";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = true;
        document.getElementById("pseudocheck").className = "form-group has-error has-feedback";
        return false;

    }
}

function passminimum (){
    var champA = document.getElementById("pass").value;
    var message=  document.getElementById("message");
    if(champA.length < 5 || champA.length>25){
        strHTML="<p>MDP entre 5 et 25 caracteres</p>";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = true;
        document.getElementById('checkpass').disabled = true;
        document.getElementById("pseudocheck").className = "form-group has-error has-feedback";
        return false;

    }
    else{
        strHTML="<p></p>";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = false;
        document.getElementById('checkpass').disabled = false;
        document.getElementById("pseudocheck").className = "form-group has-succes has-feedback";
        return false;
    }
}

function verifPseudo(e){
    var message=  document.getElementById("messagePseudo");
    var pseu=  document.getElementById("Pseudo").value;
    var strHTML;



    if(pseu.length < 2 || pseu.length > 25)
    {
        strHTML="<p>Pseudo entre 2 et 25 caracteres</p>";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = true;
        document.getElementById("pseudocheck").className = "form-group has-error has-feedback";
        return false;

    }
    else
    {
        doublonPseudo(e);
        strHTML="";
        message.innerHTML=strHTML;
        document.getElementById('OK').disabled = false;
        document.getElementById("pseudocheck").className = "form-group has-success has-feedback";
        return true;

    }
}

function valideMail(e) {

    var mail = e.target.value;
    var ch = document.getElementById('checkemail');
    var res = mail.match(/\S+@\S+\.\S+/);



    if (res == mail) {
        strHTML="";
        ch.innerHTML=strHTML;
        document.getElementById('OK').disabled = false;
        document.getElementById("pseudocheck").className = "form-group has-success has-feedback";
    } else {
        strHTML="<p>Adresse Email invalide</p>";
        ch.innerHTML=strHTML;
        document.getElementById('OK').disabled = true;
        document.getElementById("pseudocheck").className = "form-group has-error has-feedback";
    }

}

function gereXHR(e){

    var aff=document.getElementById('checkemail');
    var xhr= e.target;
    if(xhr.readyState==xhr.DONE){
        if(xhr.status==200){
            console.log('test ok');
            if (xhr.responseText == 'true') {
                //déjà pris
                strHTML="<p>Attention email déja prit</p>";
                aff.innerHTML=strHTML;
                document.getElementById('OK').disabled = true;
                document.getElementById("emailcheck").className = "form-group has-error has-feedback";
            } else { // libre
                strHTML="";
                aff.innerHTML=strHTML;
                document.getElementById('OK').disabled = false;
                document.getElementById("emailcheck").className = "form-grouphas-success has-feedback";
            }

        }else{
            aff.innerHTML='Erreur!'+xhr.status+"durant l'upload.";
        }
    }
}

function gereXHR2(e){

    var aff=document.getElementById('messagePseudo');
    var xhr= e.target;
    if(xhr.readyState==xhr.DONE){
        if(xhr.status==200){
            console.log('test ok');
            if (xhr.responseText == 'true') {
                //déjà pris
                strHTML="<p>Attention Pseudo déja prit</p>";
                aff.innerHTML=strHTML;
                document.getElementById('OK').disabled = true;
                document.getElementById("pseudocheck").className = "form-group has-error has-feedback";

            } else { // libre
                strHTML="";
                aff.innerHTML=strHTML;
                document.getElementById('OK').disabled = false;
                document.getElementById("pseudocheck").className = "form-group";
            }

        }else{
            aff.innerHTML='Erreur!'+xhr.status+"durant l'upload.";
        }
    }
}

function gereProgres(e){
    console.log(e.loaded+" sur "+ e.total);
}

function doubleEmail(e){
    var monF=document.getElementById('form');
    var formD= new FormData(monF);
    var req=new XMLHttpRequest();
    req.open("POST",'../HTML/portion/checkemail.php');
    req.onreadystatechange=gereXHR;
    req.upload.onprogress=gereProgres;

    req.send(formD);
    e.preventDefault();
    return false;
}


function doublonPseudo(e){
    var monF=document.getElementById('form');
    var formD= new FormData(monF);
    var req=new XMLHttpRequest();
    req.open("POST",'../HTML/portion/checkPseudo.php');
    req.onreadystatechange=gereXHR2;
    req.upload.onprogress=gereProgres;

    req.send(formD);
}


function init (){

    var pass= document.getElementById("checkpass");
    pass.oninput = checkPass;

    var motdepasse = document.getElementById("pass");
    motdepasse.oninput=passminimum;

    var pseudo= document.getElementById("Pseudo");
    pseudo.oninput = verifPseudo;

    var email= document.getElementById("email");
    email.oninput = valideMail;

    var doublonEmail = document.getElementById("email");
    doublonEmail.oninput=doubleEmail;

    //var doublonPseu = document.getElementById("Pseudo");
    //doublonPseu.onblur=doublonPseudo;


}

window.onload=init;

