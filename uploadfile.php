<?php
// Database configuration
$dbHost = 'localhost';
$dbName = 'demo';
$dbUser = 'root'; // Assuming default username
$dbPass = '';

// Create database connection
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['image']['name']);
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Validate image
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $maxSize = 3 * 1024 * 1024; // 3MB
        
        if (!in_array($fileType, $allowedTypes)) {
            $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } elseif ($fileSize > $maxSize) {
            $error = "File size must be less than 3MB.";
        } else {
            // Generate unique filename
            $newFileName = uniqid() . '.' . $fileType;
            $uploadPath = $uploadDir . $newFileName;
            
            // Move uploaded file
            if (move_uploaded_file($fileTmp, $uploadPath)) {
                $success = "Image uploaded successfully!";
                
                // Now insert other form data to database
                if (isset($_POST['name'], $_POST['sex'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO users (Name, sex, email, phone, password) 
                                             VALUES (:name, :sex, :email, :phone, :password)");
                        
                        $stmt->execute([
                            ':name' => $_POST['name'],
                            ':sex' => $_POST['sex'] === 'male' ? 1 : 0, // Convert to boolean
                            ':email' => $_POST['email'],
                            ':phone' => $_POST['phone'],
                            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hash password
                        ]);
                        
                        $dbSuccess = "Data inserted to database successfully!";
                    } catch(PDOException $e) {
                        $dbError = "Database error: " . $e->getMessage();
                    }
                }
            } else {
                $error = "There was an error uploading your file.";
            }
        }
    } else {
        $error = "Please select an image to upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Form Submission</title>
</head>
<body>
    <h1>Upload Image and Submit Form</h1>
    
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    
    <?php if (isset($dbSuccess)): ?>
        <p style="color: green;"><?php echo $dbSuccess; ?></p>
    <?php endif; ?>
    
    <?php if (isset($dbError)): ?>
        <p style="color: red;"><?php echo $dbError; ?></p>
    <?php endif; ?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">Upload Image (max 3MB):</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>
        
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        
        <div>
            <label>Sex:</label>
            <input type="radio" name="sex" id="male" value="male" required>
            <label for="male">Male</label>
            <input type="radio" name="sex" id="female" value="female">
            <label for="female">Female</label>
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        
        <div>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>