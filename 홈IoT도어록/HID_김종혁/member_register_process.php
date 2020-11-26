<?php
if(!isset($_POST['id'])){
    echo "<script>location.href='index.php'</script>";
}
$conn=mysqli_connect('localhost','root','111111','hid');
if(!isset($_POST['id'])){
    echo 
    "
    <script>
    location.href='index.php'
    </script>
    ";
}
$id=$_POST['id'];
$name=$_POST['name'];
?>
<form action="member_manage.php" id='member_manage' method='post'>
    <input type="hidden" name='id' value='<?=$id?>'>
    <input type='hidden' name='name' value='<?=$name?>'>
</form>
<form action="main.php" id='main' method='post'>
    <input type="hidden" name='id' value='<?=$id?>'>
</form>
<?php
// 이름
$new_name=mysqli_real_escape_string($conn,$_POST['new_name']);
// 관리자면
if(isset($_POST['admin'])){
    // 관리자 임명
    $admin=1;
    $echo_admin='관리자';
    // 이전 관리자 해임
    $oldname=mysqli_fetch_array(mysqli_query($conn,"select name from member_infor where id='{$id}'"))['name'];
    $result=mysqli_query($conn,"update member set admin=0 where name='{$oldname}'");
    if(!$result){
        echo "관리자 해임 중 문제가 생겼습니다.";
        return;
    }
}
// 아니면 회원 
else {
    $admin=0;
    $echo_admin='회원';
}
// 회원이름 겹치면
$sql="select name from member where name='{$new_name}'";
$result=mysqli_query($conn,$sql);
if(mysqli_fetch_array($result)!=null){
    // 돌려보내기
    echo"
    <script>alert('이미 등록된 이름입니다.');history.back()</script>
    ";
}
// 회원 등록
$sql="insert into member value('{$new_name}',{$admin})";
$result=mysqli_query($conn,$sql);
if($result){
    echo 
    "
    <script>
        alert('$new_name $echo_admin 등록되었습니다.');
    ";
    if($echo_admin=='회원')
    echo 
    "
        member_manage.submit();
    </script>
    ";
    else
    echo 
    "
        main.submit();
    </script>
    ";
}else{
    echo "등록 중 문제가 생겼습니다.";
}
?>
