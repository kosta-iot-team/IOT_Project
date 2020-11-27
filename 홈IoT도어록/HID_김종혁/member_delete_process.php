<?php
    session_start();
    if($_SESSION['who']!='관리자'){
        echo "<script>location.href='index.php'</script>";
    }
    $conn=mysqli_connect('localhost','root','111111','hid');
    
    $select_name=$_POST['row_name'];
    // 회원 삭제
    $sql="delete from member where name='$select_name'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "에러 : 1";
        return;
    }
    // 회원 정보 삭제
    $sql="delete from member_infor where name='$select_name'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "에러 : 2";
        return;
    }
?>
<script>
    // 관리로
    location.href='member_manage.php';
</script>