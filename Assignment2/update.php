<?php
require_once 'dao/entitydao.php'; // Include the entitydao.php file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $number = $_POST['number'];
    $text = $_POST['text'];
    $date = $_POST['date'];

    // Check if image file is uploaded
    if (!empty($_FILES['image']['name'])) {
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
                // Update entity with new image
                $entity = new model();
                $entity->setId($id);
                $entity->setNumber($number);
                $entity->setText($text);
                $entity->setDate($date);
                $entity->setImage($target_file);

                // Update the entity in the database
                $entitydao = new entitydao();
                $entitydao->update($entity);

                // Redirect to index.php after successful update
                header('Location: index.php');
                exit;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update entity without changing the image
        $entity = new model();
        $entity->setId($id);
        $entity->setNumber($number);
        $entity->setText($text);
        $entity->setDate($date);

        // Update the entity in the database
        $entitydao = new entitydao();
        $entitydao->update($entity);

        // Redirect to index.php after successful update
        header('Location: index.php');
        exit;
    }
} else {
    // Fetch entity data for pre-filling the form
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $entitydao = new entitydao();
        $entity = $entitydao->getById($id);
    } else {
        // Redirect to index.php if id parameter is not provided
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Car Details</title>
</head>
<body>
    <h1>Update Car Details</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $entity->getId(); ?>">
        Car Number: <input type="text" name="number" value="<?php echo $entity->getNumber(); ?>"><br><br>
        Car Name: <input type="text" name="text" value="<?php echo $entity->getText(); ?>"><br><br>
        Date: <input type="date" name="date" value="<?php echo $entity->getDate(); ?>"><br><br>
        Current Image: <img src="<?php echo $entity->getImage(); ?>" width="100"><br><br>
        Upload New Image: <input type="file" name="image"><br><br>
        <input type="submit" value="Update">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
