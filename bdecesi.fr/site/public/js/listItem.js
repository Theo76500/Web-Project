$('.mydatatable').DataTable({
    searching: false,
    ordering: false,
    paging: false
});

let field = ['name', 'description', 'price', 'quantity'];
let compteur = 0;



let url ='http://localhost:3000/api/admin/product';
let request = new XMLHttpRequest();

request.open('GET', url, true);
request.responseType = 'json';

request.onreadystatechange = function() {
    if (request.readyState === 4 && request.status === 200) {
        let jsonObj = request.response;
        console.log(jsonObj);
        for (let i = 0; i < jsonObj.length; i++) {
            showProducts(jsonObj);
        }
    }
};


request.send();

function showProducts(jsonObj) {
    for(let i=0;i<field.length;i++){
        let myPro = document.getElementById(field[i] + compteur);
        myPro.textContent = jsonObj[compteur]["PRO_"+field[i]];
    }
    compteur++;
}


