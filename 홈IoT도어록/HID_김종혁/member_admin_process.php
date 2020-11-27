<?php
session_start();
if($_SESSION['who']!='관리자'){
    echo "<script>location.href='index.php'</script>";
}
$conn=mysqli_connect('localhost','root','111111','hid');

$select_name=$_POST['row_name'];
// 새 관리자 임명
$sql="update member set admin=1 where name='$select_name'";
$result=mysqli_query($conn,$sql);
if(!$result){
    echo "에러 : 1";
    return;
}
// 전 관리자 해임
$sql="update member set admin=0 where name='{$_SESSION['name']}'";
$result=mysqli_query($conn,$sql);
if(!$result){
    echo "에러 : 2";
    return;
}
?>
<script>
    // 메인으로
    location.href='main.php';
</script>