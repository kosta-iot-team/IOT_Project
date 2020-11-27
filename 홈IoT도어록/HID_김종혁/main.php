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
                padding: 10px;
            }
            .nav-right-items{
                margin-left: auto;
            }
        </style>
    </head>
    <?php
        session_start();
        if(!isset($_POST['id'])&&!isset($_SESSION['id'])){
            echo "<script>location.href='index.php'</script>";
        }
        $conn=mysqli_connect('localhost','root','111111','hid');
        
        if(!isset($_SESSION['id']))
            $_SESSION['id']=$_POST['id'];

        $sql="select name from member_infor where id='{$_SESSION['id']}'";
        $result=mysqli_query($conn,$sql);
        $_SESSION['name']=mysqli_fetch_array($result)['name'];
        
        $sql="select admin from member where name='{$_SESSION['name']}'";
        $result=mysqli_query($conn,$sql);
        $_SESSION['who']=mysqli_fetch_array($result)['admin'];
        if($_SESSION['who']==1)$_SESSION['who']='관리자';
        else $_SESSION['who']='회원';
        
        $_SESSION['infor']="{$_SESSION['who']} {$_SESSION['name']}";
        
        if($_SESSION['who']=='관리자'){
            $style="";
        }else{
            $style="display:none;";
        }
    ?>
    <body>
        <div class="main">
            <div class="nav">
                <div class="nav-infor">
                    <?=$_SESSION['infor']?>
                </div>
                <div class="nav-right-items">
                    <input class="nav-item" type="button" value='정보 수정' onclick="location.href='main-infor-update.php'">
                    <input class="nav-item" type="button" value='회원 관리' style="<?=$style?>" onclick="location.href='member_manage.php'">
                    <input class="nav-item" type="button" value='로그아웃' onclick="{
                            location.href='index-logout.php';
                        }">        
                </div>
            </div>
        </div>
    </body>
</html>