<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* The Modal (background) */
        .codeModal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .side {
            direction: ltr;
        }

    </style>
</head>

<body class="bg-light">
    <div id="app">

        @include('include.navbar')
        <div class="container">
            @include('include.messages')
            <main id="main1" class="py-4 side">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
        <script>
            // Get the modal
            var modal = document.getElementsByClassName("codeModal");
    
            // Get the button that opens the modal
            var btn = document.getElementsByClassName("btn btn-info");
    
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close");
    
            // When the user clicks the button, open the modal 
            function disModal(i) {
                modal[i].style.display = "block";
            }
    
            // When the user clicks on <span> (x), close the modal
            function closeModal(i) {
                modal[i].style.display = "none";
            }
    
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event, i) {
                if (event.target == modal[i]) {
                    modal[i].style.display = "none";
                }
            }
    
            var timer;
            var timeRemaining;
            var counter=1;
            var number =0;
            // var submitTime;
    
            function startTimer(time) {
                //Set time remaining based on input.
                timeRemaining = time * 60;
                //Sets timer for first second. 
                id("timer").textContent = timeConversion(timeRemaining);
                //Sets timer to update every second.
                timer = setInterval(function() {
                    timeRemaining--;
                    //if no time remaining end the game.
                    if (timeRemaining == 0) {
                        document.getElementById('quizForm').submit();
                    }
                    id("timer").textContent = timeConversion(timeRemaining);
                }, 1000)
            }
            
            function getRemainingTime(){
                id('TR').value= timeRemaining;
            }
            // function calcTimeNow(time, timeRemaining){
            //     submitTime = time - timeRemaining;
            // }
    
            function timeConversion(time) {
                let minutes = Math.floor(time / 60);
                if (minutes < 10) minutes = "0" + minutes;
                let seconds = time % 60;
                if (seconds < 10) seconds = "0" + seconds;
                return minutes + ":" + seconds;
            }
    
            function id(id) {
                return document.getElementById(id);
            }
    
            function startQuiz(time,num) {
                if(counter==num){
                    id('sub').classList.remove("hidden");
                    id('nextQuestion').classList.add("hidden");
                }
                    id("Quiz-container").classList.remove("hidden");
                    id("Quiz-container2").classList.add("hidden");
                    id('question1').classList.remove("hidden");
                    number=num;
                
                startTimer(time);
            }

            function nextQuestion(){
                id('question'+ counter++).classList.add("hidden");
                id('question'+ counter).classList.remove("hidden");
                if(counter==number){
                    id('sub').classList.remove("hidden");
                    id('nextQuestion').classList.add("hidden");
                }
            }
    
            window.onload = function changeSides() {
                if ({{ LaravelLocalization::setLocale() }} == ar)
                    document.getElementById("main1").style.direction = "rtl";
                else {
                    document.getElementById("main1").style.direction = "ltr";
                }
    
            }
        </script>    
    </body>
</html>
