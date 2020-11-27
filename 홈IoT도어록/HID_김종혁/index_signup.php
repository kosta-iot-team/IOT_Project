<!doctype html>
<html>
    <head>

    </head>
    <style>
        html{
            background-color : #fcfcfc;
            color : #707070;
            font-size : 14px;
        }
        .table{
            background-color : #ffffff;
            border-radius : 5px;
            box-shadow: 1px 1px 3px #888888;
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
    <body>
        <table class='table' align='center'>
            <td style="width : 400px; height : 560px;">
                <table align='center'>
                    <td align='center' style="width : 100px; height : 500px;">
                        <p>
                            <?php
                                $conn = mysqli_connect('localhost','root','111111','hid');
                                $sql = "select * from member";
                                $result = mysqli_query($conn, $sql);
                                $admin='';
                                $member='';
                                
                                while($row=mysqli_fetch_array($result)){
                                    if($row['admin']==1){
                                        $admin=$row['name'];
                                    }else{
                                        $member.="{$row['name']} ";
                                    }
                                }
                                if($admin==''){
                                    echo "관리자로 가입하여 회원을 등록해주세요.<br><br>";
                                }else{
                                    echo '관리자 : '.$admin.'<br><br>';
                                }
                                if($member!=''){
                                    echo '회원 : '.$member.'<br><br>';
                                }else{
                                    echo '회원가입을 원하시면<br>관리자에게 문의하세요.';
                                }
                            ?>
                        </p><br>
                        <form action="index_process_signup.php" method='post' onsubmit="
                                if(name.value==''){
                                    alert('이름을 입력하세요.');
                                    return false;
                                }else if(id.value==''){
                                    alert('아이디를 입력하세요.');
                                    return false;
                                }else if(password.value.length<4){
                                    alert('비밀번호를 4자이상 입력하세요.');
                                    return false;
                                }else if(password.value!=password_confirm.value){
                                    alert('비밀번호가 일치하지 않습니다.');
                                    return false;
                                }
                        ">
                            <input type="hidden" name='admin' value="<?=$admin==''?>">
                            <input class="textbox" type="text" name='name' placeholder='Name' maxlength='10'>
                            <br>
                            <input class="textbox" type="text" name='id' placeholder='Id' maxlength='10'>
                            <br>
                            <input class="textbox" type="password" name='password' placeholder='Password' maxlength='8'>
                            <br>
                            <input class="textbox" type="password" name='password_confirm' placeholder='Password' maxlength='8'>
                            <br>
                            <input type="submit" value='회원가입'>
                        </form>
                    </td>            
                </table>
            </td>
        </table>
    </body>
</html>