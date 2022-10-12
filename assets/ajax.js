// filtre :
let jsStructure;

// lorsque je clique sur le bouton activés seule les structures activées s'affichent
let active = document.getElementsById('js-active')

function activeStructure(){
    if (jsStructure === isActive) {
        jsStructure.style.display = 'block'; 
    }else {
        jsStructure.style.display = 'none';
    }
}

//APPEL DES LISTENER :
active.addEventListner('click', function(){
    activeStructure();
});


// lorsque je clique sur le bouton désactivés seule les structures déactivées s'affichent
let unactive = document.getElementsById('js-unactive')

function unactiveStructure(){
    if (js-data-structure === isActive) {
        jsStructure.style.display = 'none'; 
    }else {
        jsStructure.style.display = 'block';
    }
}

//APPEL DES LISTENER :
unactive.addEventListner('click', function(){
    unactiveStructure();
});



// lorsque je clique sur le bouton toute, toutes les structures s'affichent
let all = document.getElementsById('js-all')

function allStructure(){
    if (js-data-structure === isActive) {
        jsStructure.style.display = 'block'; 
    }else {
        jsStructure.style.display = 'block';
    }
}

//APPEL DES LISTENER :
all.addEventListner('click', function(){
    allStructure();
});




