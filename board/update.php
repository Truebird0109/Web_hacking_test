<?php
include "../db.php";
$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <h2 class="text-center mb-4">✏️ 게시글 수정</h2>

    <form action="update_ok.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label class="form-label">제목</label>
            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">내용</label>
            <textarea name="content" class="form-control" rows="5"><?php echo $row['content']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">수정 완료</button>
    </form>

    <div class="text-center mt-3">
        <a href="board.php" class="btn btn-secondary">취소</a>
    </div>
</div>

</body>
</html>
