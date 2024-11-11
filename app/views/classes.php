<?php
    // Include the header file which presumably contains the navigation menu and logo
    include "header.php";
?>

<!-- Section for displaying the main image and banner text for classes -->
<section class="classImageContainer">
    <div class="successStoriesMainImage">
        <img src="../../public/images/classesImages.jpeg"> 
        <div class="banner-text">
            <h1>Classes</h1>
            <p>Here are the classes we offer in our gym.</p>
        </div>
    </div>
</section>

<!-- Section for displaying the different classes available in the gym -->
<section class="classesContainer">
    <!-- Class 1: Pilates -->
    <div class="classes">
        <img src="../../public/images/pilates.jpeg"> 
        <div class="classesHeading">
            <h1>PILATES</h1>
        </div>
        <div class="classesDescription">
            <p>Lorem ipsum dolor sit amet</p>
            <button type="button" class="classJoinToday">Join Today</button>
            <a href="pilates.php">
                <button type="button" class="explainMore">Explore More</button>
            </a>
        </div>  
    </div>
    
    <!-- Class 2: Boxing -->
    <div class="classes">
        <img src="../../public/images/boxing.jpeg"> 
        <div class="classesHeading">
            <h1>BOX</h1>
        </div>
        <div class="classesDescription">
            <p>Lorem ipsum dolor sit amet</p>
            <button type="button" class="classJoinToday">Join Today</button>
            <a href="box.php">
                <button type="button" class="explainMore">Explore More</button>
            </a>
        </div>  
    </div>
    
    <!-- Class 3: Heated Polar -->
    <div class="classes">
        <img src="../../public/images/heatedPolar.jpeg"> 
        <div class="classesHeading">
            <h1>HEATED POLAR</h1>
        </div>
        <div class="classesDescription">
            <p>Lorem ipsum dolor sit amet</p>
            <button type="button" class="classJoinToday">Join Today</button>
            <a href="heatedPolar.php">
                <button type="button" class="explainMore">Explore More</button>
            </a>
        </div>  
    </div>      
</section>

<!-- Section encouraging users to join the community -->
<div class="joinCommunity">
    <h1>Join Community</h1>
    <form class="joinCommunityForm">
        <button type="button" class="joinToday">Join Today</button>
    </form>
    <img src="../../public/images/communityImage.jpeg"> 
</div>

<?php 
    // Include the footer file which presumably contains footer information and links
    include "footer.php";
?>  
