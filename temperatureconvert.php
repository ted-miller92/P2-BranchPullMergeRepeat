<?php
    /*
    Celsius to Fahrenheit	° F = 9/5 ( ° C) + 32
            example: 20 degrees Cel = 68 degrees Far
                20 * 1.8 (or 9/5) = 36 + 32 = 68
    Fahrenheit to Celsius	° C = 5/9 (° F - 32)
            example: 90 degrees Far = 32.2 degrees Cel
                (90 - 32 = 58) .5556 * 58 = 32.2
    Kelvin to Fahrenheit	° F = 9/5 (K - 273.15) + 32
            example: 60 degrees Kel = -351.4 degrees Far
                (60 - 273.15 = -213) * 1.8 = -384.4 + 32 = -351.4
    Fahrenheit to Kelvin	K = 5/9 (° F - 32) + 273.15
            example: 40 degrees Far = 277.448 degrees Kel
                .5556 (40 - 32 = 8) 4.4448 + 273.15 = 277.448
    Celsius to Kelvin	    K = ° C + 273.15
            example: 32 degrees Cel = 305 degrees Kel
                32 + 273.15 = 305
    Kelvin to Celsius	    ° C = K - 273.15
            example: 500 degrees Kel = 227 degrees Cel
                500 - 273.15 = 227
    */
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<link href="css/styles.css" type="text/css" rel= "stylesheet">

<title>Temperature Conversion Calculator</title>
</head>

<body>
<div class="wrapper">

<h1>Temperature Converter</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <fieldset class="fieldset">

    <label for="temp">Enter The Temperature You Wish to Convert:</label>
    <input for="temp" name="temp" id="temp" type="number" value="<?php if(isset($_POST['temp'])) echo htmlspecialchars($_POST['temp']) ;?>">

    <label for="unit_1">Converting From:</label>
    <ul>
    <li><input type="radio" name="unit_1" value="Fahrenheit">Fahrenheit</li>
    <li><input type="radio" name="unit_1" value="Celsius">Celsius</li>
    <li><input type="radio" name="unit_1" value="Kelvin">Kelvin</li>
    </ul>

    <label for="unit_2">Converting To:</label>
    <ul>
    <li><input type="radio" name="unit_2" value="Fahrenheit">Fahrenheit</li>
    <li><input type="radio" name="unit_2" value="Celsius">Celsius</li>
    <li><input type="radio" name="unit_2" value="Kelvin">Kelvin</li>
    </ul>

    <input id="submit" type="submit" value="Convert">

    </fieldset>
</form>


<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errorMsg = "";

    if(empty($_POST['unit_1']) && empty($_POST['unit_2']) ) { // if both are empty
        $errorMsg .= '<span class="error">Please select both your units of measurement! <br></span>';
    }

    if(empty($_POST['unit_1']) && isset($_POST['unit_2'])) { // if unit 1 is null but unit 2 is good
        $errorMsg .= '<span class="error">Please select your unit of measurement! <br></span>';
    }
        
    if(empty($_POST['unit_2']) && isset($_POST['unit_1'])) { // if unit 2 is null but unit 1 is good
        $errorMsg .= '<span class="error">What are we converting to? <br></span>';
    }

    if($_POST['temp'] === "") { // if temp is empty
        $errorMsg .= '<span class="error">Please fill out a temperature! <br></span>';
    }

        
    if(isset(
        $_POST['unit_1'],
        $_POST['unit_2'],
        $_POST['temp']
    )) {
        $unit_1 = $_POST['unit_1'];
        $unit_2 = $_POST['unit_2'];
        $converted_temp = 0; 
        $temp = intval($_POST['temp']); 

    if($unit_1 === $unit_2) { // if both are the same conversion
        $errorMsg .= '<span class="error">Please Select Two Different Units!<br></span>';
    }
        
    if($unit_1 == 'Fahrenheit' && $unit_2 == 'Celsius') { // Fahrenheit to Celsius	° C = 5/9 (° F - 32)
        $converted_temp = 5/9 * ($temp - 32);
    }

    if($unit_1 == 'Celsius' && $unit_2 == 'Fahrenheit') { // Celsius to Fahrenheit	° F = 9/5 ( ° C) + 32
        $converted_temp = 9/5 * $temp + 32;
    }

    if($unit_1 == 'Kelvin' && $unit_2 == 'Fahrenheit') { // Kelvin to Fahrenheit	° F = 9/5 (K - 273.15) + 32
        $converted_temp = 9/5 * ($temp - 273.15) + 32;
    }

    if($unit_1 == 'Fahrenheit' && $unit_2 == 'Kelvin') { // Fahrenheit to Kelvin	K = 5/9 (° F - 32) + 273.15
        $converted_temp = 5/9 * ($temp - 32) + 273.15;
    }

    if($unit_1 == 'Kelvin' && $unit_2 == 'Celsius') { // Kelvin to Celsius	 ° C = K - 273.15
        $converted_temp = $temp - 273.15;
    }

    if($unit_1 == 'Celsius' && $unit_2 == 'Kelvin') { // Celsius to Kelvin	 K = ° C + 273.15
        $converted_temp = $temp + 273.15;
    } 

} // end of isset if statment

if ($errorMsg === "") {
    echo '
    <div class="result">
        <h2>Converted Temperature</h2>
        <p>'.$temp.' degrees '.$unit_1.' is equal to '.number_format($converted_temp, 2).' degrees '.$unit_2.'. <br> Have a good day!</p>
        </div>';
} else {
    echo '<div class="result">'.$errorMsg.'</div>';
    }

} // SERVER REQUEST
?>

<footer> <!-- START footer section //////// -->
        <ul>
            <li
            >copyright &copy; 
                <?php
                    $date_current = date('Y');
                    $date_created = 2022;
                    if ($date_current == $date_created) {
                        echo $date_current;
                    }
                    else {
                        echo ''.$date_created.' - '.$date_current.'';
                    }
                ?>
            </li>
            <li><a href="https://validator.w3.org/nu/?doc=https://ellencodes.com/it262wn22/homeworks/p1TempConversion/tempconvert.php" target="_blank">HTML Validation</a></li>
            <li><a href="https://jigsaw.w3.org/css-validator/validator?uri=https://ellencodes.com/it262wn22/homeworks/p1TempConversion/tempconvert.php" target="_blank">CSS Validation</a></li>
        </ul>

    </footer>


</div> <!--CLOSE WRAPPER--->
</body>
</html>
