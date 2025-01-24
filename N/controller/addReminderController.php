<?php
require_once('../model/reminderModel.php');
session_start();

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    $title = $data['title'];
    $description = $data['description'];
    $due_date = $data['due_date'];
    $user_id = $_SESSION['user_id'];

    if (addReminder($user_id, $title, $description, $due_date)) {
        http_response_code(200);
    } 
    else {
        http_response_code(500);
        
    }
} 
else {
    http_response_code(400);
}
?>
