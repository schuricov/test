//"use strict";
//spacy.flicker('table2', 30,'#002b36','orange');       // (id, per min, color1, color2)
spacy.increaseText('caption', 1, 30);                   // (id, size text min, size text max)
spacy.appearance('menu');                               // (id)
// spacy.northernLights('topLight','bottomLight');         // (id,id)
//spacy.rotateOnClick('arrow');                           // (id)
// spacy.attenuation('font2');                          // (id)
// spacy.lettersInline('font2');                        // (id)


document.getElementById('menu').onmouseover = document.getElementById('menu').onmouseout = handler;

// тень над элементом при наведении мышкой
function handler(event) {

    if (event.type == 'mouseover') {
        event.target.style.textShadow = "0 0 30px #00ffff"
    }
    if (event.type == 'mouseout') {
        event.target.style.textShadow = ''
    }
}