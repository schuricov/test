//--------------------------------------------------------------- flicker v2 (Мигание элементом)

var elem;
var freq;
var col1, col2;

function flicker1(permin, elemID, color1,color2) {
    elem = document.getElementById(elemID);
    col1 = color1;
    col2 = color2;
    freq = 60*1000/permin; //if it is necessary per/min
    //freq = 1000/persec; //if it is necessary per/sec
    TrigOne();
}

function TrigOne() {
    elem.style.background = col1;
    setTimeout("TrigTwo();", freq);
}

function TrigTwo() {
    elem.style.background = col2;
    setTimeout("TrigOne();", freq);
}

//--------------------------------------------------------------- flicker v1 (Мигание элементом)
function flicker2(){
    if(document.bgColor == "red") {document.bgColor = "white";}
    else document.bgColor = "red";
    setTimeout(func,500);
}


//---------------------------------------------------------------
var spacy =
    {
        //flicker element
        flicker: function (elemId, permin, color1, color2) {

            var elem = document.getElementById(elemId);
            var freq = 60 * 1000 / permin; //if it is necessary per/min
            TrigOne();

            function TrigOne() {
                elem.style.background = color1;
                setTimeout(TrigTwo, freq);
            }

            function TrigTwo() {
                elem.style.background = color2;
                setTimeout(TrigOne, freq);
            }
        },

        //increase text
        increaseText: function (elemId, size_min, size_max) {
            var s = 0;

            function sizeUp(dynamic) {

                if (dynamic < size_max) {
                    s++;
                    dynamic = size_min + s;
                    // document.getElementById(elemId).setAttribute("style", "font-size:" + (dynamic * 1) + "vmin");
                    document.getElementById(elemId).setAttribute("style", "font-size:" + dynamic + "px;");
                    //console.log('dynamic-if = ' + dynamic);
                    setTimeout(sizeUp, 30, dynamic);
                }
            }

            sizeUp(10);
        },

        //letters enqueue
        lettersInline: function(elemId){

            var letter = 0;
            var divFont = document.getElementById(elemId);
            var gotText = divFont.innerHTML;
            var lenth = gotText.length;
            divFont.innerHTML = '';

            function letters() {
                if (letter < lenth) {

                    divFont.innerHTML = divFont.innerHTML + gotText.charAt(letter);
                    letter++;
                    setTimeout(letters, 100);
                }

            }

            letters();
        },


        //Northern Lights
        northernLights: function (elemIdTopLight, elemIdBottomLight){

            var x, y, r, g, b, w, w2;

            function line() {
                x = Math.random() * 300;
                y = Math.random() * 75;
                r = Math.random() * 255;
                g = Math.random() * 255;
                b = Math.random() * 255;
                w = Math.random() * 3 + 1;
                w2 = Math.random() * 2 + 1;

                document.getElementById(elemIdTopLight).setAttribute("style", "stroke-width:" + w);
                document.getElementById(elemIdBottomLight).setAttribute("style", "stroke-width:" + w2);


                document.getElementById(elemIdTopLight).setAttribute("x1", x);
                document.getElementById(elemIdTopLight).setAttribute("x2", x);
                document.getElementById(elemIdTopLight).setAttribute("y1", "75");
                document.getElementById(elemIdTopLight).setAttribute("y2", 75 - y);

                document.getElementById(elemIdBottomLight).setAttribute("x1", x);
                document.getElementById(elemIdBottomLight).setAttribute("x2", x);
                document.getElementById(elemIdBottomLight).setAttribute("y1", y / 2);
                document.getElementById(elemIdBottomLight).setAttribute("y2", "0");

                document.getElementById(elemIdTopLight).style.stroke = 'rgb('+ g +','+ b +','+ r +')';
                document.getElementById(elemIdBottomLight).style.stroke = 'rgb('+ g +','+ b +','+ r +')';

                // elemIdTopLight.style.stroke = 'rgb(' + r + ',' + g + ',' + b + ')';
                // elemIdBottomLight.style.stroke = 'rgb(' + g + ',' + b + ',' + r + ')';

                //document.getElementById("font").setAttribute("style", 'color: rgb('+ r +','+ g +','+ b +')');
                setTimeout(line, 10);

            }

            line();
        },

        //Attenuation elemet
        attenuation: function (elemId) {
            var op = 1;

            function attenuation() {
                if (op > 0.01) {
                    op = op - 0.05;
                    document.getElementById(elemId).setAttribute("style", "opacity:" + op);
                    setTimeout(attenuation, 10)
                }
                else {
                    opacityUp()
                }
            }

            function opacityUp() {
                if (op < 1) {
                    op = op + 0.005;
                    document.getElementById(elemId).setAttribute("style", "opacity:" + op);
                    setTimeout(opacityUp, 10)
                }
                else {
                    attenuation()
                }
            }

            attenuation();
        },

        //Rotate element
        rotateOnClick: function (elemId) {
            var deg = 1;
            var elem = document.getElementById(elemId);
            elem.onclick = function rot(){
                elem.style.transform = 'rotate(' +  deg/10 + 'deg)';
                elem.style.left = deg / 10 + 'px';
                deg++;
                setTimeout(rot,1);
            }
        },

        //Appaerance element
        appearance: function (elemId) {
            var op = 0;
            document.getElementById(elemId).setAttribute("style", "opacity:" + op);

            function appearance() {
                if (op < 1) {
                    op = op + 0.005;
                    document.getElementById(elemId).setAttribute("style", "opacity:" + op);
                    setTimeout(appearance, 10)
                }
            }

            // appearance();
            setTimeout(appearance, 1000);

        }


    };
























