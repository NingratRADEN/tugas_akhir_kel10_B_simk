<?php
$servername = "127.0.0.1";
$database = "simk";
$username = "root";
$password = "";
 
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// // mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
//mysqli_close($conn);

function getUserKosInfo($conn, $user_id) {
    $query = "
        SELECT * FROM tbl_user AS u
        JOIN tbl_infokos AS k ON u.iduser = k.iduser
        WHERE u.iduser = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_kos = $result->fetch_assoc();
    $stmt->close();

    return $user_kos ?: null;
}

?>