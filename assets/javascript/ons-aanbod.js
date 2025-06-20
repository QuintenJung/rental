
document.addEventListener('DOMContentLoaded', () => {
    const paginationButtons = document.querySelectorAll('.pagination-button');
    const carsContainer = document.querySelector('.cars');

    // Functie om data te laden en inhoud te updaten
    function loadPage(page) {
        const urlParams = new URLSearchParams(window.location.search);
        params.set("page", page);
        console.log(urlParams.toString())
        fetch(`includes/fetchcars.php?${params.toString()}`)
            .then(response => response.text())
            .then(data => {
                carsContainer.innerHTML = data;
                // URL aanpassen zonder te herladen
                history.pushState(null, '', `?${params.toString()}`);
                // Event listeners opnieuw toevoegen voor nieuwe buttons (indien aanwezig)
                initPaginationButtons();
            })
            .catch(error => console.error('Error:', error));
    }


    // Initialiseer eventlisteners op pagination buttons
    function initPaginationButtons() {
        const buttons = document.querySelectorAll('.pagination-button');
        buttons.forEach(button => {
            button.removeEventListener('click', handleClick);
            button.addEventListener('click', handleClick);
        });
    }

    // Click handler
    function handleClick(e) {
        e.preventDefault();
        const page = this.dataset.page;
        loadPage(page);
    }

    // Eerst eventlisteners toevoegen
    initPaginationButtons();

    // Popstate event om browser back/forward te ondersteunen
    window.addEventListener('popstate', () => {
        const params = new URLSearchParams(window.location.search);
        const page = params.get('page') || 1;

        const urlParams = new URLSearchParams(window.location.search);
        const max_price = urlParams.get('max_price');
        const type = params.getAll("type[]");
        const capacity = params.getAll("capacity[]");
        params.set("page", page);
        params.append("max_price", max_price);
        type.forEach(t => params.append("type[]", t));
        capacity.forEach(b => params.append("brand[]", b));


        fetch(`includes/fetchcars.php?${params.toString()}`)
            .then(res => res.text())
            .then(data => {
                carsContainer.innerHTML = data;
                // Herinitialiseer pagination buttons na verversen inhoud
                initPaginationButtons();
            });
    });

    // Optioneel: bij laden pagina, check query parameter en laad juiste pagina
    const params = new URLSearchParams(window.location.search);
    const initialPage = params.get('page') || 1;
    if (initialPage !== 1) {
        loadPage(initialPage);
    }
});



