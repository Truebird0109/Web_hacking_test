<?php
$host = "localhost";
$user = "root";  // XAMPP 기본 사용자
$pass = "";  // XAMPP는 기본적으로 비밀번호 없음
$dbname = "bulletin_board";  // 데이터베이스명

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

// ✅ 세션 중복 실행 방지
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
