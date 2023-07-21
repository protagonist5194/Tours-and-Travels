<?php
session_start();

include 'functions.php'

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tours and Travels</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
          <img src="images/logos.png" alt="Logo">
        </header>
        <div class="container">
            <h1 style="font-size: 100px;">Find Tours</h1>
            <?php if(isset($_SESSION['status']) && $_SESSION['status']=== 'error') : 
               $errors = $_SESSION['errors']; 
            ?>
            <ul class="errors">
                <?php foreach($errors as $e) : ?>
                <li><?=$e ?></li>
                <?php endforeach; ?>
            </ul>
            <?php elseif(isset($_SESSION['status']) && $_SESSION['status']=== 'success'):
              $data = $_SESSION['data'];
            ?>
            <div class="success">
                <P>Message sent successfully</p>
                <p>Here are the details you entered</p>
                <ul>
                   <li>Name:<em><? = esc_str( $data['name'] )?></em></li>
                   <li>Email:<em><? = esc_str( $data['Email'] )?></em></li>
                   <li>Season:<em><? = esc_str( $data['Season'] )?></em></li> 
                   <li>Region:<em><? = esc_str( $data['Region'] )?></em></li>
                   <li>Travel:<em><? = esc_str( $data['Travel'] )?></em></li>  
                   <li>interests:<em><? = esc_str( $data['interests'] )?></em></li>
                   <li>participants:<em><? = esc_str( $data['participants'] )?></em></li> 
                   <li>Message:<em><? = esc_str( $data['Message'] )?></em></li>   
                </ul>
            </div>
            <div class="ideas">
                <p>Here are some travel ideas on the details you entered</p>
                <ul>
                    <?php include('destinations.php'); ?>
                    <?php foreach($destinations[$data['region']] as $d) : ?>
                        <li>
                            <a href="#"><img src="<?= $d[0] ?>" alt="<?= $d[1] ?>"></a>
                            <h3><?= $d[1] ?></h3>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif ?>
            <form action="handle-form.php" method="post">
                <div class="form-field">
                    <label for="name" class="field-title">First Name:</label>
                    <input type= "text" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="form-field">
                    <label for="email" class="field-title">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email for contact">
                </div>
                <div class="form-field">
                    <label for="region" class="field-title">Where would you like to go?</label>
                    <select name="region" id="region">
                        <option value="">==Select a Region==</option>
                        <option value="Asia">Asia</option>
                        <option value="Africa">Africa</option>
                        <option value="Europe">Europe</option>
                        <option value="Oceania">Oceania</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="South America">South America</option>
                        <option value="North America">North America</option>
                    </select>

                    <label for="Travel" class="field-title">How would you like to Travel?</label>
                    <select name="travel" id="travel">
                        <option value="">==Select a mode==</option>
                        <option value="Helicopter">Helicopter</option>
                        <option value="Aeroplane">Aeroplane</option>
                        <option value="Ship">Ship</option>
                        <option value="Vehicle">Vehicle</option>
                        <option value="Train">Train</option>
                    </select>

      

                </div>
                <div class="form-field">
                   <h1><b>Preffered Seasons</b></h1>
                    <input type="radio" name="season" id="Summer" value="summer">
                    <label for="summer" class="field-title">summer</label>

                    <input type="radio" name="season" id="Winter" value="winter">
                    <label for="winter" class="field-title">winter</label>

                    <input type="radio" name="season" id="Spring" value="spring">
                    <lable for="spring" class="field-title">Spring</label>

                    <label for="autum" class="field-title">Autum</label>
                    <input type="radio" name="season" id="Autum" value="autum">
                </div>
                <div class="form-field">
                    <h1><b>Your Interests</b></h1>
                    <input type="checkbox" name="interest[]" id="photography" value="photography">
                    <label for="photography" class="field-title">photography</label>

                    <input type="checkbox" name="interest[]" id="trekking" value="trekking">
                    <label for="trekking" class="field-title">trekking</label>

                    <input type="checkbox" name="interest[]" id="star-gazing" value="star-gazing">
                    <label for="star-gazing" class="field-title">star-gazing</label>

                    <input type="checkbox" name="interest[]" id="bird-watching" value="bird-watching">
                    <label for="bird-watching" class="field-title">bird-watching</label>

                    <input type="checkbox" name="interest[]" id="camping" value="camping">
                    <label for="camping" class="field-title">camping</label>
                </div>
                <div class="form-field">   
                    <label for="participants" class="field-title">No. Of Participants</label>
                    <input type="number" name="participants" id="participants">
                </div>
                <div class="form-field">
                    <label for="message" class="field-title">Tell Us About Your Requirements</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <br>
                <div class="form-field">
                    <input type="hidden" name="token" value="">
                    <button type="submit">Send</button>
                </div>
            </form> 
        </div>
    </body>
</html>
<?php
    unset($_SESSION['status']);
    unset($_SESSION['errors']);
    unset($_SESSION['data']);
?>