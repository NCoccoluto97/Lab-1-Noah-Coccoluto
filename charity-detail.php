<?php

include ('top.php');

$charityOrganization = '';
if(isset($_GET['charityOrganization'])) {
    $charityOrganization=htmlentities($_GET['charityOrganization'],ENT_QUOTES,"UTF-8");
}
/* Open Charity Data */
$debug = false;
if (isset($_GET["debug"])) {
    $debug = true;
}

$myFolder = '';

$myFileName = 'charity';

$fileExt = '.csv';

$filename = $myFolder . $myFileName . $fileExt;

if ($debug)
    print '<p>filename is ' . $filename;

$file = fopen($filename, "r");

if ($debug) {
    if ($file) {
        print '<p>File Opened Succesful.</p>';
    } else {
        print '<p>File Open Failed.</p>';
    }
}
/* End of Opening Data File */

/* Read Data File */
if ($file) {
    if ($debug)
        print '<p>Begin reading data into an array.</p>';

    // read the header row, copy the line for each header row
    // you have.
    $headers[] = fgetcsv($file);

    if ($debug) {
        print '<p>Finished reading headers.</p>';
        print '<p>My header array</p><pre>';
        print_r($headers);
        print '</pre>';
}

    /* Will read all the data */
    while (!feof($file)) {
        $charityDetails[] = fgetcsv($file);
    }

    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($charityDetails);
        print '</pre></p>';
    }
} /* Will end if file was opened 
  fclose($file);
  /* End of Open File */
?>
<article id="content"> 
    <h2>The Charities from Hot Take</h2>
    <table>
        <?php
        foreach ($headers as $header) {
            print '<tr>';
            print '<th>' . $header[0] . '</th>';
            print '<th>' . $header[1] . '</th>';
            print '<th>' . $header[2] . '</th>';
            print '<th>' . $header[3] . '</th>';
            print '<th>' . $header[4] . '</th>';
            print '</tr>' . PHP_EOL;
        }
        
        $totalCharityDetail = 0;
        
        foreach ($charityDetails as $charityDetail){
                
            $thisCharityOrganization = str_replace(' ', '', $charityDetail[1]);
                
            if ($charityOrganization == $thisCharityOrganization) {
                $totalCharityDetail++;
            
        
                print '<tr>';
                print '<td>' . $charityDetail[0] . '</td>';
                print '<td>' . $charityDetail[1] . '</td>';
                print '<td>' . $charityDetail[2] . '</td>';
                print '<td>' . $charityDetail[3] . '</td>';
                print '<td>' . $charityDetail[4] . '</td>';
                print '</tr>' . PHP_EOL;
            
            }
        }
        print'<tr><td colspan="5">' . $totalCharityDetail . ' Total Charities</td></tr>';

            ?>
        </table>

    </article>
    <?php
    include ('footer.php');
    ?>
</body>
</html>