window.addEventListener('DOMContentLoaded', () => {
   
    let active = document.getElementsByClassName("user-active") ;
    let all = document.getElementsByClassName("user-row");
    let desactive = document.getElementsByClassName("user-inactive");
    let team = document.getElementsByClassName("user-team");
    let partner = document.getElementsByClassName("user-partner");
    let manager = document.getElementsByClassName("user-manager");

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

    const teamBtn = document.querySelector("#js-team");
    function displayTeam(){
        Array.from(team).forEach(element => {
            element.classList.remove('d-none');
        });
        Array.from(active, desactive, partner, manager).forEach(element => {
            element.classList.add('d-none');
        });
    }

    const partnerBtn = document.querySelector("#js-partner");
    function displayPartner(){
        Array.from(partner).forEach(element => {
            element.classList.remove('d-none');
        });
        Array.from(active, desactive, team, manager).forEach(element => {
            element.classList.add('d-none');
        });
    }

    const managerBtn = document.querySelector("#js-manager");
    function displayManager(){
        Array.from(manager).forEach(element => {
            element.classList.remove('d-none');
        });
        Array.from(active, desactive, team, partner).forEach(element => {
            element.classList.add('d-none');
        });
    }

    allBtn.addEventListener('click', displayAll);
    activeBtn.addEventListener('click', displayActive);
    deactiveBtn.addEventListener('click', displayDesactive);
    teamBtn.addEventListener('click', displayTeam);
    partnerBtn.addEventListener('click', displayPartner);
    managerBtn.addEventListener('click', displayManager);
});


