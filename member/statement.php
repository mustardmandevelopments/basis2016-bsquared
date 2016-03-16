<?php
/**
 * Aaron Young, Megan Palmer, Lucas Mathis, Peter Atwater, Sherri Miller
 * Bob Fisher, Kathy Pratt, James Gibbs, Tanya Ulrich, Kyle Cleven, Jason Kessler-Holt
 * Source for Navigation: http://cssmenumaker.com/
 * Source for Hashing Algorithm: http://pajhome.org.uk/crypt/md5/sha512.html
 * Source for Back-End(Tutorial):http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
 * Source for Login Page: http://www.24psd.com/css3-login-form-template/
 * Inspired by: http://www.noahglushien.com/
 * FAQ Source: http://www.snyderplace.com/demos/collapsible.html
 *
 * CREATIVE COMMONS- All social media link and images used fall under CC
 * http://creativecommons.org/licenses/by/3.0/legalcode
 *
 *
 *    The MIT License (MIT)

 * Copyright (c) 2016-Present b[squared]

 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect_member.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/FormsManager.php';

secureSessionStart(); // call to functions.php secure session.
$logged = checkIfLoggedIn($db);
?>
<!DOCTYPE html>
<html lang="en">

<!--Standard head for all bsquared member pages. -->
<head>
    <title>b[squared] Member Site</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="icon" type="image/ico" href="favicon.ico">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script><!--Javascript -->
    <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../js/readImage.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
       $(".nav ul li a").each(function(){
          $(".active").removeClass("active");
       })
    });  
    </script>
    <script>
    function activeFunction() { 
    var currentPage = document.getElementById('updatePortfolioPageActive');
       currentPage.className += ' active';
    }
    </script>
</head>


<body onload="activeFunction()">
<div id="main" class="container">

    <?php
    getMemberNavigation($db, $logged);
    ?>
    <br><br><br>
    <?php if (loginCheckMember($db) == true) : ?>
        <p><?php $username = htmlentities($_SESSION['username']);
            echo "Update your page " . $username ?>!</p><!-- Update your profile initialLastName -->
        <p>
            <?php
            $userID = $_SESSION['user_id'];// retrieve the userID from the session.
            FormsManager::getStatementForm();// Call the function from content_forms.php
            ?>
        </p>
    <?php else : ?>
        <p>
            <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
        </p>
    <?php endif; ?>
    <?php
    getFooter();
    ?>
</div>

<?php
if (isset($_POST['submit']) && isset($userID))
{
    // Set the variables for the input values function.
    $table = 'portfolios_statement';
    $columnName = ['statement'];
    $inputName = ['statement'];
    $destinationID = NULL;
    $portionSelected = NULL;
    $formName = "statement";

    try
    {
        inputValues($db, $userID, $inputName, $table, $columnName,
            $destinationID, $portionSelected, $formName);
    }
    catch (Exception $e)
    {
        // Check to see if this error message is being populated on the failure of the input values.
        echo "there was an issue uploading your information! please try again!";
    }

    // If the files selection in the form are set...
    if (isset($_FILES) && isset($userID))
    {
        // Set the variables for the file name's
        $name = htmlentities($_FILES['backgroundImg']['name']);
        $fileTempName = $_FILES['backgroundImg']['tmp_name'];
        $extension = strtolower(substr($name, strpos($name, '.')));
        $destinationID = [19]; // Destination ID for the photo.
        $fileName = "../graphics/member_uploads/member_backgrounds/"."member_background_user_".$userID.$extension;
        $imageW = 800;
        $imageH = 500;

        doFileOperations($db, $userID, $fileTempName, $fileName, $portionSelected, $destinationID,
            $formName, $extension, $imageW, $imageH);
    }
}
?>
</body>
</html>