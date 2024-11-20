<?php

require_once 'dbConfig.php';

class Models {
    private $conn;

    public function __construct() {
        $db = new DBConfig();
        $this->conn = $db->connect();
    }

    public function createApplicant($data) {
        $sql = "INSERT INTO applicants (first_name, last_name, email, phone_number, specialization, experience_years) 
                VALUES (:first_name, :last_name, :email, :phone_number, :specialization, :experience_years)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

         
            header("Location: ../index.php?message=Applicant added successfully&statusCode=200");
            exit;
        } catch (PDOException $e) {
        
            header("Location: ../index.php?message=Failed to add applicant: " . $e->getMessage() . "&statusCode=400");
            exit;
        }
    }

    public function deleteApplicant($id) {
        $sql = "DELETE FROM applicants WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

         
            header("Location: ../index.php?message=Applicant deleted successfully&statusCode=200");
            exit;
        } catch (PDOException $e) {
        
            header("Location: ../index.php?message=Failed to delete applicant: " . $e->getMessage() . "&statusCode=400");
            exit;
        }
    }

    public function readApplicants() {
        $sql = "SELECT * FROM applicants ORDER BY application_date DESC";
        try {
            $stmt = $this->conn->query($sql);
            return [
                'message' => 'Applicants retrieved successfully',
                'statusCode' => 200,
                'querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'message' => 'Failed to retrieve applicants: ' . $e->getMessage(),
                'statusCode' => 400,
                'querySet' => []
            ];
        }
    }

    public function getApplicantById($id) {
        $sql = "SELECT * FROM applicants WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function updateApplicant($data) {
        $sql = "UPDATE applicants 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    phone_number = :phone_number, 
                    specialization = :specialization, 
                    experience_years = :experience_years 
                WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return [
                'message' => 'Applicant updated successfully',
                'statusCode' => 200
            ];
        } catch (PDOException $e) {
            return [
                'message' => 'Failed to update applicant: ' . $e->getMessage(),
                'statusCode' => 400
            ];
        }
    }
    

    public function searchApplicants($search) {
        $sql = "SELECT * FROM applicants WHERE 
                first_name LIKE :search OR 
                last_name LIKE :search OR 
                email LIKE :search OR 
                phone_number LIKE :search OR 
                specialization LIKE :search OR 
                experience_years LIKE :search 
                ORDER BY application_date DESC";
        try {
            $stmt = $this->conn->prepare($sql);
            $searchTerm = '%' . $search . '%';
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            return [
                'message' => 'Search completed successfully',
                'statusCode' => 200,
                'querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'message' => 'Failed to search applicants: ' . $e->getMessage(),
                'statusCode' => 400,
                'querySet' => []
            ];
        }
    }
}
