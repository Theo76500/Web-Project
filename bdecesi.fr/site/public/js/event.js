
$('.mydatatable').DataTable({
    searching: false,
    ordering: false,
    paging: false

});

let field = ['name', 'date', 'description', 'price', 'likes',];
let compteur = 0;



let countURL ='http://localhost:3000/api/countEvent';
let requestCount = new XMLHttpRequest();

requestCount.open('GET', countURL, true);
requestCount.responseType = 'json';


let url ='http://localhost:3000/api/event';
let request = new XMLHttpRequest();

request.open('GET', url, true);
request.responseType = 'json';

requestCount.send();
requestCount.onreadystatechange = function() {
    if (requestCount.readyState === 4){
        let count = requestCount.response;
        console.log(count.length);
        request.onreadystatechange = function() {
            if (request.readyState ===4 && request.status === 200){
                let jsonObj = request.response;

                console.log(jsonObj);
                for(let i=0;i<count.length;i++){
                    showActivities(jsonObj);
                }
            }
        }
    }
};


request.send();

function showActivities(jsonObj) {
    for(let i=0;i<field.length;i++){
        let myAct = document.getElementById(field[i] + compteur);
        myAct.textContent = jsonObj[compteur]["ACT_"+field[i]];
    }
    compteur++;
}

