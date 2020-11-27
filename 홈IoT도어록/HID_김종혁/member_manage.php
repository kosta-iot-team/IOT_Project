<!doctype html>
<html>
    <head>
        <style>
            html{
                background-color : #fcfcfc;
                color : #707070;
                font-size : 14px;
            }
            .main{
                width: 400px;
                height: 560px;
                margin: auto;
                background-color : #ffffff;
                border-radius : 5px;
                box-shadow: 1px 1px 3px #888888;
            }

            .nav{
                display: flex;
                align-items: center;  
                padding-top: 10px;
                margin-bottom: 10px;
            }
            .nav-infor{
                margin-left: 10px;
            }
            .nav-right-items{
                margin-left: auto;
                margin-right: 10px;
            }

            .center{
                height: 90%;
                display: flex;
                align-items: center;
            }
            .table{
                margin: auto;
                text-align: center;
                width: 100%;
            }
            .td-name{
                width: 100%;
                padding: 10px;
            }
            .td-button{
                padding-right: 10px;
            }
        </style>
    </head>
    <?php
        session_start();
        if($_SESSION['who']!='관리자'){
            echo "<script>location.href='index.php'</script>";
        }
        $conn=mysqli_connect('localhost','root','111111','hid');
        
        $sql="select name from member where name != '{$_SESSION['name']}'";
        $result=mysqli_query($conn,$sql);

        $form_lists="";
        $rows='';
        while($row=mysqli_fetch_array($result)){
            $row_name=$row['name'];
            
            $sql="select id from member_infor where name='$row_name'";
            $result2=mysqli_query($conn,$sql);
            
            $admin_submit='';
            while($row=mysqli_fetch_array($result2)){
                $form_lists.=
                "<form action='member_admin_process.php' name='member_admin_process_$row_name' method='post'>
                <input type='hidden' name='row_name' value='$row_name'>
            </form>
                ";
                $admin_submit="<input type='button' value='관리자로 임명' onclick='if(confirm(\"확실합니까?\")){member_admin_process_$row_name.submit();}'>";
            }
            
            $form_lists.="
            <form action='member_delete_process.php' name='member_delete_process_$row_name' method='post'>
                <input type='hidden' name='row_name' value='$row_name'>
            </form>
            ";

            $rows.="
            <tr>
                <td class='td-name'>$row_name</td>
                <td class='td-button'><input type='button' value='삭제' onclick='if(confirm(\"확실합니까?\")){member_delete_process_$row_name.submit();}'></td>
                <td class='td-button'>$admin_submit</td>
            </tr>
            ";
        }
    ?>
    <?=$form_lists;?>
    <body>
        <div class="main">
            <div class="nav">
                <div class="nav-infor">
                    <?=$_SESSION['infor']?>
                </div>
                <div class="nav-right-items">
                    <input class="nav-item" type='button' onclick="location.href='main.php'" value='홈'>
                    <input class="nav-item" type='button' onclick="location.href='member_register.php'" value='회원 등록'>
                </div>
            </div>
            <div class='center'>
                <div class="table">
                    <table class='table-in'>
                        <?=$rows?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>