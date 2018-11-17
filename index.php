<!DOCTYPE HTML>
<html>
​
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="about.html" rel="import" >
</head>

<body>
<div id="body_page">

    <div id="header">
        <div id="caption" > <span style="font-weight: bold;">Onion</span> Omega2<span id="44">+</span> </div>
        <table id="menu">
            <tr>
                <td class="menu" id="main">Ports</td>
                <td class="menu" >| </td>
                <td class="menu" id="about">Get</td>
                <td class="menu" >|</td>
                <td class="menu" id="feedback">Set</td>
            </tr>
        </table>
    </div>

    <div id="content">

        <table id="onion-diagram">
            <tr>
                <td id="onion-diagram-l" > <table id="onion-diagram-tab-1" style="border-collapse: collapse;"> <tbody></tbody> </table> </td>
                <td> <img id="onion-diagram-img" src="pinout-diagram2.png" alt="onion omega 2+ pinout diagram"> </td>
                <td id="onion-diagram-r"> <table id="onion-diagram-tab-2" style="border-collapse: collapse;"> <tbody></tbody> </table> </td>
            </tr>
        </table>

    </div>

    <div id="pin-buttons">
        <input id="button-on" type="button" onclick="request('set', 44, 0)" value="On"/>
        <input id="button-off" type="button" onclick="request('set', 44, 1)" value="Off"/>
        <input id="button-44" type="button" onclick="request('get', 44)" value="Get"/>
        <input id="button-44" type="button" onclick="request('getdir', 44)" value="Get dir"/>
        <input id="button-44" type="button" onclick="request('setdir', 44, 1)" value="Set dir in"/>
        <input id="button-44" type="button" onclick="request('setdir', 44, 0)" value="Set dir out"/>
        <input id="button-all" type="button" onclick="request('getall')" value="Get all"/>

        <input id="refresh" type="button" onclick="trigger()" value="Refreshing Off"/>
        <input type="button" onclick="makeTable();" value="Create"></td>
    </div>

    <div id="footer">
        <table id="footer-table" ">
        <tr><td id="left">xxz<span>@</span>ukr.net</td><td id="right">Sartoi Djiovani Creative-TM &copy; 2016+ </td></tr>
        </table>
    </div>

</div>
</body>

</html>

</body>

<script>
    var i, k, tr, td, id = 0;
    makeTable();

    // creating table
    function makeTable() {

        var allgpio = ['GND',11,3,2,17,16,15,46,45,9,8,7,6,1,0,'RST','GND','VIN','D+','D-',13,12,38,'VOUT','TX-','TX+','RX-','RX+',18,19,4,5]; // Omega omion2+
        for (k = 1; k < 3; k++) {

            for (i = 0; i < allgpio.length/2; i++) {

                tr = document.createElement('tr');
                td = tr.appendChild(document.createElement('td'));
                td.textContent = allgpio[id];
                td.style.color = "white";
                td.setAttribute('id', allgpio[id++]);
                document.getElementById('onion-diagram-tab-' + k).tBodies[0].appendChild(tr);
            }
        }
    }
</script>

<script src="lib.js" > </script>
<script src="controller.js"> </script>
<script>

    // Set color of pins
    function setColor(json) {

        json.forEach(function(value, key) {
            // console.log(value);

            if (value['val'] == 1 & value['cmd'] == 'Read') {
                document.getElementById(value['pin']).style.background = "rgba(0, 255, 0, 0.5)";
            }
            if (value['val'] == 0 & value['cmd'] == 'Read') {
                document.getElementById(value['pin']).style.background = "rgba(255, 0, 0, 0.5)";
            }

        });

    }

    // AJAX
    // Get status for pins (type: [get, set getdir, setdir, getall] gpio: [1 - 44] val1:  value [0, 1])

    function request(type, gpio, val1 = null, val2 = null) {
        // console.log('Request ->');

        var xhr = new XMLHttpRequest;
        var params =
            type + '=' + encodeURIComponent(val1) +
            '&' + 'gpio=' + encodeURIComponent(gpio)
        ;
        xhr.open('GET', 'Routing.php/?' + params, true);    // url
        xhr.responseType = 'text';                          // default
        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4) {
                xhr.onreadystatechange = null;

                if (xhr.status == 200) {

                    var data = xhr.response;
                    // var data = xhr.responseText;
                    // console.log(data);

                    var json = JSON.parse(data);
                    // console.log(json);

                    setColor(json);                                                                                     // function sets up for all id on the page got from request
                }
            }
        };

        xhr.send(null);                                     // body
    }

    // Trigger
    function trigger() {
        var refresh = document.getElementById('refresh');
        if (refresh.value == 'Refreshing Off'){
            refresh.style.color = 'red';
            refresh.value = 'Refreshing On';
            refreshMe(true);
            return;
        }
        if (refresh.value == 'Refreshing On'){
            refresh.style.color = 'black';
            refresh.value = 'Refreshing Off';
            refreshMe(false);
            return;
        }

        // refresh(10);
    }


    // Refresh timer
    function refreshMe(bool) {

        var sec = 5;

        if (bool) {
            console.log('Refreshing status pin is ON to ' + sec + 'sec');
            timer = setInterval(function () {
                request('getall');
            }, sec * 1000);

        } else {
            console.log('Refreshing status pin is OFF');
            clearInterval(timer);

        }

    }

</script>

<!--init page-->
<script>
    request('getall');
</script>

</html>

<?php
// get from url

//require_once 'Routing.php';
//$init = new Routing();
//$init->init();

//    $arr = [
//            '43' => ['val' => '0', 'dir' => '1'],
//            '44' => ['val' => '1', 'dir' => '0'],
//    ];
//
//    echo print_r(json_encode($arr), 1);