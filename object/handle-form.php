<?php

session_start();

$name = "";
$email = "";
$region = "";
$Travel = "";
$season = "";
$interests = [];
$participants = 0;
$message = "";
$token = "";

$data = [];

/*
Validation is highly important
Let's go through each of the fields and check them
*/

$errors = [];

// 0. Token



// 1. Name - required, alphabets and spaces only

if(!empty($_POST['name'])) {
    $name = $_POST['name'];
    if(ctype_alpha(str_replace(" ", "", $name)) === false) {
        $errors[] = "Name should contain only alphabets and spaces";
    }
}
else {
    $errors[] = "Name field cannot be empty";
}

// 2. Email - required, validate using filter_var() function

if(!empty($_POST['email'])) {
    $email = $_POST['email'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== $email) {
        $errors[] = "Email is not valid";
    }
    
}
else {
    $errors[] = "Email can't be empty";
}

// 3. Region - required, value should be from the list

if(!empty($_POST['region'])) {
    $region = $_POST['region'];
    $allowed_regions = ["Asia", "Africa", "Europe", "Oceania", "Antarctica", "South America", "North America"];
    if(!in_array($region, $allowed_regions)) {
        $errors[] = "Region not in list";
    }
}
else {
    $errors[] = "Select a region from the list";
}


if(!empty($_POST['travel'])) {
    $travel = $_POST['travel'];
    $allowed_travels = ["Helicopter", "Aeroplane", "Ship", "Vehicle", "Train"];
    if(!in_array($travel, $allowed_travels)) {
        $errors[] = "mode not in list";
    }
}
else {
    $errors[] = "Select a mode from the list";
}


// 4. Season - not required, but must be in the list if selected

if(!empty($_POST['season'])) {
    $season = $_POST['season'];
    $allowed_seasons = ["summer","winter","spring","autum"];
    if(!in_array($season, $allowed_seasons)) {
        $errors[] = "Invalid Season";
    }
}

// 5. Interests - not required, but must be in the list if selected

if(!empty($_POST['interests'])) {
    $interests = $_POST['interests']; // this is also array
    $interests_allowed = ["photography","trekking", "star gazing", "Bird watching", "camping"];

    foreach($interests as $interest) {
        if(!in_array($interest, $interests_allowed)) {
            $errors[] = "The activity you selected is not in our list";
            break;
        }
    }

}

// 6. Participants - required, must be between 1 and 10

if(!empty($_POST['participants'])) {
    $participants = (int)$_POST['participants'];
    if($participants < 1 || $participants > 10) {
        $errors[] = "No. of participants must be 1-10";
    }
}
else {
    $errors[] = "Specify the no. of participants";
}

// 7. Message - required, no html tags, js code, etc, just normal text

if(!empty($_POST['message'])) {
    // $message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");
    // this is escaping, we'll do it while outputting
    $message = $_POST['message'];
}
else {
    $errors[] = "Tell about your requirements";
}



if ($errors) {

    $_SESSION['status'] = 'error';
    $_SESSION['errors'] = $errors;
    header('Location:index.php?result=validation_error');
    die();
    
}
else {

    $data = [
        "name" => $name,
        "email" => $email,
        "region" => $region,
        "season" => $season,
        "interests" => implode(", ", $interests),
        "participants" => $participants,
        "message" => $message
    ];


    
    $_SESSION['status'] = 'success';
    $_SESSION['data'] = $data;
    header('Location:index.php?result=success');
    die();
       
}
?>