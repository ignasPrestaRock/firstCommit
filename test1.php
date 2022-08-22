<?php require 'connection.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <style>
        table {
            width: 50%;
        }
        th {
            background: #f1f1f1;
            font-weight: bold;
            padding: 6px;
        }
        td {
            background: #f9f9f9;
            padding: 6px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MySQL tasks</title>
</head>
<body>


<h2>JavaScript calculator:</h2>

<input id="one" type="text">
<select id="action">
    <option>+</option>
    <option>-</option>
    <option>*</option>
    <option>/</option>
</select>
<input id="two" type="text">
<button onclick="test()" type="submit">Calculate</button>
<p id="test1"></p>

<button onclick="forLoop()" type="submit">Loop submit</button>
<p id="loop">This is results of all possible action by given numbers</p>
<button id="live">Hide results</button>

<button id="ajax">Ajax</button>
<table id="myTable">
    <tr>
        <th>Zipcode</th>
        <th>City</th>
        <th>County</th>
    </tr>
</table>
<button id="ajax2">Ajax2JSON</button>
<div id="content"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery-->a
<script>
    $(document).ready(function (){
        $("#live").on("click", function() {
            $("#loop").slideToggle();
        });
        $("#live").hover(function (){
            $( this ).fadeOut( 50 );
            $( this ).fadeIn( 500 );
        })

        $('#ajax').on("click",function (){
            $.ajax(
                '../test.php',
                {
                    type:'GET',
                    success: function(data, status) {
                        $('#content').html(data);
                    },
                    error: function() {
                        alert('There was some error performing the AJAX call!');
                    }
                }
            );
        })

        $('#ajax2').on("click",function (){
            $.ajax({
                url: 'data.json',
                dataType: 'json',
                success: function(data) {
                    for (var i=0; i<data.length; i++) {
                        var row = $('<tr><td>' + data[i].zipcode+ '</td><td>' + data[i].city + '</td><td>' + data[i].county + '</td></tr>');
                        $('#myTable').append(row);
                    }
                },
                error: function() {
                    alert('There was some error performing the AJAX call!');
                }
            });
        })

    });
</script>
<!-- JavaScript funkcijos-->
<script>
    // function test() {
    //     var a = document.getElementById("one").value;
    //     var b = document.getElementById("two").value;
    //     var action = document.getElementById("action").value;
    //     var result;
    //     switch (action) {
    //         case '+':
    //             result = +a + +b;
    //             break;
    //         case '-':
    //             result = a - b;
    //             break;
    //         case '/':
    //             result =  a / b;
    //             break;
    //         case '*':
    //             result = a * b;
    //             break;
    //         default:
    //             result = "Something went wrong";
    //             break;
    //     }
    //     document.getElementById("test1").innerHTML = result;
    // }

    function test() {
        var a = document.getElementById("one").value;
        var b = document.getElementById("two").value;
        var action = document.getElementById("action").value;
        var result;
        if (action == "+") {
            result = +a + +b;
        } else if (action == "-") {
            result = a - b;
        } else if (action == "/") {
            result = a / b;
        } else if (action == "*") {
            result = a * b;
        }
        document.getElementById("test1").innerHTML = result;
    }

    function forLoop() {
        var selectOptions = document.getElementById("action");
        var a = document.getElementById("one").value;
        var b = document.getElementById("two").value;
        var result;
        var text = "";
        for (i = 0; i < selectOptions.options.length; i++) {
            switch (selectOptions.options[i].value) {
                case '+':
                    result = +a + +b;
                    console.log((result));
                    break;
                case '-':
                    result = a - b;
                    console.log((result));
                    break;
                case '/':
                    result = a / b;
                    console.log((result));
                    break;
                case '*':
                    result = a * b;
                    console.log((result));
                    break;
                default:
                    result = "Something went wrong";
                    break;
            }
            text += "The number is: " + result + "<br>";
        }
        document.getElementById("loop").innerHTML = text;
    }

</script>
</body>
</html>
