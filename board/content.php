<?php
include "../db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("잘못된 접근입니다.");
}

$id = (int) $_GET['id'];

$sql = "SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE posts.id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("게시글을 찾을 수 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .info-box {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 5px;
        }
        .content-box {
            padding: 20px;
            font-size: 18px;
            background: #fafafa;
            border-radius: 5px;
            min-height: 200px;
            word-break: break-word;
        }
        .footer {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="header">📄 게시글 상세보기</div>

    <div class="info-box">
        <div><strong>작성자:</strong> <?php echo htmlspecialchars($row['username']); ?></div>
        <div><strong>작성일:</strong> <?php echo $row['created_at']; ?></div>
    </div>

    <div class="content-box">
        <?php echo nl2br(htmlspecialchars($row['content'])); ?>
    </div>

    <?php if (!empty($row['file_name'])): ?>
        <div class="footer">
            <strong>첨부파일:</strong> 
            <a href="download.php?file=<?php echo urlencode($row['file_name']); ?>">
                <?php echo htmlspecialchars($row['file_name']); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="footer">
        <a href="board.php" class="btn btn-dark">📂 글 목록으로</a>
    </div>
</div>

</body>
</html>
