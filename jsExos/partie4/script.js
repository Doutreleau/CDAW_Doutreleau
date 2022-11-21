

let b1 = document.getElementById('b1');
let b2 = document.getElementById('b2');


function myhandlerB2(e){
    alert("click on B2");
    b1.addEventListener("click", myhandlerB1);
    b2.removeEventListener("click", myhandlerB2);   
}

function myhandlerB1(e){
    alert("click on B1");
    b2.addEventListener("click", myhandlerB2);    
    b1.removeEventListener("click", myhandlerB1);
 }

b1.addEventListener("click", myhandlerB1);