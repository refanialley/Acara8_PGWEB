
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

// Menghubungkan PHP ke database
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil seluruh data
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);
echo "<a href='input/index.html'>Input Data</a><br><br>";

// Membuat tabel HTML
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Kecamatan</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
            <th>Longitude</th>
            <th>Latitude</th>
          </tr>";

    // Menampilkan data satu per satu
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["kecamatan"]) . "</td>
                <td>" . $row["luas"] . "</td>
                <td>" . $row["jumlah_penduduk"] . "</td>
                <td>" . $row["longitude"] . "</td>
                <td>" . $row["latitude"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data";
}

$conn->close();
?>