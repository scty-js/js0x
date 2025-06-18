<?php
$host = 'localhost';
$username = 'data';
$password = '@';
$database = 'data';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Data pengguna baru
$new_username = 'admin_new';
$new_password = 'Admin@2025';
$email = 'admin@unifa.ac.id';
$date_registered = date('Y-m-d H:i:s');
$date_last_login = date('Y-m-d H:i:s');

$hashed_password = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);

// Langkah 1: Tambahkan pengguna ke tabel users
$sql_users = "INSERT INTO users (username, password, email, date_registered, date_last_login, must_change_password)
              VALUES (?, ?, ?, ?, ?, 0)";

$stmt_users = mysqli_prepare($conn, $sql_users);
if ($stmt_users === false) {
    die("Error preparing users statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_users, "sssss", $new_username, $hashed_password, $email, $date_registered, $date_last_login);

if (!mysqli_stmt_execute($stmt_users)) {
    die("Error inserting user: " . mysqli_error($conn));
}

$user_id = mysqli_insert_id($conn); // Ambil user_id yang baru dibuat

// Langkah 2: Tetapkan peran Journal Manager
$user_group_id = 1; // Ganti dengan user_group_id yang sesuai (misalnya, 1 untuk Journal Manager, periksa tabel user_groups)

$sql_roles = "INSERT INTO user_user_groups (user_id, user_group_id)
              VALUES (?, ?)";

$stmt_roles = mysqli_prepare($conn, $sql_roles);
if ($stmt_roles === false) {
    die("Error preparing roles statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_roles, "ii", $user_id, $user_group_id);

if (mysqli_stmt_execute($stmt_roles)) {
    echo "Pengguna admin '$new_username' (user_id: $user_id) berhasil dibuat dan ditetapkan sebagai anggota grup!";
} else {
    echo "Error assigning role: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt_users);
mysqli_stmt_close($stmt_roles);
mysqli_close($conn);
?>
