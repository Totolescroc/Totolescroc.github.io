console.log ("reussi");

let card_js = document.querySelectorAll("#card-annonce");

for (var i=0; i<card_js.length; i++) {
    card_js[i].addEventListener('click', function(e) {
        var link = this.querySelector(".link-single-post");
        link.click();
    }, false)
}

let conv_js = document.querySelectorAll(".conv_all_message");



for (var i=0; i<conv_js.length; i++) {
    conv_js[i].addEventListener('click', function(e) {
        var link = this.querySelector(".link_messagerie");
        link.click();
    }, false)
}


// card_js.addEventListener('click', function () {
//     console.log("caca");
// })






