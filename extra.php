<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Extra example source code. Note that you need to put these sections into your form.</p>
<?php
// ####################    Adding a text area      #############################

// Initialize: SECTION 1c.
$comments="";

$commentsERROR = false;

// Sanitize: SECTION 2b.
$comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
$dataRecord[] = $comments;

// Error check: SECTION 2c.
// Note that this if statments mean the comments are not required 
if ($comments != "") { 
    if (!verifyAlphaNum($comments)) {
        $errorMsg[] = "Your comments appear to have extra characters that are not allowed.";
        $commentsERROR = true;
    }
}
?>

<fieldset class="textarea">
    <p>
        <label  class="required" for="txtComments">Comments</label>
        <textarea <?php if ($commentsERROR) print 'class="mistake"'; ?>
                  id="txtComments" 
                  name="txtComments" 
                  onfocus="this.select()" 
                  tabindex="200"><?php print $comments; ?></textarea>
                  <!-- NOTE: no blank spaces inside the text area, be sure to close 
                             the text area directly -->
    </p>
</fieldset>

<?php
// ####################    Adding radio buttons      ###########################

// Initialize: SECTION 1c.
$gender="Female";

$genderERROR = false;

// Sanitize: SECTION 2b.
$gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
$dataRecord[] = $gender;

// Error check: SECTION 2c.
// none if you set a default value.
if($gender != "Male" AND $gender != "Female"){
    $errorMsg[] = "Please choose a gender";
    $genderERROR = true;
}
?>
        
<fieldset class="radio <?php if ($genderERROR) print ' mistake'; ?>">
    <legend>What is your gender?</legend>
    <p>
        <label class="radio-field">
            <input type="radio" 
                   id="radGenderMale" 
                   name="radGender" 
                   value="Male" 
                   tabindex="572"
                   <?php if ($gender == "Male") echo ' checked="checked" '; ?>>
        Male</label>
    </p>

    <p>    
        <label class="radio-field">
            <input type="radio" 
                   id="radGenderFemale" 
                   name="radGender" 
                   value="Female" 
                   tabindex="582"
                   <?php if ($gender == "Female") echo ' checked="checked" '; ?>>
        Female</label>
    </p>
</fieldset>

<?php
// ####################    Adding check boxes      #############################

// Initialize: SECTION 1c.
$hiking = true;    // checked
$kayaking = false; // not checked

$activityERROR = false;
$totalChecked = 0;

//Sanitize: SECTION 2b.
// NOTE If a check box is not checked it is not sent in the POST array.
if (isset($_POST["chkHiking"])) {
    $hiking = true;
    $totalChecked;
} else {
    $hiking = false;
}
$dataRecord[] = $hiking; 
/* the above saves true (a number 1 in your csv file) or false (empty) 
 * you could save the value of the check box

if (isset($_POST["chkHiking"])) {
    $hiking = true;
    $dataRecord[] = htmlentities($_POST["chkHiking"], ENT_QUOTES, "UTF-8");
    $totalChecked; // count how many are checked if you need to
} else {
    $hiking = false;
    $dataRecord[] = ""; 
}
*/

if (isset($_POST["chkKayaking"])) {
    $kayaking = true;
    $totalChecked;
} else {
    $kayaking = false;
}
$dataRecord[] = $kayaking;

// Error check: SECTION 2c.
// may not need to check for any
if($totalChecked < 1){
    $errorMsg[] = "Please choose at least one activity";
    $activityERROR = true;
}
?>
<fieldset class="checkbox <?php if ($activityERROR) print ' mistake'; ?>">
    <legend>Do you like (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($hiking) print " checked "; ?>
                            id="chkHiking"
                            name="chkHiking"
                            tabindex="420"
                            type="checkbox"
                            value="Hiking"> Hiking</label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($kayaking)  print " checked "; ?>
                            id="chkKayaking" 
                            name="chkKayaking" 
                            tabindex="430"
                            type="checkbox"
                            value="Kayaking"> Kayaking</label>
                </p>
</fieldset>

<?php
// ####################    Adding a list box       #############################

//Initialize: SECTION 1c.
$mountain = "Camels Hump";    // pick the option

$mountainError = false;

//Sanitize: SECTION 2b.
$mountain = htmlentities($_POST["lstMountains"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $mountain;

//Error check: SECTION 2c.
// none if you set a default value. here i am just checking if they picked
// one. You could check to see if mountain is == to one of the ones you
// have, similar to radio buttons
if($mountain == ""){
    $errorMsg[] = "Please choose a favorite mountain";
    $mountainError = true;
}
?>
        
<fieldset  class="listbox <?php if ($mountainERROR) print ' mistake'; ?>">
    <p>
        <legend>Favorite Mountain</legend>
        <select id="lstMountains" 
                name="lstMountains" 
                tabindex="520" >
            <option <?php if($mountain=="HayStack Mountain") print " selected "; ?>
                value="HayStack Mountain">HayStack Mountain</option>

            <option <?php if($mountain=="Camels Hump") print " selected "; ?>
                value="Camels Hump">Camels Hump</option>

            <option <?php if($mountain=="Laraway Mountain") print " selected "; ?>
                value="Laraway Mountain">Laraway Mountain</option>
        </select>
    </p>
</fieldset>
    </body>
</html> 