
<?php
include ('top.php');
?>
<?php
$joesPondWinners = array(
    array(2013, "Gary Clark ", "Barre, VT", "4/24/13", "8:46am"),
    array(2014, "Kelsey Phillips & Bill Brochu ", "Iowa City, IA", "4/29/14", "10:06am"),
    array(2015, "Mary Numa ", "West Haven, CT", "4/29/15", "6:14pm"),
    array(2016, "Pamela Swift ", "Barre, VT", "4/16/16", "5:04pm"),
    array(2017, "Emily Wigget ", "North Danville", "4/23/17", "4:32pm"),
);
$totalWinners = count($joesPondWinners);

?>
        <article class='lab3'>
            <h2>Last <?php print $totalWinners; ?> Winners!</h2>
            <ol>
                <?php
                   foreach($joesPondWinners as $joesPondWinner){
                       print "<li>";
                       print " Year: " . $joesPondWinner[0];
                       print " Winner: " . $joesPondWinner[1];
                       print " From: " . $joesPondWinner[2];
                       print " Date: " . $joesPondWinner[3];
                       print " Time: " . $joesPondWinner[4];
                       print "</li>";  
                   }
                ?>
            </ol>
        </article>

<?php
// print out the array here with print_r just so you can see what the computer has in memory

print "<p>Contents of the Array:</p>";
print "<pre>";
print_r($joesPondWinners);
print "</pre>";

include ('footer.php');
?>
    </body>
</html>