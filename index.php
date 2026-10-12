<?php
$file = "tamu.txt";

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];

    if (!empty($nama) && !empty($pesan)) {
        $data = "Nama: " . $nama . " | Pesan: " . $pesan . "<br><hr>";
        file_put_contents($file, $data, FILE_APPEND);
        echo "<script>alert('Pesan berhasil dikirim!');</script>";
    } else {
        echo "<script>alert('Nama dan pesan tidak boleh kosong!');</script>";
    }
}

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Buku Tamu Sederhana</title>';
echo '</head>';
echo '<body style="font-family: Arial; margin: 30px;">';

echo '<h2>Buku Tamu Digital</h2>';

echo '<form method="POST" action="">';
echo '<label>Nama:</label><br>';
echo '<input type="text" name="nama" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>';

echo '<label>Pesan:</label><br>';
echo '<textarea name="pesan" required style="width: 100%; height: 80px; padding: 8px; margin-bottom: 10px;"></textarea><br>';

echo '<button type="submit" name="kirim" style="padding: 10px 15px; background: blue; color: white; border: none;">Kirim</button>';
echo '</form>';

echo '<hr style="margin: 30px 0;">';

echo '<h3>Daftar Tamu</h3>';

if (file_exists($file)) {
    echo file_get_contents($file);
} else {
    echo "Belum ada tamu.";
}

echo '</body>';
echo '</html>';
?>
