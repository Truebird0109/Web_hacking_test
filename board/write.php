<?php include "../db.php"; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <h2 class="text-center mb-4">📝 글쓰기</h2>

    <form action="write_ok.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">제목</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">내용</label>
            <textarea name="content" class="form-control" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">파일 업로드</label>
            <input type="file" name="upload_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100">등록</button>
    </form>

    <div class="text-center mt-3">
        <a href="board.php" class="btn btn-secondary">취소</a>
    </div>
</div>

</body>
</html>
