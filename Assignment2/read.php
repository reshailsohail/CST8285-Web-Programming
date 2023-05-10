<?php
require_once 'dao/entityDAO.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $entityDAO = new EntityDAO();
    $entity = $entityDAO->getById($id);

    // If entity with given ID is found
    if ($entity) {
        $id = $entity->getId();
        $number = $entity->getNumber();
        $text = $entity->getText();
        $date = $entity->getDate();
        $image = $entity->getImage();
    } else {
        // If entity with given ID is not found, display error message
        echo "Error: Entity not found.";
        exit;
    }
} else {
    // If ID parameter is not set, display error message
    echo "Error: ID parameter not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Entity Details</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class='wrapper'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <h1 class='mt-5 mb-3'>Entity Details</h1>
                    <div class='form-group'>
                        <label>ID</label>
                        <p><b><?php echo $id; ?></b></p>
                    </div>
                    <div class='form-group'>
                        <label>Number</label>
                        <p><b><?php echo $number; ?></b></p>
                    </div>
                    <div class='form-group'>
                        <label>Text</label>
                        <p><b><?php echo $text; ?></b></p>
                    </div>
                    <div class='form-group'>
                        <label>Date</label>
                        <p><b><?php echo $date; ?></b></p>
                    </div>
                    <?php if ($image != "") { ?>
                        <div class='form-group'>
                            <label>Image</label>
                            <p><img src='images/<?php echo $image; ?>' width='200' height='200'></p>
                        </div>
                    <?php } ?>
                    <p><a href='index.php' class='btn btn-primary'>Go back to Home</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
