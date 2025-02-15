<?php
session_start();
include "../db.php";

// 현재 로그인한 사용자 정보 가져오기
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_display = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 0;

// 검색 기능 (제목 + 내용 + 작성자)
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = !empty($search) ? "WHERE posts.title LIKE '%$search%' OR posts.content LIKE '%$search%' OR users.username LIKE '%$search%'" : '';

$sql = "SELECT posts.id, posts.title, users.username, posts.user_id, posts.created_at FROM posts 
        JOIN users ON posts.user_id = users.id $search_query ORDER BY posts.id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>웹해킹</title>
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
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .search-box {
            display: flex;
            gap: 10px;
        }
        .search-box input {
            width: 250px;
            padding: 8px;
            font-size: 16px;
        }
        .table-box {
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 15px;
            font-size: 18px;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                text-align: center;
            }
            .search-box {
                margin-top: 10px;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="header">📌 게시판</div>

    <!-- 🔝 상단 바 (로그인한 사용자 & 검색창 & 로그아웃 버튼) -->
    <div class="top-bar">
        <div class="user-info">
            <strong>사용자:</strong> <?php echo htmlspecialchars($user_display); ?>
            <?php if ($is_admin) echo "(관리자)"; ?>
            
            <?php if ($user_id) { ?>
                <a href="../member/logout.php" class="btn btn-danger btn-sm ms-2">로그아웃</a>
            <?php } ?>
        </div>
        <form method="GET" action="board.php" class="search-box">
            <input type="text" name="search" class="form-control" placeholder="제목, 내용, 작성자 검색" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">검색</button>
        </form>
    </div>

    <!-- 📄 글 목록 -->
    <div class="table-box">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>관리</th> <!-- 🔥 관리 기능 추가 -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><a href="content.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <?php if ($is_admin || $row['user_id'] == $user_id) { ?>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">수정</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">삭제</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="btn-container">
        <a href="write.php" class="btn btn-success btn-lg">📝 글쓰기</a>
    </div>
</div>

</body>
</html>
