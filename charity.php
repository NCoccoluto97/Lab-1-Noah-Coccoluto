<?php
include ('top.php');
// ****  Open Charity Data  **************************************//
$debug = false;
if(isset($_GET["debug"])){
     $debug = true; 
}

$myFolder = '';

$myFileName = 'charity';

$fileExt = '.csv';

$filename = $myFolder . $myFileName . $fileExt;

if($debug) print '<p>filename is' . $filename;

$file=fopen($filename, "r");

if($debug){
    if($file){
       print '<p>File Opened Succesful.</p>';
    }
    else{
       print '<p>File Open Failed.</p>';
     }
}
// ****  End Charity Data  **************************************//

// ****  Read Charity Data  **************************************//
if($file){
    if($debug) print '<p>Begin reading data into an array.</p>';
    }
    // read the header row, copy the line for each header row
    // you have.
    $headers[] = fgetcsv($file);
    

    if($debug) {
         print '<p>Finished reading headers.</p>';
         print '<p>My header array</p><pre>';
         print_r($headers);
         print '</pre>';
     }

     // read all the data
     while(!feof($file)){
         $charityDetails[] = fgetcsv($file);
     }

     if($debug) {
         print '<p>Finished reading data. File closed.</p>';
         print '<p>My data array<p><pre> ';
         print_r($charityDetails);
         print '</pre></p>';
     }
/* Will end if file was opened 
fclose($file);
/* End of Open File */
     
?>
<article id="content"> 
    <h2>Results of the top 4 most popular charities in order</h2>
    <ol>
        <?php
        $lastCharityOrganization = "";

        foreach ($charityDetails as $charityDetail) {
            if ($lastCharityOrganization != $charityDetail[1]) {
                if ($charityDetail[1] != '') {
                    print '<li>';
                    print'<a href = "charity-detail.php?charityOrganization=';
                    print str_replace(' ', '', $charityDetail[1]);
                    print '">';
                    print $charityDetail[0];
                    print '</a>';
                    print '</li>';
                    $lastCharityOrganization = $charityDetail[1];
                }
            }
        }
        ?>
    </ol>
</article>
<?php
include ('footer.php');
?> 
</body>
</html>
        