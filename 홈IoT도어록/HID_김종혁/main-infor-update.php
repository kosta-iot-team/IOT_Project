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

            .center{
                height: 90%;
                display: flex;
                align-items: center;
                text-align: center;
            }
            .process{
                margin: auto;
                text-align: center;
            }
            
            input::placeholder{
                color: #e6e7ee;
            }
            
            .textbox{
                color : #707070;
                border-radius : 7px;
                border : 2px solid #cccaca;
                margin : 0px 0px 15px 0px; 
                height : 50px; width : 250px;
                padding-left : 15px;
                font-size : 15px;
            }
            .textbox:focus{
                border:2px #2405f2 solid;
                outline: none !important;
            }

            input[type=submit]{
                cursor : pointer;
                border-radius : 7px;
                border : 0px;
                background-color : #2c00fc;
                color : white;
                margin : 0px 0px 15px 0px; 
                height : 50px; width : 272px;
                font-size : 13px;
                letter-spacing: 1px;
            }
            input[type=submit]:focus {
                outline: none !important;
            }
        </style>
    </head>
    <?php
        session_start();
        if(!isset($_SESSION['id'])){
            echo "<script>location.href='index.php'</script>";
        }
        $conn=mysqli_connect('localhost','root','111111','hid');
        
        $sql="select password from member_infor where id='{$_SESSION['id']}'";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            echo "에러 : 1 ";
        }
        $password=mysqli_fetch_array($result)['password'];
        if(!$password){
            echo "에러 : 2 ";
        }
        
    ?>
    <body>
        <div class="main">
            <div class="nav">
                <div class="nav-infor">
                    <?=$_SESSION['infor']?>
                </div>
                <div class="nav-right-items">
                    <input class="nav-item" type="button" value='홈' onclick="history.back()">
                </div>
            </div>
            <div class="center">
                <form class="process" action="main-infor-update-process.php" method='post'
                onsubmit="
                    if(id.value==''){
                        alert('아이디를 입력하세요.');
                        return false;    
                    }else if(pswd.value.length<4){
                        alert('비밀번호를 4자리 이상 입력하세요.');
                        return false;    
                    }else if(pswd.value!=pswd2.value){
                        alert('비밀번호가 일치하지 않습니다.');
                        return false;    
                    }
                ">
                    <input class="textbox" type="text" value="<?=$_SESSION['id']?>" placeholder='Id' name='id'><br>
                    <input class="textbox" type="password" value="<?=$password?>" placeholder='Password' name='pswd'><br>
                    <input class="textbox" type="password" value="<?=$password?>" placeholder='Password' name='pswd2'><br>
                    <input type="submit" value='업데이트'>
                </form>
            </div>
        </div>
    </body>
</html>