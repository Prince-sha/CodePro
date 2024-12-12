<?php
require_once 'dbconfig.php';

class Clients {
  
    public static function create($conn, $name, $email, $phone) {
        $stmt = $conn->prepare("INSERT INTO Users (name, email, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $phone);

        if ($stmt->execute()) {
            return "Client added successfully.";
        } else {
            return "Error: " . $stmt->error;
        }
    }

  
    public function readAll($conn) {
        $result = $conn->query("SELECT * FROM Users");
        $clients = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clients[] = $row;
            }
        }
        return $clients;
    }

    public function update($conn, $id, $name, $email, $phone) {
        $stmt = $conn->prepare("UPDATE Users SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("ssss", $name, $email, $phone, $id);
        if ($stmt->execute()) {
            return "Client updated successfully.";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM Users WHERE id = ?");
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            return "Client deleted successfully.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>
