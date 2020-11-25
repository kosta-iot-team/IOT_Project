<!doctype html>
<html>
    <head>

    </head>
    <?php
        if(!isset($_POST['id'])){
            echo "<script>location.href='index.php'</script>";
        }
        $conn=mysqli_connect('localhost','root','111111','hid');
        
        $id=$_POST['id'];
        
        $sql="select name from member_infor where id='{$id}'";
        $result=mysqli_query($conn,$sql);
        $name=mysqli_fetch_array($result)['name'];
        
        $sql="select admin from member where name='{$name}'";
        $result=mysqli_query($conn,$sql);
        $member=mysqli_fetch_array($result)['admin'];
        if($member==1)$member='관리자';
        else $member='회원';
        
        echo 
        "
        <p>
        {$member} {$name}
        </p>    
        ";
        
        if($member=='관리자'){
            echo 
            "
                <form action='member_register.php' method='post'>
                    <input type='hidden' name='id' value='{$id}'>
                    <input type='submit' value='회원 등록'>
                </form>
            ";
        }
    ?>
    <body>
        <input type="button" value='로그아웃' onclick="location.href='index.php'">        
    </body>
</html>