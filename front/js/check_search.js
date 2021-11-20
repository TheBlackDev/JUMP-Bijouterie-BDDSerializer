for (let input of document.getElementsByClassName("toCheck")) {
    input.addEventListener("change", function(event) {
        let newValue = event.target.value;
        event.target.value = newValue.toLowerCase();
        newValue = event.target.value;
        console.log(newValue);
        
        let contains = (newValue=="");
        
        for (let option of input.list.options) {
            console.log(option.value);
            if(option.value.toLowerCase() == newValue) {
                contains = true;
            }
        }
        if(!contains) {
            alert("Merci d'entrer une valeur existante dans la base de donnée.");
            event.target.value = "";
        }
    });
}

