<?php
if(!isset($_POST['id'])){
    echo "<script>location.href='index.php'</script>";
}
$conn=mysqli_connect('localhost','root','111111','hid');

// 아이디
$id=$_POST['id'];
?>
<form action="main.php" id='form' method='post'>
    <input type="hidden" name='id' value='<?=$id?>'>
</form>
<?php
// 이름
$name=mysqli_real_escape_string($conn,$_POST['name']);
// 관리자 임명
if(isset($_POST['admin'])){
    $admin=1;
    // 이전 관리자 해임
    $oldname=mysqli_fetch_array(mysqli_query($conn,"select name from member_infor where id='{$id}'"))['name'];
    $result=mysqli_query($conn,"update member set admin=0 where name='{$oldname}'");
    if(!$result){
        echo "관리자 해임 중 문제가 생겼습니다.";
        return;
    }
}
// 아니면 회원
else $admin=0;

$sql="insert into member value('{$name}',{$admin})";
$result=mysqli_query($conn,$sql);
if($result){
    echo "
        <script>
            alert('{$name} 등록되었습니다.');
            form.submit();
        </script>
    ";
}else{
    echo "등록 중 문제가 생겼습니다.";
}
?>
