<?php
require_once 'dao/entityDAO.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $number = $_POST['number'];
    $text = $_POST['text'];
    $date = $_POST['date'];

    // Validate number (within range validation - required)
    if (!is_numeric($number) || $number < 1 || $number > 100) {
        echo "Number must be a numeric value within the range of 1 to 100.";
        exit;
    }

    // Validate text (regexp or min or max number of character - required)
    if (empty($text) || !preg_match('/^[a-zA-Z\s]{1,50}$/', $text)) {
        echo "Text must be alphabetic characters with a maximum length of 50 characters.";
        exit;
    }

    // Validate date (greater than or less than logic - required)
    if (empty($date) || strtotime($date) === false) {
        echo "Date must be a valid date in the format YYYY-MM-DD.";
        exit;
    }

    // Upload image file
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['image']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Create a new entity object
            $entity = new model();
            $entity->setNumber($number);
            $entity->setText($text);
            $entity->setDate($date);
            $entity->setImage($target_file);

            // Insert the entity into the database
            $entityD = new entitydao();
            $entityD->insert($entity);

            // Redirect to index.php after successful insertion
            header('Location: index.php');
            exit;
        } else {echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car Entity</title>
</head>
<body>
    <h1>Add Car Entity</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="number">Car Number:</label>
        <input type="number" name="number" id="number" required>
        <br>
        <label for="text">Car Name:</label>
        <input type="text" name="text" id="text" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>