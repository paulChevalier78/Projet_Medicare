<?php
// chat.php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "medicare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $message = $_POST['message'];
    
    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $message);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="chatroom.css">
</head>
<body>
    <div class="container mt-5">
        <header>
            <h1>Bienvenue, <strong><?php echo htmlspecialchars($user); ?></strong></h1>
            <a href="medecing1.html">Quitter la conversation</a>
        </header>
        <div id="chatbox">
            <?php foreach ($messages as $message): ?>
                <p><strong><?php echo htmlspecialchars($message['username']); ?>:</strong> <?php echo htmlspecialchars($message['message']); ?> <em>(<?php echo $message['timestamp']; ?>)</em></p>
            <?php endforeach; ?>
        </div>
        <form action="chat.php" method="POST" class="mt-3">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Your message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $('#chatbox').load('chat.php #chatbox > *');
            }, 3000);
        });
    </script>
</body>
</html>
