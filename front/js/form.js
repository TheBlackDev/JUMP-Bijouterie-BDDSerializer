var weight_input = document.getElementById("weight");

weight_input.addEventListener("change", function(event) {
    var new_weight = event.target.value;
    if(new_weight < 0) {
        alert("Merci d'entrer un poids positif.");
        event.target.value = "";
    }
});

var price_input = document.getElementById("buy_price");

price_input.addEventListener("change", function(event) {
    var new_price = event.target.value;
    if(new_price < 0) {
        alert("Merci d'entrer un prix positif.");
        event.target.value = "";
    }
});

var file_input = document.getElementById("picture");
const extension = ["jpg", "jpeg", "png", "gif"];


/*
file_input.addEventListener("change", function(event) {
    var file = event.target.files[0];
    if(!(extension.includes((file.name.split(".")[1]).toLowerCase()))) {
        alert("Merci d'entrer une image valide.");
        event.target.value = "";
    }
});*/

var media_state = 0;

function openmediaadd() {
    document.getElementById("mediamask").setAttribute("class", "mask temp");
    setTimeout(function() { document.getElementById("mediamask").setAttribute("class", "mask active"); }, 1); 
    media_state = 1;
}

function closemediaadd() {
    document.getElementById("mediamask").setAttribute("class", "mask temp");
    setTimeout(function() {
        document.getElementById("mediamask").setAttribute("class", "mask");
    }, 400);    
    media_state = 0;
}

function cancelmediaadd() {
    document.getElementById("file").value = "";
    closemediaadd();
}

function removeimage(buttonClicked) {
    let id = buttonClicked.getAttribute("image_id");
    document.location.href = "removeimage.php?id=" + id;
}

function resetmediaadd() {
    document.location.href = "removeimage.php?reset=1";
}