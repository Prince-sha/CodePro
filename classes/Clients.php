<?php
require_once 'Database.php'; 


    public function create($id, $name, $email, $phone)
    {
        $stmt = $this->conn->prepare("INSERT INTO Users (id, name, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sss", $id,  $name, $email, $phone);
        if ($stmt->execute()) {
            return "Client added successfully.";
        } else {
            return "Error: ". $stmt->error;
        }
    }

   
    public function readAll()
    {
        $result = $this->conn->query("SELECT * FROM Users");
        $clients = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clients[] = $row;
            }
        }
        return $clients;
    }

    public function update($id, $name, $email, $phone)
    {
        $stmt = $this->conn->prepare("UPDATE clients SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sss", $name, $email, $phone, $id);
        if ($stmt->execute()) {
            return "Client updated successfully.";
        } else {
            return "Error: ". $stmt->error;
        }
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Client deleted successfully.";
        } else {
            return "Error: ". $stmt->error;
        }
    }
}



