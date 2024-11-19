<?php
require_once 'models.php';

$models = new Models();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'specialization' => $_POST['specialization'],
            'experience_years' => $_POST['experience_years']
        ];
        $result = $models->createApplicant($data);
        echo $result['message'];
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $result = $models->deleteApplicant($id);
        echo $result['message'];
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'specialization' => $_POST['specialization'],
            'experience_years' => $_POST['experience_years']
        ];
        $result = $models->updateApplicant($id, $data);
        echo $result['message'];
    }
}
?>
