<!doctype html >
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
                            <br><br>
                            홈IoT도어록
                            <br>
                            <img src="img/icon_index.png" alt="">
                        </p>
                        <form action="index_process_login.php" method='post' onsubmit="
                            if(id.value==''){alert('아이디를 입력해주세요.');return false;}
                            else if(password.value.length<4){alert('비밀번호를 4자이상 입력해주세요.');return false;}
                        ">
                            <input type="text" name='id' placeholder='Id' maxlength='10'>
                            <br>
                            <input type="password" name='password' placeholder='Password' maxlength='8'>
                            <br>
                            <input type="submit" value='Login'>
                            <br>
                            <input type="button" style="background-color : #24f205;">
                            <input type="button" style="background-color : #f2e307;">
                        </form>
                        <p style="cursor : pointer; text-align : right;">
                            <a onclick="location.href='index_signup.php'">
                                회원가입
                            </a>
                        </p>
                    </td>            
                </table>
            </td>
        </table>
    </body>
    </html>