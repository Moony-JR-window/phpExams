<?php
$mysqli = new mysqli("localhost", "root", "123", "mydatabase");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sex = $_POST['sex'] == '1' ? 1 : 0;
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $plainPassword = rand(0, 99999999);

    $stmt = $mysqli->prepare("INSERT INTO users (Name, sex, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sbsss", $name, $sex, $email, $phone, $plainPassword);
    
    if ($stmt->execute()) {
        echo "User created. Password: $plainPassword";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="POST">
    Name: <input name="name" required><br>
    Sex: 
    <select name="sex">
        <option value="1">Male</option>
        <option value="0">Female</option>
    </select><br>
    Email: <input name="email" type="email" required><br>
    Phone: <input name="phone" required><br>
    <button type="submit">Submit</button>
</form>
