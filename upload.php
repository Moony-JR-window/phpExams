<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];

        // Validate file size (less than 3MB)
        if ($file['size'] > 3 * 1024 * 1024) {
            die("File too large. Must be less than 3MB.");
        }

        // Validate file type (only images)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($file['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid file type. Only images are allowed.");
        }

        // Move the file
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $filePath = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            echo "Image uploaded successfully to: $filePath";
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}
?>

<!-- HTML form -->
<form method="POST" enctype="multipart/form-data">
    <label>Select image to upload (max 3MB):</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <button type="submit">Upload</button>
</form>
