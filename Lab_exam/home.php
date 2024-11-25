<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('Location: login.html');
    exit();
}

$users = $_SESSION['users'];
?>

<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>WELCOME TO THE HOME PAGE, <?php echo $users['name']; ?>!</h1>

    <h2>Your Information:</h2>
    <ul>
        <li>Name: <?php echo $users['name']; ?></li>
        <li>ID: <?php echo $users['id']; ?></li>
        <li>Email: <?php echo $users['email']; ?></li>
        <li>Date of Birth: <?php echo $users['dob']; ?></li>
        <li>Gender: <?php echo $users['gender']; ?></li>
        <li>Department: <?php echo $users['department']; ?></li>
        <li>Address: <?php echo $users['address']; ?></li>
    </ul>

    <form method="post" action="home.php">
        <button type="submit" name="logout">Logout</button>
    </form>

    <?php 
    if(isset($_POST['logout']))
    {
        unset($_SESSION['staus']);
        unset($_SESSION['users']);

        header('Location: login.html ');
    }
 
    ?>
</body>
</html>
