<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_id'])) {
    die("로그인이 필요합니다.");
}

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];

// ✅ 삭제할 글 정보 조회
$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("해당 게시글을 찾을 수 없습니다.");
}

// ✅ 일반 사용자는 본인 글만 삭제 가능 (Admin은 모든 글 삭제 가능)
if (!$is_admin && $post['user_id'] != $user_id) {
    die("권한이 없습니다.");
}

// ✅ 글 삭제 실행
mysqli_query($conn, "DELETE FROM posts WHERE id = $id");
echo "<script>alert('게시글이 삭제되었습니다.'); location.href='board.php';</script>";
?>
