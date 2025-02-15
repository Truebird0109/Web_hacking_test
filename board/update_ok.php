<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_id'])) {
    die("로그인이 필요합니다.");
}

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];

// ✅ 수정할 글 정보 조회
$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("해당 게시글을 찾을 수 없습니다.");
}

// ✅ 일반 사용자는 본인 글만 수정 가능 (Admin은 모든 글 수정 가능)
if (!$is_admin && $post['user_id'] != $user_id) {
    die("권한이 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>게시글 수정</h2>
    <form action="update_ok.php" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <div class="mb-3">
            <label class="form-label">제목</label>
            <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">내용</label>
            <textarea name="content" class="form-control" rows="5"><?php echo $post['content']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">수정 완료</button>
    </form>
</body>
</html>
