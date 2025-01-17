<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "uploads/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Save the file path to the database
            $sql = "INSERT INTO profile_pictures (image_path) VALUES ('$targetFilePath')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded and database updated successfully.";
            } else {
                echo "Error saving to database: " . $conn->error;
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
