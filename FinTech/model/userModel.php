<?php

// Database connection using MySQLi
function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'fintech');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

// Login function with password hashing (security improvement)
function login($username, $password) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    mysqli_close($con);

    if ($user && password_verify($password, $user['password'])) {
        return true; // Successful login
    } else {
        return false; // Failed login
    }
}

// Add user with password hashing
function addUser($username, $password, $email, $gender, $dob, $address, $phone) {
    $con = getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (username, password, email, gender, dob, address, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedPassword, $email, $gender, $dob, $address, $phone);
    $status = mysqli_stmt_execute($stmt);

    mysqli_close($con);

    return $status;
}

// Get user by ID
function getUser($id) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    mysqli_close($con);

    return $user;
}

// Get all users
function getAllUser() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    mysqli_close($con);

    return $users;
}

// Delete user by ID
function deleteUser($id) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $status = mysqli_stmt_execute($stmt);

    mysqli_close($con);

    return $status;
}

// Update user details
function updateUser($id, $username, $email, $gender, $dob, $address, $phone, $password) {
    $con = getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $sql = "UPDATE users SET username = ?, email = ?, gender = ?, dob = ?, address = ?, phone = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $username, $email, $gender, $dob, $address, $phone, $hashedPassword, $id);
    $status = mysqli_stmt_execute($stmt);

    mysqli_close($con);

    return $status;
}

// Get password of a user (use with caution, better to return hashed password)
function getPassword($username) {
    $con = getConnection();
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($con);

    return $row ? $row["password"] : null;
}

// Update password (with hashing)
function updatePassword($username, $newpass) {
    $con = getConnection();
    $hashedPassword = password_hash($newpass, PASSWORD_DEFAULT); // Hash the password

    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $username);
    $result = mysqli_stmt_execute($stmt);

    mysqli_close($con);

    return $result;
}

?>
