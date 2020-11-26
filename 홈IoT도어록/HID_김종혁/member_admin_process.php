<?php
    if(!isset($_POST['id'])){
        echo "<script>location.href='index.php'</script>";
    }
    $conn=mysqli_connect('localhost','root','111111','hid');
    
    $id=$_POST['id'];
    $name=$_POST['name'];
    $select_name=$_POST['select_name'];
    // 새 관리자 임명
    $sql="update member set admin=1 where name='$select_name'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "에러 : 1";
        return;
    }
    // 전 관리자 해임
    $sql="update member set admin=0 where name='$name'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "에러 : 2";
        return;
    }
?>
<form action="main.php" method='post' name='form'>
    <input type="hidden" name='id' value='<?=$id?>'>  
    <input type="hidden" name='name' value='<?=$name?>'>    
</form>
<script>
    // 메인으로
    form.submit();
</script>