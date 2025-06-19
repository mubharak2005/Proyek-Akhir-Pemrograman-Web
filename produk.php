<?php
include 'database.php';
header('Content-Type: application/json');

// Method: GET → Ambil data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $result = mysqli_query($conn, "SELECT * FROM produk");
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
}

// Method: POST → Tambah atau update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];

  if ($id) {
    $sql = "UPDATE produk SET nama='$nama', harga=$harga WHERE id_produk=$id";
  } else {
    $sql = "INSERT INTO produk(nama, harga) VALUES('$nama', $harga)";
  }

  if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
  }
}

// Method: DELETE → Hapus data
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents("php://input"), $delete);
  $id = $delete['id'];
  $sql = "DELETE FROM produk WHERE id_produk=$id";

  if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
  }
}
?>
