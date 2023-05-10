<?php
require_once 'dao/entityDAO.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $entitydao = new EntityDAO();
    $entity = $entitydao->getById($id);

    // If entity with given ID is found
    if ($entity) {
        // Delete the entity
        $entitydao->delete($id);
        echo "Entity deleted successfully.";
        echo "<br>";
        echo "<a href='index.php'>Go back to Home</a>";
        exit;
    } else {
        // If entity with given ID is not found, display error message
        echo "Error: Entity not found.";
    }
} else {
    // If ID parameter is not set, display error message
    echo "Error: ID parameter not found.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Entity</title>
</head>
<body>
    <?php
    require_once 'dao/entityDAO.php';

    // Check if ID parameter is set
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $entityDAO = new EntityDAO();
        $entity = $entityDAO->getById($id);

        // If entity with given ID is found
        if ($entity) {
            // Delete the entity
            $entityDAO->delete($id);
            echo "Entity deleted successfully.";
            echo "<br>";
            echo "<a href='index.php'>Go back to Home</a>";
            exit;
        } else {
            // If entity with given ID is not found, display error message
            echo "Error: Entity not found.";
        }
    } else {
        // If ID parameter is not set, display error message
        echo "Error: ID parameter not found.";
    }
    ?>
</body>
</html>
