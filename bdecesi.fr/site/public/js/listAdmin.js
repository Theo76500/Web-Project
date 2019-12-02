
$('.mydatatable').DataTable({
    searching: false,
    ordering: false,
    paging: false

});

let field = ['username', 'email'];
let compteur = 0;


let url ='http://localhost:3000/api/staff/notif';
let request = new XMLHttpRequest();

request.open('GET', url, true);
request.responseType = 'json';


request.onreadystatechange = function() {
    if (request.readyState ===4 && request.status === 200){
        let jsonObj = request.response;
        let countAdmin = jsonObj.length;
        for(let i=0;i<countAdmin;i++){
            showActivities(jsonObj);
        }
    }
};

request.send();
function showActivities(jsonObj) {
    for(let i=0;i<field.length;i++){
        let myAct = document.getElementById(field[i] + compteur);
        let admin = jsonObj[compteur]["USE_"+field[i]].substring(0, jsonObj[compteur]["USE_"+field[i]].length-1);
        myAct.textContent = admin;
        console.log(admin);
    }
    compteur++;
}

