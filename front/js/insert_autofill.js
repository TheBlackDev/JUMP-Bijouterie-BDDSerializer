

var description = document.getElementById('description');
var toReplace = new Map();
toReplace.set('é', 'e');
toReplace.set('è', 'e');
toReplace.set('ê', 'e');
toReplace.set('ë', 'e');
toReplace.set('ï', 'i');
toReplace.set('î', 'i');
toReplace.set('ô', 'o');
toReplace.set('ö', 'o');
toReplace.set('ù', 'u');
toReplace.set('û', 'u');
toReplace.set('ü', 'u');
toReplace.set('ç', 'c');
toReplace.set('ñ', 'n');
toReplace.set('ÿ', 'y');
toReplace.set('À', 'A');
toReplace.set('É', 'E');
toReplace.set('È', 'E');
toReplace.set('Ê', 'E');
toReplace.set('Ë', 'E');
toReplace.set('Ï', 'I');
toReplace.set('Î', 'I');
toReplace.set('Ô', 'O');
toReplace.set('Ö', 'O');
toReplace.set('Ù', 'U');
toReplace.set('Û', 'U');
toReplace.set('Ü', 'U');
toReplace.set('Ç', 'C');
toReplace.set('Ÿ', 'Y');
toReplace.set('ÿ', 'y');
toReplace.set('à', 'a');


function replaceVariant(strr) {
    for (let [key, value] of toReplace.entries()) {
        strr = strr.replaceAll(key, value);
    }
    return strr;
}


description.addEventListener("change", function(event) {
    let eventLC = replaceVariant(event.target.value.toLowerCase());
    let maxLength = 0;
    console.log(eventLC);
    Array.from(document.getElementsByClassName('autofill')).forEach(function(element) {
        if(element.tagName == "INPUT") {
            let datalist = document.getElementById(element.getAttribute('list'));
            maxLength = 0;
            Array.from(datalist.getElementsByTagName("option")).forEach(function(option) {
                if(option.value != "") {
                    if(eventLC.includes(replaceVariant(option.value.toLowerCase()))) {
                        if(option.value.length > maxLength) {
                            console.log(option.value);
                            maxLength = option.value.length;
                            element.value = option.value;
                        }
                    }
                }
            });

        }
        else if(element.tagName == "SELECT") {
            Array.from(element.options).forEach(function(option) {
                if(eventLC.includes(replaceVariant(option.innerText.toLowerCase()))) {
                    option.setAttribute('selected', 'selected');
                }
            });
        }
    });
    if(eventLC.includes(" g ")) {
        let splitted=eventLC.split(" ");
        let index = splitted.indexOf("g");
        let newWeight = 0;
        try {
            newWeight = splitted[index-1];
        } catch(e) {
            console.error(e);
            return;
        }
        document.getElementById('weight').value = parseInt(newWeight);            
    }
    else if(eventLC.includes(" g.")) {
        let splitted=eventLC.split(" ");
        let index = splitted.indexOf("g.");
        let newWeight = 0;
        try {
            newWeight = splitted[index-1];
        } catch(e) {
            console.error(e);
            return;
        }
        document.getElementById('weight').value = parseInt(newWeight);            
    }

});