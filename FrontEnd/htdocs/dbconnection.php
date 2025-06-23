<?php

try {
    $mongoClient = new MongoDB\Driver\Manager("mongodb+srv://8901tannu:yP34UMeSn7LIJnYc@cluster0.mwqyc.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");  
    echo "Connected to MongoDB successfully!";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>