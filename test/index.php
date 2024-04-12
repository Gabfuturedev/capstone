<?php 
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h3 {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        button {
    background-color: #4CAF50;
    color: white;
    padding: 15px 30px; 
    border: none;
    border-radius: 6px; 
    cursor: pointer;
    margin-top: 20px;
    display: block;
    margin-left: auto; 
    margin-right: auto; 
    font-size: large;
}

        button:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 600px) {
            form {
                padding: 10px;
            }
        }
         .container {
            display: flex;
            align-items: center;
        }

        p {
            margin: 0;
        }

        a {
            color: blue;
            text-decoration: none;
            margin-left: 5px;
        }

        .form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.input-container {
    width: calc(50% - 5px);
}

.input-container input[type="file"] {
    border: 1px solid #ccc;
    border-radius: 4px;
    border-width: 1px;
    padding: 10px;
    width: 60%;
    box-sizing: border-box;
}

.label-container {
    display: block;
    margin-bottom: 5px;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* Set a maximum width for the modal */
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    overflow: auto; /* Allow modal content to scroll */
}


.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
    </style>
<body>
    <form  method="post" enctype="multipart/form-data">
    <div>
        <h3>Personal Data</h3>
        <div>
            <label for="firstName">First Name*</label><br>
            <input type="text" id="firstName" name="firstName" placeholder="First Name"><br>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name"><br>
        </div>
        <div>
            <label for="email">Email*</label><br>
            <input type="text" id="email" name="email" placeholder="Email"><br>
        </div>
        <div>
            <label for="conNum">Contact Number*</label><br>
            <input type="tel" id="conNum" name="conNum" placeholder="e.g., +63-123-456-789"><br>
        </div>
        <div>
            <label for="streetAddress">Address</label><br>
            <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address"><br>
        </div>
        <div>
            <input type="text" id="city" name="city" placeholder="City"><br>
        </div>
        <div>
            <input type="text" id="province" name="province" placeholder="Province"><br>
        </div>
        <div>
            <input type="text" id="zipCode" name="zipCode" placeholder="Zipcode"><br>
        </div>
        <div>
            <select id="country" name="country" required>
                <option value="" disabled selected>Country</option>
                <option value="USA">United States</option>
                <option value="CAN">Canada</option>
                <option value="UK">United Kingdom</option>
                <option value="AUS">Australia</option>
                <option value="GER">Germany</option>
                <option value="FRA">France</option>
            </select><br>
        </div>
    </div>

    <div class="form-container">
        <h3>Application Document</h3>
        <div class="form-row">
            <div class="input-container">
                <label for="application_letter">Application Letter*</label>
                <input type="file" id="appLetter" name="application_letter" accept="image/*">
            </div>
            <div class="input-container">
                <label for="curriculum_vitae">Curriculum Vitae*</label>
                <input type="file" id="cv" name="curriculum_vitae" accept="image/*">
            </div>
        </div>
        <div class="form-row">
            <div class="input-container">
                <label for="picture">2x2 Picture*</label>
                <input type="file" id="picture" name="pic" accept="image/*">
            </div>
            <div class="input-container">
                <label for="valid_id">Valid ID*</label>
                <input type="file" id="valId" name="valid" accept="image/*">
            </div>
        </div>
    </div>
<br><br>

        <div class="container">
        <p>(sample lang to) Please Read and accept the:</p>
        <a href="#" id="terms-link">Terms and Conditions</a>

<div class="modal" id="terms-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Terms and Conditions</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et nulla vel leo interdum pulvinar quis id elit. Sed ipsum ligula, finibus sed hendrerit vitae, pretium eu velit. Aenean placerat sem quis sem dignissim tempus. Nam fringilla ex at augue sollicitudin, id tempus est hendrerit. Phasellus dignissim, risus quis viverra hendrerit, arcu risus varius massa, quis vehicula quam dolor lacinia metus. Vestibulum eu eros libero. Nullam a neque ac libero rutrum ultrices et ac eros. Nam ipsum enim, congue ut purus vel, sollicitudin posuere lectus. Aliquam a urna vel erat suscipit fermentum ut in augue. Integer ut nibh facilisis, tincidunt massa sit amet, fermentum tortor. Donec facilisis faucibus quam ut accumsan.

Morbi augue justo, ultricies in dolor id, rutrum volutpat ligula. Nullam et nunc mi. Integer id arcu dignissim, euismod mauris vel, volutpat nisl. Quisque egestas maximus accumsan. In nibh mi, convallis a nulla euismod, ullamcorper dictum ante. Fusce interdum tincidunt mollis. Donec sed ex ut magna ornare scelerisque eu at quam.

Curabitur rhoncus posuere mi, ac porttitor magna scelerisque in. Donec lobortis, velit sit amet ultricies varius, justo enim dignissim lectus, non commodo augue sapien id erat. Nullam sed turpis varius, porta tortor vel, egestas dolor. Vestibulum magna nisl, elementum a nunc vitae, accumsan sagittis dolor. Nunc vel tellus tellus. Quisque id mi quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id lectus vel purus laoreet euismod vel id nisl.

Proin tincidunt elementum ex, non facilisis felis sodales sed. Vestibulum risus turpis, ultricies non risus sit amet, malesuada ullamcorper enim. Etiam quis mauris neque. Vestibulum a orci sit amet ante dignissim vulputate. Integer dolor eros, sollicitudin et ultricies vitae, interdum eget mauris. Morbi volutpat consequat turpis, eu vulputate sem venenatis ut. Sed lacinia massa ac tortor venenatis, venenatis imperdiet ipsum iaculis. Vivamus ac metus volutpat, ornare urna a, aliquet libero. Proin suscipit nunc ac mollis iaculis.

Aenean gravida metus porta egestas lacinia. Donec in aliquet turpis. Vivamus egestas erat urna, quis iaculis leo tempus eu. Nam et mi et elit fringilla faucibus id non libero. Curabitur semper tortor sit amet efficitur tincidunt. Nulla et elit ut ex pretium tristique. Nullam id placerat dui, non aliquet magna. Curabitur id purus felis. Donec lobortis metus eget ligula cursus, sodales suscipit metus imperdiet.</p>

        <button type="button" id="accept-terms">Accept</button>
    </div>
</div>

<script src="script.js"></script>
    </div>
    <br>
    <br>
        <button type="submit">Submit Application</button>
    </form>
    <?php

// Get current date
$currentDate = date('Y-m-d');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $conNum = $_POST['conNum'];
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];

    // Prepare SQL statement
    $sql = "INSERT INTO contbl (firstName, lastName, email, conNum, streetAddress, city, province, zipCode, country, date, appLetter, cv, picture, valId) 
            VALUES ('$firstName', '$lastName', '$email', '$conNum', '$streetAddress', '$city', '$province', '$zipCode', '$country', '$currentDate', '', '', '', '')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // Retrieve the ID of the last inserted row
        $last_id = $conn->insert_id;
    
        // Create directories if they don't exist
        $directories = ['application', 'image', 'resume', 'validId'];
        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        }
    
        // Application Letter
        $appLetter_file = $_FILES['application_letter']['name'];
        $appLetter_temp = $_FILES['application_letter']['tmp_name'];
        $appLetter_path =  "application/" . $last_id . "_application_letter_" . $appLetter_file;
        move_uploaded_file($appLetter_temp, $appLetter_path);
    
        // Curriculum Vitae
        $cv_file = $_FILES['curriculum_vitae']['name'];
        $cv_temp = $_FILES['curriculum_vitae']['tmp_name'];
        $cv_path = "resume/" . $last_id . "_curriculum_vitae_" . $cv_file;
        move_uploaded_file($cv_temp, $cv_path);
    
        // Picture
        $picture_file = $_FILES['pic']['name'];
        $picture_temp = $_FILES['pic']['tmp_name'];
        $picture_path = "image/" . $last_id . "_picture_" . $picture_file;
        move_uploaded_file($picture_temp, $picture_path);
    
        // Valid ID
        $valId_file = $_FILES['valid']['name'];
        $valId_temp = $_FILES['valid']['tmp_name'];
        $valId_path = "validId/" . $last_id . "_valid_id_" . $valId_file;
        move_uploaded_file($valId_temp, $valId_path);
    
        // Update the database with file paths
        $sql_update = "UPDATE contbl SET appLetter= '$appLetter_path', cv= '$cv_path', picture = '$picture_path', valId = '$valId_path' WHERE id = $last_id";
        if ($conn->query($sql_update) === FALSE) {
            echo "Error updating file paths: " . $conn->error;
        }
    
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

?>




</body>
</html>