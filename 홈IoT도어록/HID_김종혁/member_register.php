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

            .top{
                padding: 10px;
            }

            .center{
                height: 90%;
                display: flex;
                align-items: center;
            }

            .form{
                display: flex;
                align-items: center;
            }
            .form-left{
                margin-left: 10px;
            }
            .form-right{
                display: flex;
                margin-left: 48px;
                margin-right: 10px;
            }
        </style>
    </head>
    <?php
        session_start();
        if($_SESSION['who']!='관리자'){
            echo "<script>location.href='index.php'</script>";
        }
        $conn=mysqli_connect('localhost','root','111111','hid');
    ?>
    <body>
        <div class="main">
            <div class="top">
                <input type="button" onclick="history.back()" value='뒤로'>
            </div>
            <div class="center">
                <form action="member_register_process.php" name="regist" method='post' onsubmit="
                    if(new_name.value==''){
                        alert('이름을 입력하세요.');
                        return false;
                    }
                ">
                    <div class="form">
                        <div class="form-left">
                            <input class="textbox" type="text" placeholder='Name' name='new_name'>
                            관리자로 임명 <input type="checkbox" name='admin'>
                        </div>
                        <div class="form-right">
                            <input type="submit" value='등록'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>