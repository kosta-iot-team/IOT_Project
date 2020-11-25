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
            echo "관리자 등록 중 문제가 생겼습니다. 관리자에게 문의하세요.";
            return;
        }
        // 관리자 정보 등록
        $sql="
        insert into member_infor value(
            '{$escaped['name']}',
            '{$escaped['id']}',
            '{$escaped['password']}'
        )
        ";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "<script>alert('관리자 가입 성공');location.href='index.php';</script>";
        }else{
            echo "관리자 가입 중 문제가 생겼습니다. 관리자에게 문의하세요.";
            return;
        }
    }else{
        // 회원인지 확인
        $sql="select name from member";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
            // 회원이면
            if($row['name']==$escaped['name']){
                // 정보 있는지 확인
                $sql="select name from member_infor";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result)){
                    // 정보 있으면 돌려보내기
                    if($row['name']==$_POST['name']){
                        echo "
                            <script>
                                alert('이미 가입하셨습니다.');
                                location.href='index.php';
                            </script>
                        ";
                        return;
                    }
                }
                // 정보 없으니까
                // 아이디 중복인지 확인 
                $sql="select id from member_infor";
                $result=mysqli_query($conn,$sql);
                if(!$result){
                    echo "아이디 조회 중 문제가 생겼습니다. 관리자에게 문의해주세요.";
                    return;
                }
                while($row=mysqli_fetch_array($result)){
                    // 중복이면 
                    if($row['id']==$escaped['id']){
                        // 뒤로보내기
                        echo "
                        <script>
                            alert('중복되는 아이디 입니다.');
                            history.back();
                        </script>
                        ";
                        return;
                    }
                }
                // 중복 아니니까 정보 등록
                $sql="
                    insert into member_infor value(
                        '{$escaped['name']}',
                        '{$escaped['id']}',
                        '{$escaped['password']}'
                    )
                ";
                $result=mysqli_query($conn,$sql);
                if($result){
                    echo "<script>alert('회원 가입 성공');location.href='index.php'</script>";
                }else{
                    echo "회원 가입 중 문제가 생겼습니다. 관리자에게 문의해주세요.";
                    return;
                }
            }
        }
        // 회원 아니면 뒤로 보내기
        echo "<script>alert('등록되지 않은 이름입니다.');history.back();</script>";
    }
?>