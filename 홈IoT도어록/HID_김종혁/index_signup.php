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
        input[type=text]{
            color : #707070;
            border-radius : 7px;
            border : 2px solid #cccaca;
            margin : 0px 0px 15px 0px; 
            height : 50px; width : 250px;
            padding-left : 15px;
            font-size : 15px;
        }
        input[type=password]{
            color : #707070;
            border-radius : 7px;
            border : 2px solid #cccaca;
            margin : 0px 0px 15px 0px; 
            height : 50px; width : 250px;
            padding-left : 15px;
            font-size : 15px;
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
        input[type=button]{
            cursor : pointer;
            border-radius : 0px;
            border : 0px;
            color : white;
            margin : 0px 1px 0px 1px; 
            height : 40px; width : 131px;
        }
        
        input[type=text]:focus {
            border:2px #2405f2 solid;
            outline: none !important;
        }
        input[type=password]:focus {
            border:2px #2405f2 solid;
            outline: none !important;
        }
        input[type=submit]:focus {
            outline: none !important;
        }
        input[type=button]:focus {
            outline: none !important;
        }
        img{
            width : 40px;
            margin : 10px 0px 15px 0px; 
        }
    </style>
    <body>
        <table class='table' align='center'>
            <td style="width : 400px; height : 560px;">
                <table align='center'>
                    <td align='center' style="width : 100px; height : 500px;">
                        <p>
                            Member <br><br>
                            <?php
                                $conn = mysqli_connect('localhost','root','111111','hid');
                                $sql = "select * from member";
                                $result = mysqli_query($conn, $sql);
                                $member_list=array();
                                
                                while($row=mysqli_fetch_array($result)){
                                    array_push($member_list,"{$row['name']}");
                                    echo "{$row['name']} ";
                                }
                                if(count($member_list)==0){
                                    echo "등록된 이름이 없습니다.<br>관리자로 가입하여 이름을 등록해주세요.";
                                }
                            ?>
                        </p><br>
                        <script type='text/javascript'>//////////////////////////////////////////////////
                            function submitF(name,id,pswd,pswd2){
                                if(name==''){
                                    alert("이름을 입력하세요.");
                                    return false;
                                }
                                if(id==''){
                                    alert("아이디를 입력하세요.");
                                    return false;
                                }
                                if(pswd.length<4){
                                    alert("비밀번호를 4자 이상 입력하세요.");
                                    return false;
                                }
                                if(pswd!=pswd2){
                                    alert("비밀번호가 일치하지 않습니다.");
                                    return false;
                                }
                            }//////////////////////////////////////////////////
                        </script>
                        <form action="index_process_signup.php" method='post' onsubmit="
                                return submitF(name.value,id.value,password.value,password_confirm.value);
                        ">
                            <input type="hidden" name='admin' value="<?=count($member_list)==0?>">
                            <input type="text" name='name' placeholder='name' maxlength='10'>
                            <br>
                            <input type="text" name='id' placeholder='Id' maxlength='10'>
                            <br>
                            <input type="password" name='password' placeholder='Password' maxlength='8'>
                            <br>
                            <input type="password" name='password_confirm' placeholder='Password' maxlength='8'>
                            <br>
                            <input type="submit" value='회원가입'>
                        </form>
                    </td>            
                </table>
            </td>
        </table>
    </body>
</html>