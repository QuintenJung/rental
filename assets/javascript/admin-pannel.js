const closePopup = document.getElementById("addCarPopupClose")
const editClosePopup = document.getElementById("editCarPopupClose")
const editCarForm = document.getElementById("editCarPopup")
const editerCarPopupClose = document.getElementById("editerCarPopupClose")
const delCarPopupClose = document.getElementById("delCarPopupClose")
const editCarOptionEditer = document.getElementById("editCarOptionEditer")
const editCarButton = document.getElementById("editCar")
const addCarButton = document.getElementById("addCar")
const delCarButton = document.getElementById("delCar")
const delCarForm = document.getElementById("delCarPopup")
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
const delCarOption = document.querySelectorAll(".delCarOption")
const editCarSubmit = document.getElementById("editCarSubmit")
const edit_name_input = document.getElementById("edit_name")
const edit_beschijving_input = document.getElementById("edit_beschijving")
const edit_img_input = document.getElementById("edit_img")
const edit_type_input = document.getElementById("edit_type")
const edit_capacity_input = document.getElementById("edit_capacity")
const edit_steering_input = document.getElementById("edit_steering")
const edit_gasoline_input = document.getElementById("edit_gasoline")
const edit_prijs_input = document.getElementById("edit_prijs")
const edit_sterren_input = document.getElementById("edit_sterren")
const edit_reviewers_input = document.getElementById("edit_reviewers")
const delCarWarning = document.getElementById("delCarWarning")
const cancelCarDel = document.getElementById("cancelCarDel")
const confirmCarDel = document.getElementById("confirmCarDel")

let delCarId = null

closePopup.addEventListener("click", () => {
    addCarForm.style.display = "none"
})
editerCarPopupClose.addEventListener("click", () => {
    editCarOptionEditer.style.display = "none"
})
delCarPopupClose.addEventListener("click", () => {
    delCarPopup.style.display = "none"
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
delCarButton.addEventListener("click", () => {
    delCarForm.style.display = "block"
})

function openEditer() {
    editCarOptionEditer.style.display = "block"
    // console.log("test")
}

editCarSubmit.addEventListener("click", () => {
    function triggerPHP() {

        const xhr = new XMLHttpRequest();
        const url = 'actions/editCar.php';


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
            edit_name_input.value,
            edit_beschijving_input.value,
            edit_img_input.value,
            edit_type_input.value,
            edit_capacity_input.value,
            edit_steering_input.value,
            edit_gasoline_input.value,
            edit_prijs_input.value,
            edit_sterren_input.value,
            edit_reviewers_input.value,
            editCarSubmit.dataset.waarde
        ];

        xhr.send(JSON.stringify(data));
    }
    triggerPHP()
})


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

function delCarWarningPopup(id) {
    delCarWarning.style.display = "block"
    delCarId = id
    console.log(delCarId)
}


cancelCarDel.addEventListener("click", () => {
    delCarWarning.style.display = "none"
    delCarId = null
})

confirmCarDel.addEventListener("click", () => {
    if (delCarId !== null) {
        function triggerPHP() {

            const xhr = new XMLHttpRequest();
            const url = 'actions/delCar.php';


            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function () {
                console.log(xhr.responseText)
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response.message);

                    window.location.href = 'home';
                } else {
                    console.error('Error: ' + xhr.status);
                }
            };

            const data = [
                delCarId
            ];

            xhr.send(JSON.stringify(data));
        }
        triggerPHP()
    }
    delCarId = null
})