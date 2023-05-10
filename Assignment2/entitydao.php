<?php
require_once 'dao/abstractDAO.php';
require_once './model/model.php';

class entitydao extends abstractDAO {
    // Get all entities from the database
    public function getAll() {
        $sql = "SELECT * FROM entity";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'model'); // Update the fetch class to 'EntityModel'
        $entity = $stmt->fetchAll();
        return $entity;
    }

    // Get entity by ID from the database
    public function getById($id) {
        $sql = "SELECT * FROM entity WHERE id = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'model'); // Update the fetch class to 'EntityModel'
        $entity = $stmt->fetch();
        return $entity;
    }

    // Insert new entity into the database
    public function insert($entity) {
        $sql = "INSERT INTO entity (number, text, date, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$entity->getNumber(), $entity->getText(), $entity->getDate(), $entity->getImage()]);
    }

    // Update entity in the database
    public function update($entity) {
        $sql = "UPDATE entity SET number = ?, text = ?, date = ?, image = ? WHERE id = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$entity->getNumber(), $entity->getText(), $entity->getDate(), $entity->getImage(), $entity->getId()]);
    }

    // Delete entity from the database
    public function delete($id) {
        $sql = "DELETE FROM entity WHERE id = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
