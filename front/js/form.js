var weight_input = document.getElementById("weight");

weight_input.addEventListener("change", function(event) {
    var new_weight = event.target.value;
    if(new_weight < 0) {
        alert("Merci d'entrer un poids positif.");
        event.target.value = "0";
    }
});

var price_input = document.getElementById("buy_price");

price_input.addEventListener("change", function(event) {
    var new_price = event.target.value;
    if(new_price < 0) {
        alert("Merci d'entrer un prix positif.");
        event.target.value = "0";
    }
});

var file_input = document.getElementById("picture");
const extension = ["jpg", "jpeg", "png", "gif"];

file_input.addEventListener("change", function(event) {
    var file = event.target.files[0];
    if(!(extension.includes((file.name.split(".")[1]).toLowerCase()))) {
        alert("Merci d'entrer une image valide.");
        event.target.value = "";
    }
});

