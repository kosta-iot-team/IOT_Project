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

    ?>
    <body>
        <form action='main.php' method='post'>
            <input type='hidden' name='id' value='<?=$id?>'>
            <input type='submit' value='홈'>
        </form>
        <form action='member_register.php' method='post'>
            <input type='hidden' name='id' value='<?=$id?>'>
            <input type='hidden' name='name' value='<?=$name?>'>
            <input type='submit' value='회원 등록'>
        </form>
        <?php

            $sql="select name from member where name != '$name'";
            $result=mysqli_query($conn,$sql);
            
            echo "<ul>";
            while($row=mysqli_fetch_array($result)){
                $select_name=$row['name'];

                $sql="select id from member_infor where name='$select_name'";
                $result2=mysqli_query($conn,$sql);
                $adminForm="";
                while($row=mysqli_fetch_array($result2)){
                    $adminForm="
                    <form action='member_admin_process.php' method='post'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='name' value='$name'>
                        <input type='hidden' name='select_name' value='$select_name'>
                        <input type='submit' value='관리자로 임명' onclick='if(!confirm(\"확실합니까?\")){return false;}'>
                    </form>
                    ";
                }
                
                echo "
                <li>
                    $select_name
                    <form action='member_delete_process.php' method='post'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='name' value='$name'>
                    <input type='hidden' name='select_name' value='$select_name'>
                    <input type='submit' value='삭제' onclick='if(!confirm(\"확실합니까?\")){return false;}'>
                    </form>
                    $adminForm
                </li>
                ";
            }
            echo "</ul>";

        ?>
    </body>
</html>