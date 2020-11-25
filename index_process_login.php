<?php
    $conn=mysqli_connect(
        'localhost',
        'root',
        '111111',
        'HID'
    );
    $escaped=array(
        'id' => mysqli_real_escape_string($conn,$_POST['id'])
    );
    $sql="select password from member_infor where id='{$escaped['id']}'";
    $result=mysqli_query($conn,$sql);
    while($password=mysqli_fetch_array($result)['password']){
        if($password==$_POST['password']){
            echo "
            <form method='post' action='main.php' name='form'>
                <input type='hidden' name='id' value='{$escaped['id']}'>
            </form>
            <script>form.submit()</script>
            ";
        }else{
            echo "
                <script>
                    alert('비밀번호가 일치하지 않습니다.');
                    history.back();
                </script>
            ";
        }
        return;
    }
    echo "
        <script>
            alert('가입되지 않은 아이디입니다.');
            history.back();
        </script>
    ";
?>