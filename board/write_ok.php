<?php
include "../db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    die("로그인이 필요합니다.");
}

$user_id = $_SESSION['user_id'];
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

$sql = "INSERT INTO posts (user_id, title, content, created_at) VALUES ('$user_id', '$title', '$content', NOW())";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('글이 성공적으로 작성되었습니다.'); location.href='board.php';</script>";
} else {
    echo "<script>alert('글 작성 중 오류 발생: " . mysqli_error($conn) . "'); history.back();</script>";
}
?>
