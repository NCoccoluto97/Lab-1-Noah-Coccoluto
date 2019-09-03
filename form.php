<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){  // later you can uncomment the if statement
// print '<p>Post Array:</p><pre>';
// print_r($_POST);
// print '</pre>';
// }
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$thisURL = $domain . $phpSelf;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

$firstName = "";
$regis1 = "";
$address = "";
$phonenumber = "";
$joinme = "";
$age = "";
$email = "";

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.

$firstNameERROR = false;

$emailERROR = false;
////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();
// 
// have we mailed the information to the user?
$mailed = false;
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
    //@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    // 
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page. ';
        $msg .= 'Security breach detected and reported.</p>';
        die($msg);
    }
    //@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;


    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;



    //@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }

    if ($email == "") {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }


    //@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        if ($debug)
            print PHP_EOL . '<p>Form is valid</p>';

        //@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.   
        $myFolder = '../data/';

        $myFileName = 'registration';

        $fileExt = '.csv';

        $filename = $myFolder . $myFileName . $fileExt;
        if ($debug)
            print PHP_EOL . '<p>filename is ' . $filename;

        // now we just open the file for append
        $file = fopen($filename, 'a');
        // write the forms informations
        fputcsv($file, $dataRecord);
        // close the file
        fclose($file);
        //@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).

        $message = '<h2>Your information.</h2>';

        foreach ($_POST as $htmlName => $value) {

            $message .= '<p>';
            // breaks up the form names into words. for example
            // txtFirstName becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

            foreach ($camelCase as $oneWord) {
                $message .= $oneWord . ' ';
            }

            $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
        }

        //@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = '';
        $bcc = '';

        $from = 'WRONG site <customer.service@yoursite.com>';

        // subject of mail should make sense to your form
        $subject = 'Changing Earth: ';

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end form is valid
}   // ends if form was submitted.
//#########################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">

    <?php
//################
//
// SECTION 3a. 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print '<h2>Thank you for providing your information.</h2>';
        print '<p>For your records a copy of this data has ';

        if (!$mailed) {
            print "not ";
        }


        print 'been sent:</p>';
        print '<p>To: ' . $email . '</p>';
        print $message;
    } else {

        print '<h2 class="joinme">Register to become an Authorized seller below.</h2>';

        //################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form

        if ($errorMsg) {
            print '<div id="errors">' . PHP_EOL;
            print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
            print '<ol>' . PHP_EOL;
            foreach ($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }

            print '</ol>' . PHP_EOL;
            print '</div>' . PHP_EOL;
        }
        //################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line ??)
          or the value they typed in (line ??)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>

        <form action="<?php print $phpSelf; ?>"
              id="frmRegister"
              method="post">

            <fieldset class="contact">
                <legend>Contact Information</legend>
                <p>
                <label class="required text-field" for="txtFirstName">Enter Your First and Last Name Below:</label>  
                <input autofocus
                <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                       id="txtFirstName"
                       maxlength="45"
                       name="txtFirstName"
                       onfocus="this.select()"
                       placeholder="Full Name:"
                       tabindex="100"
                       type="text"
                       value="<?php print $firstName; ?>"                    
                       >                    
                </p>

                <p>
                <label class="required text-field" for="txtPhoneNumber">Enter Your Phone Number Below:</label>  
                <input autofocus
                <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                       id="txtPhoneNumber"
                       maxlength="45"
                       name="txtPhoneNumber"
                       onfocus="this.select()"
                       placeholder="Phone Number:"
                       tabindex="100"
                       type="text"
                       value="<?php print $phonenumber; ?>"                    
                       >                    
                </p>
                
                <p>
                <label class="required text-field" for="txtAddress">Enter Your Home Address/P.O. Box Below:</label>  
                <input autofocus
                <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                       id="txtAddress"
                       maxlength="45"
                       name="txtAddress"
                       onfocus="this.select()"
                       placeholder="Address/P.O. Box:"
                       tabindex="100"
                       type="text"
                       value="<?php print $address; ?>"                    
                       >                    
                </p>
                
                <p>   
                <label class="required text-field" for="txtEmail">Enter your eMail Address Below:</label>
                <input 
                <?php if ($emailERROR) print 'class="mistake"'; ?>
                    id="txtEmail"
                    maxlength="45"
                    name="txtEmail"
                    onfocus="this.select()"
                    placeholder="eMail Address:"
                    tabindex="120"
                    type="text"
                    value="<?php print $email; ?>"
                    >
                </p>
            </fieldset> <!-- ends contact -->

            <fieldset class="radio <?php if ($ageERROR) print ' mistake'; ?>">
                <legend>How old are you?</legend>
                <p>
                <label class="radio-field">
                    <input type="radio" 
                           id="Age18" 
                           name="AgeAge" 
                           value="Under 18" 
                           tabindex="572"
                           <?php if ($age== "Under 18") echo ' checked="checked" '; ?>>
                    Under 18 years old</label>
                </p>

                <p>    
                <label class="radio-field">
                    <input type="radio" 
                           id="age30" 
                           name="AgeAge" 
                           value="18-30" 
                           tabindex="582"
                           <?php if ($age == "1830") echo ' checked="checked" '; ?>>
                    18-30 years old</label>
                </p>

                <p>    
                <label class="radio-field">
                    <input type="radio" 
                           id="age55" 
                           name="AgeAge" 
                           value="31-55" 
                           tabindex="582"
                           <?php if ($age == "3155") echo ' checked="checked" '; ?>>
                    31-55 years old</label>
                </p>

                <p>    
                <label class="radio-field">
                    <input type="radio" 
                           id="age56" 
                           name="AgeAge" 
                           value="Over 55" 
                           tabindex="582"
                           <?php if ($age == "Over55") echo ' checked="checked" '; ?>>
                    Over 55 years old</label>
                </p>
            </fieldset>

            <fieldset>
                <legend>Where Did you Come From?</legend>
                <p>How did you find out about Hot Take?</p>
                <select name="howFindOut"> 

                    <option value="OnlineAd">Online Advertisement</option>
                    <option value="Mouth">Word of Mouth</option>
                    <option value="Event">At a Hot Take event</option>
                    <option value="CSFair">At the CS Fair</option>
                    <option value="Random">Randomly Stumbled upon it</option>
                    <option value="Other">Other</option>
                    
                </select>
            </fieldset>
            
            <fieldset>
                <legend>Reaching Out To You</legend>
                <p> How can we contact you if need be? Check all that apply.
                    <br />
                    <input type="checkbox" name="tlkCommunicationEMAILPreference"
                      value="eMail" checked="checked" /> eMailing you
                    <input type="checkbox" name="tlkCommunicationCALLPreference"
                      value="Call" /> Calling you
                    <input type="checkbox" name="tlkCommunicationTEXTPreference"
                      value="Text" /> Texting you   
                    <input type="checkbox" name="tlkCommunicationMAILPreference"
                      value="Mail" /> Mailing you                    
                </p>
            </fieldset>
            
            <fieldset class="contact">
                <legend>In Closing</legend>
                <p>If you have any questions or comments about the registration process, please put them below.
                <br />
                <textarea class="regis1" rows="4" cols="50" id="comment">
                </textarea>
                </p>
        </fieldset>
            
            <fieldset class="buttons">
                <legend>All Done!</legend>
                <input class="button" id="btnForm_Status" name="btnSubmit" tabindex="900" type="submit" value="Click Here to Submit your Form" >
            </fieldset> <!-- ends buttons -->
        </form>
    
        <?php
    } //end body submit
    ?>

</article>

<?php include 'footer.php'; ?>

</body>
</html>