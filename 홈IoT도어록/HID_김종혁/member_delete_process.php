<?php
    if(!isset($_POST['id'])){
        echo "<script>location.href='index.php'</script>";
    }
    $conn=mysqli_connect('localhost','root','111111','hid');
    
    $id=$_POST['id'];
    $name=$_POST['name'];
    $select_name=$_POST['select_name'];
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
<form action="member_manage.php" method='post' name='form'>
    <input type="hidden" name='id' value='<?=$id?>'>    
    <input type="hidden" name='name' value='<?=$name?>'>    
</form>
<script>
    // 관리로
    form.submit();
</script>