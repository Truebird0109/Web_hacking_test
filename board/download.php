<?php
$file_name = $_GET['file'];
$file_path = "../uploads/" . $file_name;

if (file_exists($file_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
} else {
    echo "파일이 존재하지 않습니다.";
}
?>
