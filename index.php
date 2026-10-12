<?php
$file = "todo.txt";

if (isset($_POST['tambah'])) {
    $tugas = $_POST['tugas'];
    if (!empty($tugas)) {
        $data = $tugas . "\n";
        file_put_contents($file, $data, FILE_APPEND);
    }
}

if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (file_exists($file)) {
        $daftar = file($file, FILE_IGNORE_NEW_LINES);
        if (isset($daftar[$index])) {
            unset($daftar[$index]);
            file_put_contents($file, implode("\n", $daftar) . (count($daftar) > 0 ? "\n" : ""));
        }
    }
    header("Location: " . strtok($_SERVER["REQUEST_URI"], "?"));
    exit;
}

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>To-Do List Sederhana</title>';
echo '</head>';
echo '<body style="font-family: Arial; margin: 30px;">';

echo '<h2>To-Do List</h2>';

echo '<form method="POST" action="">';
echo '<input type="text" name="tugas" placeholder="Tulis tugas baru..." required style="padding: 8px; width: 60%;">';
echo '<button type="submit" name="tambah" style="padding: 8px 15px; background: green; color: white; border: none;">Tambah</button>';
echo '</form>';

echo '<hr style="margin: 20px 0;">';

echo '<h3>Daftar Tugas</h3>';

if (file_exists($file)) {
    $daftar = file($file, FILE_IGNORE_NEW_LINES);
    if (count($daftar) > 0) {
        echo '<ul>';
        foreach ($daftar as $i => $item) {
            if (trim($item) !== '') {
                echo '<li>' . htmlspecialchars($item) . ' <a href="?hapus=' . $i . '" style="color: red; text-decoration: none;">[Hapus]</a></li>';
            }
        }
        echo '</ul>';
    } else {
        echo 'Belum ada tugas.';
    }
} else {
    echo 'Belum ada tugas.';
}

echo '</body>';
echo '</html>';
?>
