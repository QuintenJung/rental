const closePopup = document.getElementById("addCarPopupClose")
const editClosePopup = document.getElementById("editCarPopupClose")
const editCarForm = document.getElementById("editCarPopup")
const editerCarPopupClose = document.getElementById("editerCarPopupClose")
const editCarOptionEditer = document.getElementById("editCarOptionEditer")
const editCarButton = document.getElementById("editCar")
const addCarButton = document.getElementById("addCar")
const addCarForm = document.getElementById("addCarPopup")
const voeg_toe_button = document.getElementById("addCarSubmit")
const car_name_input = document.getElementById("car_name")
const car_beschijving_input = document.getElementById("car_beschijving")
const car_img_input = document.getElementById("car_img")
const car_type_input = document.getElementById("car_type")
const car_capacity_input = document.getElementById("car_capacity")
const car_steering_input = document.getElementById("car_steering")
const car_gasoline_input = document.getElementById("car_gasoline")
const car_prijs_input = document.getElementById("car_prijs")
const car_sterren_input = document.getElementById("car_sterren")
const car_reviewers_input = document.getElementById("car_reviewers")
const editCarOption = document.querySelectorAll(".editCarOption")

closePopup.addEventListener("click", () => {
    addCarForm.style.display = "none"
})
editerCarPopupClose.addEventListener("click", () => {
    editCarOptionEditer.style.display = "none"
})
editClosePopup.addEventListener("click", () => {
    editCarForm.style.display = "none"
})
addCarButton.addEventListener("click", () => {
    addCarForm.style.display = "block"
})
editCarButton.addEventListener("click", () => {
    editCarForm.style.display = "block"
})

function openEditer() {
    editCarOptionEditer.style.display = "block"
    console.log("test")
}


voeg_toe_button.addEventListener("click", () => {
    function triggerPHP() {

        const xhr = new XMLHttpRequest();
        const url = 'actions/addCar.php';


        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


        xhr.onload = function () {
            console.log(xhr.responseText)   
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                console.log(response.message);
                
                window.location.href = 'car-detail.php?id=' + response.message;
            } else {
                console.error('Error: ' + xhr.status);
            }
        };

        const data = [
            car_name_input.value,
            car_beschijving_input.value,
            car_img_input.value,
            car_type_input.value,
            car_capacity_input.value,
            car_steering_input.value,
            car_gasoline_input.value,
            car_prijs_input.value,
            car_sterren_input.value,
            car_reviewers_input.value
        ];

        xhr.send(JSON.stringify(data));
    }
    triggerPHP()
})

