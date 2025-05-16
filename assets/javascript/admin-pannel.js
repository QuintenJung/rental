const closePopup = document.getElementById("addCarPopupClose")
const addCarButton = document.getElementById("addCar")
const addCarForm = document.getElementById("addCarPopup")
const voeg_toe_button = document.getElementById("addCarSubmit")
const car_name_input = document.getElementById("car_name")
const car_beschijving_input= document.getElementById("car_beschijving")
const car_img_input= document.getElementById("car_img")
const car_type_input= document.getElementById("car_type")
const car_capacity_input= document.getElementById("car_capacity")
const car_steering_input= document.getElementById("car_steering")
const car_gasoline_input= document.getElementById("car_gasoline")
const car_prijs_input= document.getElementById("car_prijs")
const car_sterren_input= document.getElementById("car_sterren")
const car_reviewers_input= document.getElementById("car_reviewers")

closePopup.addEventListener("click", () => {
    addCarForm.style.display = "none"
})
addCarButton.addEventListener("click", () => {
    addCarForm.style.display = "block"
})
voeg_toe_button.addEventListener("click", () => {
    
})

