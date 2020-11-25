<?php
    $conn=mysqli_connect(
        'localhost',
        'root',
        '111111',
        'HID'
    );
    $escaped=array(
        'name' => mysqli_real_escape_string($conn,$_POST['name']),
        'id' => mysqli_real_escape_string($conn,$_POST['id']),
        'password' => mysqli_real_escape_string($conn,$_POST['password'])
    );
    if($_POST['admin']==1){
        // 관리자 등록
        $sql="
        insert into member value(
            '{$escaped['name']}',
            1
        )
        ";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            echo "문제가 생겼습니다. 관리자에게 문의하세요.";
            return false;
        }
        $sql="
        insert into member_infor value(
            '{$escaped['name']}',
            '{$escaped['id']}',
            '{$escaped['password']}'
        )
        ";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "<script>alert('관리자로 회원가입 성공');location.href='index.php';</script>";
        }else{
            echo "문제가 생겼습니다. 관리자에게 문의하세요.";
            return false;
        }
    }else{
        // 회원 등록
        $sql="select name from member";
        $result=mysqli_query($conn,$sql);
        // 맴버 등록 되있으면
        while($row=mysqli_fetch_array($result)){
            if($row['name']==$escaped['name']){
                $sql="select name from member_infor";
                $result=mysqli_query($conn,$sql);
                // 가입 되있는지 확인
                while($row=mysqli_fetch_array($result)){
                    // 가입 되있으면 돌려보내기
                    if($row['name']==$_POST['name']){
                        echo "
                            <script>
                                alert('이미 가입하셨습니다.');
                                location.href='index.php';
                            </script>
                        ";
                        return;
                        echo "
                            <script>
                                alert('return 오류.');
                            </script>
                        ";//삭제
                    }
                }
                // 등록 안되어있으면 회원 가입
                // 아이디가 중복되는지 확인 
                !!//수정
                $sql="
                    insert into member_infor value(
                        '{$escaped['name']}',
                        '{$escaped['id']}',
                        '{$escaped['password']}'
                    )
                ";
                $result=mysqli_query($conn,$sql);
                if($result){
                    echo "<script>alert('회원가입 성공');location.href='index.php'</script>";
                }else{
                    echo "문제가 생겼습니다. 관리자에게 문의해주세요.";
                    return;
                    echo "
                        <script>
                            alert('return 오류.');
                        </script>
                    ";//삭제
                }
            }
        }
        // 맴버 등록 안되있으면
        echo "<script>alert('등록되지 않은 이름입니다.');history.back();</script>";
    }
?>