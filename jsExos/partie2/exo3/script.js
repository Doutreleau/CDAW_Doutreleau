"use strict";

var count = 3;
function modify(e)
{
    e.currentTarget.previousSibling.previousSibling.textContent = 'Chaine modifiée';
    alert(e.type +" on modify for "+ e.currentTarget.parentNode.id+" !");
}

function deleter(e)
{
    e.currentTarget.parentNode.remove();
    alert(e.type +" on remove for "+ e.currentTarget.parentNode.id+" !");
}

document.getElementById("addNew").addEventListener("click", function(e){
    alert(e.type +" on add !");
    count = count + 1;
    //create div
    let newDiv = document.createElement('div');
    let userId = "user" + count;
    newDiv.id = userId;
    let divUsers = document.getElementById("users");
    divUsers.prepend(newDiv);

    //create h4
    let newH4 = document.createElement('h4');
    newH4.textContent = "new user";
    newDiv.append(newH4);

    //create p
    let newp = document.createElement('p');
    newp.textContent = "new comment";
    newDiv.append(newp);

    //create buttonModify
    let newButtonModify = document.createElement('button');
    newButtonModify.className = "modify";
    newButtonModify.textContent = "Modify Comment";
    newDiv.append(newButtonModify);

    //create buttonRemove
    let newButtonRemove = document.createElement('button');
    newButtonRemove.className = "remove";
    newButtonRemove.textContent = "Remove Comment";
    newDiv.append(newButtonRemove);

    newButtonModify.addEventListener("click",modify);
    newButtonRemove.addEventListener("click",deleter);
})

let modifiers = document.getElementsByClassName("modify");
Array.from(modifiers).forEach(m => m.addEventListener("click",modify));

let remover = document.getElementsByClassName("remove");
Array.from(remover).forEach(m => m.addEventListener("click",deleter));