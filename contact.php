<?php
$name = $email = $message = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");
    
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($message)) $errors[] = "Message is required";
    
    if (empty($errors)) {
        mail($email, "Contact Form", $message);
        $name = $email = $message = "";
        $success = "Message sent successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    
    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"></label><br>
        <label>Message: <textarea name="message"><?php echo htmlspecialchars($message); ?></textarea></label><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>