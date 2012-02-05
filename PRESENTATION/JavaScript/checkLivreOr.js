function check()
{
    if(window.document.signer.getElementById('pseudo').value.length == 0)
    {
        window.alert("Le champ 'Pseudo' doit etre renseigne !");
        //window.document.signer.pseudo.style.backgroundColor = 'rgb(255, 0, 0)';
        //window.document.signer.pseudo.style.backgroundColor = 'rgb(255, 0, 0)';
        //window.document.signer.pseudo.focus;
        return false;
    }
    
    if(window.document.signer.mail.value.length == 0)
    {
        window.alert("Le champ 'Mail' doit etre renseigne !");
        window.document.signer.mail.style.backgroundColor = 'rgb(255, 0, 0)';
        window.document.signer.mail.focus;
        return false;
    }
    
    if(window.document.signer.message.value.length == 0)
    {
        window.alert("Le champ 'Message' doit etre renseigne !");
        window.document.signer.message.style.backgroundColor = 'rgb(255, 0, 0)';
        window.document.signer.message.focus;
        return false;
    }
    
// Verification syntaxique de l adresse mail
    var patt = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if( !(patt.test(window.document.signer.mail.value)) )
    {
        window.alert("L adresse mail n est pas valide !");
        window.document.signer.mail.style.backgroundColor = 'rgb(255, 0, 0)';
        window.document.signer.message.focus;
        return false;
    }
    return false;
    
    
}