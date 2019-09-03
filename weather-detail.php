<?php

include ('top.php');

$weatherStation = '';
if(isset($_GET['weatherStation'])) {
    $weatherStation=htmlentities($_GET['weatherStation'],ENT_QUOTES,"UTF-8");
}
/* Open Weather Data */
$debug = false;
if (isset($_GET["debug"])) {
    $debug = true;
}

$myFolder = '';

$myFileName = 'weather';

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
        $weatherDetails[] = fgetcsv($file);
    }

    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($weatherDetails);
        print '</pre></p>';
    }
} /* Will end if file was opened 
  fclose($file);
  /* End of Open File */
?>
<article id="content"> 
    <h2>The Weather For Your Area</h2>
    <table>
        <?php
        foreach ($headers as $header) {
            print '<tr>';
            print '<th>' . $header[0] . '</th>';
            print '<th>' . $header[1] . '</th>';
            print '<th>' . $header[2] . '</th>';
            print '<th>' . $header[3] . '</th>';
            print '<th>' . $header[4] . '</th>';
            print '<th>' . $header[5] . '</th>';
            print '<th>' . $header[6] . '</th>';
            print '<th>' . $header[7] . '</th>';
            print '<th>' . $header[8] . '</th>';
            print '<th>' . $header[9] . '</th>';
            print '</tr>' . PHP_EOL;
        }
        
        $totalWeatherDetail = 0;
        
        foreach ($weatherDetails as $weatherDetail){
                
            $thisWeatherStation = str_replace(' ', '', $weatherDetail[1]);
                
            if ($weatherStation == $thisWeatherStation) {
                $totalWeatherDetail++;
            
        
                print '<tr>';
                print '<td>' . $weatherDetail[0] . '</td>';
                print '<td>' . $weatherDetail[1] . '</td>';
                print '<td>' . $weatherDetail[2] . '</td>';
                print '<td>' . $weatherDetail[3] . '</td>';
                print '<td>' . $weatherDetail[4] . '</td>';
                print '<td>' . $weatherDetail[5] . '</td>';
                print '<td>' . $weatherDetail[6] . '</td>';
                print '<td>' . $weatherDetail[7] . '</td>';
                print '<td>' . $weatherDetail[8] . '</td>';
                print '<td>' . $weatherDetail[9] . '</td>';

                print '</tr>' . PHP_EOL;
            
            }
        }
        print'<tr><td colspan="10">' . $totalWeatherDetail . ' Total Daily Observations</td></tr>';

            ?>
        </table>

    </article>
    <?php
    include ('footer.php');
    ?>
</body>
</html>