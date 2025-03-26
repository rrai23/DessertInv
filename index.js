const buttonViewInv = document.getElementById("button-view-inv");
const buttonAddItem = document.getElementById("button-add-item");
const inventoryTableDiv = document.getElementById("inventory-table-div");
const addItemFormDiv = document.getElementById("add-item-form-div");

function showElement(toShow, toHide){
    toShow.classList.remove("hidden");
    toHide.classList.add("hidden");
}

buttonViewInv.addEventListener('click', () => {
    showElement(inventoryTableDiv, addItemFormDiv);
})

buttonAddItem.addEventListener('click', () => {
    showElement(addItemFormDiv, inventoryTableDiv);
})