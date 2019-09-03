<?php
include ('top.php');
$images = array(
    array(1,"aspen-trees.jpg","Aspens, Northen New Mexico", "Ansel Adams"),
    array(2,"bristlecone-pine.jpg","Jeffrey Pine, bristlecone pine, Sentinel Dome", "Ansel Adams"),
    array(3,"valley-view.jpg","Yosemite Valley View (Early Summer)", "Ansel Adams"),
    array(4,"sand-dunes.jpg","Sand Dunes (1950)", "Ansel Adams"),
    array(5,"half-dome.jpg","Moon and Half Dome, Yosemite National Park, 1960", "Ansel Adams"),
    array(6,"snake-river.jpg","Tetons and The Snake River, Grand Teton National Park", "Ansel Adams"),
);
?>
    <article id="content"> 
        <h2>Nature Photography</h2>
<?php         
            foreach($images as $image){
                print '<figure class="roundedCornersSmall fiftyPercent">';
                print '<img alt="" class="roundedCornersSmall" src="../images/' . $image[1] . '">';
                print '<figcaption>';
                print $image[2];
                print '</figcaption>';
                print '</figure>';
            }
            ?>
            <h2>Animated image of Ansel Adams top 3 pictures.</h2>
            <figure class="roundCornersSmall fiftyPercent animated">
                <img alt="Series of Adams' images" class="roundedCornersSmall" src="../images/critters.gif">
                <figcaption>Photographer: Ansel Adams <br>Animated Image</figcaption>
            </figure>
            
            <h2>Transparent image of plant.</h2>
            <figure class="roundCornersSmall fiftyPercent transparent">
                <img alt="Transparent Plant" class="roundedCornersSmall" src="../images/Nature2.png">
                <figcaption>Photographer: Billy Graham's Camera <br>Transparent Image</figcaption>
                </figure>
        </article><!-- end content -->
        <?php
include ('footer.php');
?> 
    </body>
</html>