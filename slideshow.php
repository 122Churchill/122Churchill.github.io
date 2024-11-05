<?php
/*
    This page uses PHP to scan a folder for files, then randomizes their
    order and displays them one after the other with a transition. The
    cycle loops and keeps the same order until the page is reloaded.
    
    1. Create a folder next to this file named 'images' and put your 
       images in that. 
    2. Adjust the transition time and/or the display time in the places
       noted below to your liking.
    3. Open the page through localhost or whatever local domain you have
       through a PHP enabled web server and it should just work.
*/
function getImages() {
    $images = array_slice(scandir('images/'), 2);
    echo "['".implode("','", $images)."']";
}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style >
            body {
                background-color: transparent;
                margin: 0;
                padding: 0;
            }
            .container {
                position: absolute; top: 0; left: 0;
                width: 100%;
                height: 100%;
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center;
            }
            div {
                opacity: 0;
                transition: opacity 1s linear; /* Set the transition time here */
            }
        </style>
    </head>
    <body>
        <div id="container1" class="container"></div>
        <div id="container2" class="container"></div>
        <script>
            var images = <?=getImages()?>;
            shuffleArray(images);
            var $container1 = $('#container1:first');
            var $container2 = $('#container2:first');
            var i = 0;
            loop(images);

            function loop(images) {
                setTimeout(() => {
                    var index = i%2;
                    if(index) {
                        $container1.css('background-image', 'url(images/'+images[i%images.length]+')');                       
                    } else {
                        $container2.css('background-image', 'url(images/'+images[i%images.length]+')');
                    }
                    $container1.css('opacity', index);
                    $container2.css('opacity', 1-index);
                    $container1.css('z-index', index);
                    $container2.css('z-index', 1-index);
                    i++;
                    loop(images);
                }, 3000); // Set the display time here
            }
            
            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }
        </script>
    </body>
</html>

