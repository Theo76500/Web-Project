let autorisedCaracters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "@", "_", "-", "."];
let maj = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']
let chiffres = [1, 2, 3, 4, 5, 6, 7, 8, 9]

if(document.getElementsByClassName('email')[0] != null){
    document.getElementsByClassName('email')[0].addEventListener('input', function (e) {
    // Correspond à une chaîne de la forme xxx@yyy.zzz
    let small = document.getElementsByClassName('small-email')[0];
    let regexCourriel = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@viacesi\.[a-zA-Z]{2,4}$/;

    if (regexCourriel.test(e.target.value)) {
        e.target.classList.remove('invalid')
        e.target.classList.add('valid')

        small.textContent = 'Syntaxe valide !'
    } else {
        e.target.classList.remove('valid')
        e.target.classList.add('invalid')

        small.textContent = 'Syntaxe invalide !'
    }
});
}


// Event for password :

if(document.getElementsByClassName('password')[0] != null){
    document.getElementsByClassName('password')[0].addEventListener('input', function (e) {
        let chiffreTest = false;
        for(let i = 0; i < chiffres.length; i++){
            if(e.target.value.search(chiffres[i]) == -1){
            } else{
                chiffreTest = true
            }
        }

        let majTest = false;
        for(let i = 0; i < maj.length; i++){
            if(e.target.value.search(maj[i]) == -1){
            } else{
                majTest = true
            }
        }

        let password_confirm = document.getElementsByClassName('password_confirm')[0]
        let small_password_confirm = document.getElementsByClassName('small-password_confirm')

        if(e.target.value != password_confirm.value){
            e.target.classList.remove('valid')
            e.target.classList.add('invalid')

            let small = document.getElementsByClassName('small-password')[0];
            small.textContent = 'Les mots de passe sont différents'
        } else {
            e.target.classList.remove('invalid')
            e.target.classList.add('valid')

            let small = document.getElementsByClassName('small-password')[0];
            small.textContent = 'Syntaxe valide !'
            small_password_confirm.textContent = ''
        }

        if(chiffreTest && majTest){
            e.target.classList.remove('invalid')
            e.target.classList.add('valid')

            let small = document.getElementsByClassName('small-password')[0];
            small.textContent = 'Syntaxe valide !'
        } else {
            e.target.classList.remove('valid')
            e.target.classList.add('invalid')

            let small = document.getElementsByClassName('small-password')[0];
            small.textContent = 'Syntaxe du champ invalide. Au moins une majuscule et un chiffre sont requis'
        }
    })
}

if(document.getElementsByClassName('password_confirm')[0] != null){
    document.getElementsByClassName('password_confirm')[0].addEventListener('input', function (e) {
        let chiffreTest = false;
        for(let i = 0; i < chiffres.length; i++){
            if(e.target.value.search(chiffres[i]) == -1){
            } else{
                chiffreTest = true
            }
        }

        let majTest = false;
        for(let i = 0; i < maj.length; i++){
            if(e.target.value.search(maj[i]) == -1){
            } else{
                majTest = true
            }
        }

        let password = document.getElementsByClassName('password')[0]
        let small_password = document.getElementsByClassName('small-password')
        let block = true

        if(e.target.value != password.value){
            e.target.classList.remove('valid')
            e.target.classList.add('invalid')

            let small = document.getElementsByClassName('small-password_confirm')[0];
            small.textContent = 'Les mots de passe sont différents'
        } else {
            e.target.classList.remove('invalid')
            e.target.classList.add('valid')

            let small = document.getElementsByClassName('small-password_confirm')[0];
            small.textContent = 'Syntaxe valide !'
            small_password.textContent = ''
            block = false;
        }

        if(!block){
            if(chiffreTest && majTest){
                e.target.classList.remove('invalid')
                e.target.classList.add('valid')

                let small = document.getElementsByClassName('small-password_confirm')[0];
                small.textContent = 'Syntaxe valide !'
            } else {
                e.target.classList.remove('valid')
                e.target.classList.add('invalid')

                let small = document.getElementsByClassName('small-password_confirm')[0];
                small.textContent = 'Syntaxe du champ invalide. Au moins une majuscule et un chiffre sont requis'
            }
        }
    })
}

if(document.getElementsByClassName('pseudo')[0] != null){
    document.getElementsByClassName('pseudo')[0].addEventListener('input', function (e) {
        if(e.target.value.length <= 2){
            e.target.classList.remove('valid')
            e.target.classList.add('invalid')
            let small_pseudo = document.getElementsByClassName('small-pseudo')[0]
            small_pseudo.textContent = 'Syntaxe du champ invalide. Votre pseudo doit contenir au moins 2 caractères'
        } else {
            e.target.classList.remove('invalid')
            e.target.classList.add('valid')
            let small_pseudo = document.getElementsByClassName('small-pseudo')[0]
            small_pseudo.textContent = 'Syntaxe valide'
        }
    })
}

if(document.getElementsByTagName('form')[1]){
    document.getElementsByTagName('form')[1].addEventListener('submit', function (e){
        let inputMail = document.getElementsByClassName('email')[0];
        let inputPassword = document.getElementsByClassName('password')[0];
        let inputPasswordConfirm = document.getElementsByClassName('password_confirm')[0];
        let inputPseudo = document.getElementsByClassName('pseudo')[0];
        let selectCampus = document.getElementsByTagName('select')[0];

        verifMail(inputMail);
        verifPassword(inputPassword);
        verifPasswordConfirm(inputPasswordConfirm);
        verifPseudo(inputPseudo);
        verifSelect(selectCampus);

        if(document.getElementsByClassName('invalid').length > 0){
            e.preventDefault();
        }
    })
}

function verifMail(element){
    let regexCourriel = /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@viacesi\.[a-zA-Z]{2,4}$/;
    if (!regexCourriel.test(element.value)) {
        element.classList.remove('valid')
        element.classList.add('invalid')

        let small = document.getElementsByClassName('small-email')[0];

        small.textContent = 'Syntaxe du champ invalide'

    } else {
        element.classList.remove('invalid')
        element.classList.add('valid')

        let small = document.getElementsByClassName('small-email')[0];

        small.textContent = 'Syntaxe valide !'
    }
}

function verifPassword(element){
    let chiffreTest = false;
    for(let i = 0; i < chiffres.length; i++){
        if(element.value.search(chiffres[i]) == -1){
        } else{
            chiffreTest = true
        }
    }

    let majTest = false;
    for(let i = 0; i < maj.length; i++){
        if(element.value.search(maj[i]) == -1){
        } else{
            majTest = true
        }
    }

    let password_confirm = document.getElementsByClassName('password_confirm')[0]
    let small_password_confirm = document.getElementsByClassName('small-password_confirm')

    if(element.value != password_confirm.value){
        element.classList.remove('valid')
        element.classList.add('invalid')

        let small = document.getElementsByClassName('small-password')[0];
        small.textContent = 'Les mots de passe sont différents'
    } else {
        element.classList.remove('invalid')
        element.classList.add('valid')

        let small = document.getElementsByClassName('small-password')[0];
        small.textContent = 'Syntaxe valide !'
        small_password_confirm.textContent = ''
    }

    if(chiffreTest && majTest){
        element.classList.remove('invalid')
        element.classList.add('valid')

        let small = document.getElementsByClassName('small-password')[0];
        small.textContent = 'Syntaxe valide !'
    } else {
        element.classList.remove('valid')
        element.classList.add('invalid')

        let small = document.getElementsByClassName('small-password')[0];
        small.textContent = 'Syntaxe du champ invalide. Au moins une majuscule et un chiffre sont requis'
    }
}

function verifPasswordConfirm(element){
    let chiffreTest = false;
    for(let i = 0; i < chiffres.length; i++){
        if(element.value.search(chiffres[i]) == -1){
        } else{
            chiffreTest = true
        }
    }

    let majTest = false;
    for(let i = 0; i < maj.length; i++){
        if(element.value.search(maj[i]) == -1){
        } else{
            majTest = true
        }
    }

    let password = document.getElementsByClassName('password')[0]
    let small_password = document.getElementsByClassName('small-password')
    let block = true

    if(element.value != password.value){
        element.classList.remove('valid')
        element.classList.add('invalid')

        let small = document.getElementsByClassName('small-password_confirm')[0];
        small.textContent = 'Les mots de passe sont différents'
    } else {
        element.classList.remove('invalid')
        element.classList.add('valid')

        let small = document.getElementsByClassName('small-password_confirm')[0];
        small.textContent = 'Syntaxe valide !'
        small_password.textContent = ''
        block = false;
    }

    if(!block){
        if(chiffreTest && majTest){
            element.classList.remove('invalid')
            element.classList.add('valid')

            let small = document.getElementsByClassName('small-password_confirm')[0];
            small.textContent = 'Syntaxe valide !'
        } else {
            element.classList.remove('valid')
            element.classList.add('invalid')

            let small = document.getElementsByClassName('small-password_confirm')[0];
            small.textContent = 'Syntaxe du champ invalide. Au moins une majuscule et un chiffre sont requis'
        }
    }
}

function verifPseudo(element){
        if(element.value.length <= 2){
        element.classList.add('invalid')
        let small_pseudo = document.getElementsByClassName('small-pseudo')[0]
        small_pseudo.textContent = 'Syntaxe du champ invalide. Votre pseudo doit contenir au moins 2 caractères'
    } else {
        element.classList.add('valid')
        let small_pseudo = document.getElementsByClassName('small-pseudo')[0]
        small_pseudo.textContent = 'Syntaxe valide'
    }
}

function verifSelect(element){
    if(element.value == 'Selectionnez un campus'){
        element.classList.remove('valid')
        element.classList.add('invalid')
        let small = document.getElementsByClassName('small-select')
        small.textContent = 'Veuillez sélectionner un campus'
    } else {
        element.classList.remove('invalid')
        element.classList.add('valid')
        let small = document.getElementsByClassName('small-select')
        small.textContent = ''
    }
}



/*

// Event for password_confirm :

$('#password_confirm').on('input', function password_confirm_check(event) {
    // Verify if empty or if a wrong caracter is entered
    if ($("#password_confirm").val() == "" || $("#password_confirm").val() != $("#password").val() || verifCarac("password_confirm")) {
        setIncorret("#password_confirm");
        doneList["#password_confirm"] = false;
    } else {
        setCorrect("#password_confirm");
        doneList["#password_confirm"] = true;
    }
});

// Event for username :

$("#username").on('input', function username_check(event) {
    // Verify if empty or if a wrong caracter is entered
    if ($("#username").val() == "" || verifCarac("username")) {
        setIncorret("#username");
        doneList["#username"] = false;
    }
    // Verify the length
    else if ($("#username").val().length < 3) {
        setIncorret("#username");
        doneList["#username"] = false;
        $("#username_error").remove();
        $("#div_username").append("<p id='username_error' style='color:red;'>Nom d'utilateur trop court !</p>");
    }
    // Verify the length
    else if ($("#username").val().length > 32) {
        setIncorret("#username");
        doneList["#username"] = false;
        $("#username_error").remove();
        $("#div_username").append("<p id='username_error' style='color:red;'>Nom d'utilateur trop long !</p>");
    } else {
        $("#username_error").remove();
        setCorrect("#username");
        doneList["#username"] = true;
    }
});

// This function is call when the user click on "s'inscrire" :

function entryVerifRegister() {
    event.preventDefault();
    var ready = true;

    for (var index in doneList) {
        if (!doneList[index]) {
            ready = false;
            setIncorret(index);
        }
    }
    if (ready) {
        $("#alert").remove();
        $.ajax({
            url: "inscriptionScript.php",
            data: {
                username: $("#username").val(),
                password: $("#password").val(),
                mail: $("#mail").val(),
                campus: $("#campus").val()
            },
            type: "POST"
        }).done(function (data, status, error) {
            $(location).attr('href', "connexion.php");
        });
    } else {
        $("#alert").remove();
        $('.button-submit').append("<p id='alert' style='color:red;'>*Veillez renseigner les champs en rouge</p>");
    }
}

// Set the input verified incorrect et visible in lightpink for the user :

function setIncorret(self) {
    $(self).attr("style", "background-color : lightpink!important");
}

// Set the input verified correct et visible in lightgreen for the user :

function setCorrect(self) {
    $(self).attr("style", "background-color : lightgreen!important");
}

// This fonction look at the caracters incorrect in the input selected :

function verifCarac(id) {
    var validate_test_input = true;
    var exist_in_list = false;
    var input_tab = $("#" + id).val().split(""); // We split the value of the input even if it is entered letter by letter to provide for a copy/paste in the input selected.
    for (var testedCarac in input_tab) { // We test all the caracters here
        for (var value in autorisedCaracters) {
            if (autorisedCaracters[value] == input_tab[testedCarac].toLowerCase()) {
                exist_in_list = true;
            }
        }
        if (!exist_in_list) { //Incorrect caracter is found, we indicate the wrong caracter to the user and we erase him from the input.
            validate_test_input = false;
            $("#alert").remove();
            $(".button-submit").append("<p id='alert' style='color:red;'>*Utilisation de caractères incorrect ! : '" + input_tab[testedCarac] + "', celui-ci ne sera pas écrit</p>");
            $("#" + id).val($("#" + id).val().substring(0, $("#" + id).val().length - 1));
            return true;
        }
        exist_in_list = false;
    }
    return false;
} */
