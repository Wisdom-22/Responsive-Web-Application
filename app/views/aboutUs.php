<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fitness</title>
    <!-- Linking the CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <?php
        // Including the header file which presumably contains the navigation menu and logo
        include "header.php";
    ?>

    <!-- Section for displaying the main banner image and text for the developers' page -->
    <section class="classImageContainer">
        <div class="successStoriesMainImage">
            <!-- Main image for the developers' section -->
            <img src="../../public/images/developerImage.jpeg"> 
            <div class="banner-text">
                <!-- Text overlay on the banner image -->
                <h1>About Our Developers</h1>
                <p>Here are our website Developers.</p>
            </div>
        </div>
    </section>
    
    <!-- Section containing individual developer information -->
    <section class="aboutUsContainer">
        <!-- First developer section -->
        <section class="developer">
            <div class="imageDeveloper">
                <!-- Image of the first developer -->
                <img src="../../public/images/me.png"> 
            </div>
            
            <div class="developerDescription">
                <h1>About Myself</h1>
                <p>
                    <!-- Description of the first developer -->
                    Hey there! I am Binam Shrestha, a computer enthusiast with a love for sports and exploration. When I'm not diving into the world of algorithms and programming, you can find me on the basketball court or football field, honing my skills and enjoying the thrill of the game! And when I'm not busy with that, I'm off exploring new places and soaking up different cultures. Oh, and did I mention I'm a bit of a gamer too? Whether it's mobile games on the go or computer games at home, I love diving into virtual worlds and experiencing new adventures. Whether it's coding or gaming, I'm always up for a challenge and eager to learn something new. 
                </p>
            </div>
        </section>
        
        <!-- Second developer section -->
        <section class="developer">
            <div class="imageDeveloper">
                <!-- Image of the second developer -->
                <img src="../../public/images/wisdom.jpg"> 
            </div>
            
            <div class="developerDescription">
                <h1>About Myself</h1>
                <p>
                    <!-- Description of the second developer -->
                    My name is Chukwuemeka Wisdom Arinze. I am from Nigeria specifically from the Igbo tribe, currently studying at Griffith College Dublin. I am in 27 years old and love football and basketball. My favorite food is a Nigerian dish that called pounded yam and white soup. My favourite football team is Arsenal football club and my favourite basketball team is the Milwaukee Bucks. 
                </p>
            </div>
        </section>
    </section>

    <?php
        // Including the footer file which presumably contains footer information and links
        include "footer.php";
    ?>
</body>
</html>
