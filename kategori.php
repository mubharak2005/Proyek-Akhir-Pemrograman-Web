<?php
include 'database.php';
header('Content-Type: application/json');

// Method: GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $result = mysqli_query($conn, "SELECT * FROM kategori");
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
}

// Method: POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $nama = $_POST['nama'];

  if ($id) {
    $sql = "UPDATE kategori SET nama='$nama' WHERE id_kategori=$id";
  } else {
    $sql = "INSERT INTO kategori(nama) VALUES('$nama')";
  }

  if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
  }
}

// Method: DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents("php://input"), $delete);
  $id = $delete['id'];
  $sql = "DELETE FROM kategori WHERE id_kategori=$id";

  if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
  }
}
?>
