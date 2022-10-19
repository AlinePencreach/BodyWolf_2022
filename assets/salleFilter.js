window.addEventListener('DOMContentLoaded', () => {
   
    let active = document.getElementsByClassName("salle-active") ;
    let all = document.getElementsByClassName("salle-row");
    let desactive = document.getElementsByClassName("salle-inactive");

    const allBtn = document.querySelector("#js-all");
    function displayAll(){
        Array.from(all).forEach(element => {
            element.classList.remove('d-none');
        });
    }
    
    const activeBtn = document.querySelector("#js-active");
    function displayActive(){
        Array.from(active).forEach(element => {
            element.classList.remove('d-none');
        });
        Array.from(desactive).forEach(element => {
            element.classList.add('d-none');
        });
    }
    
    const deactiveBtn = document.querySelector("#js-unactive");
    function displayDesactive(){
        Array.from(desactive).forEach(element => {
            element.classList.remove('d-none');
        });
        Array.from(active).forEach(element => {
            element.classList.add('d-none');
        });
    }

    allBtn.addEventListener('click', displayAll);
    activeBtn.addEventListener('click', displayActive);
    deactiveBtn.addEventListener('click', displayDesactive);
});


