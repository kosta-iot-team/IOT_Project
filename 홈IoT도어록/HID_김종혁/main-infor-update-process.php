<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "<script>location.href='index.php'</script>";
}

$conn=mysqli_connect('localhost','root','111111','hid');
$sql="update member_infor set id='{$_POST['id']}', password='{$_POST['pswd']}' 
    where name='{$_SESSION['name']}'";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('업데이트 되었습니다.');location.href='main.php';</script>";
}else{
    echo "에러 : 1";
}
?>