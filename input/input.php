
<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Akses tidak valid.");
}

// Mengambil data dari form
$kecamatan = trim($_POST["kecamatan"] ?? "");
$longitude = $_POST["longitude"] ?? "";
$latitude = $_POST["latitude"] ?? "";
$luas = $_POST["luas"] ?? "";
$jumlah_penduduk = $_POST["jumlah_penduduk"] ?? "";

// Memeriksa input
if (
    $kecamatan === "" ||
    !is_numeric($longitude) ||
    !is_numeric($latitude) ||
    !is_numeric($luas) ||
    !is_numeric($jumlah_penduduk)
) {
    exit("Data tidak valid. Periksa kembali isian form.");
}

// Pengaturan database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

// Membuat koneksi
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memasukkan data dengan prepared statement
$stmt = $conn->prepare(
    "INSERT INTO penduduk
    (kecamatan, longitude, latitude, luas, jumlah_penduduk)
    VALUES (?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "sdddi",
    $kecamatan,
    $longitude,
    $latitude,
    $luas,
    $jumlah_penduduk
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit;
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
