// changer le backgroung des p de la class descr
/*
let pDescr = document.getElementsByClassName('descr');

for(value of pDescr){
    value.style.background = "red";
}*/


//en récupérant le caroussel, changer le background du premier paragraphe.
let monCaroussel = document.getElementById("caroussel");
let firstParagraph = monCaroussel.querySelector('p');
firstParagraph.style.background = "red";