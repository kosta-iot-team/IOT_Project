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
        $name=$_POST['name'];
    ?>
    <body>
        <form action="member_register_process.php" method='post' onsubmit="
            if(new_name.value==''){
                alert('이름을 입력하세요.');
                return false;
            }
        ">
            <input type="hidden" name='id' value='<?=$id?>'>
            <input type='hidden' name='name' value='<?=$name?>'>
            <input type="text" placeholder='Name' name='new_name'><br>
            관리자로 임명 <input type="checkbox" name='admin'><br>
            <input type="submit" value='등록'>
        </form>
    </body>
</html>