<?php
require 'dbconnection.php'; // Ensure this is the correct filename

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match!"]);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Define database and collection
    $dbName = "sortxpert";
    $collectionName = "users";

    // Check if email already exists
    $query = new MongoDB\Driver\Query(['email' => $email]);
    $existingUser = $mongoClient->executeQuery("$dbName.$collectionName", $query)->toArray();

    if (!empty($existingUser)) {
        header("Location: error.html");
        exit();
    }

    // Prepare the insert document
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert([
        'full_name' => $full_name,
        'email' => $email,
        'password' => $hashed_password
    ]);

    // Execute the insert operation
    try {
        $result = $mongoClient->executeBulkWrite("$dbName.$collectionName", $bulk);
        if ($result->getInsertedCount() > 0) {
            echo json_encode(["success" => true, "message" => "Registration successful!"]);
            header("Location: success.html");
            exit();

        } else {
            echo json_encode(["success" => false, "message" => "Error: Registration failed!"]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Database Error: " . $e->getMessage()]);
    }
}

?>
 