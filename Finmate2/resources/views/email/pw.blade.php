<style>
@font-face {
    font-family: 'Pretendard-Regular';
    src: url('https://cdn.jsdelivr.net/gh/Project-Noonnu/noonfonts_2107@1.1/Pretendard-Regular.woff') format('woff');
    font-weight: 400;
    font-style: normal;
}
*{
    font-family: 'Pretendard-Regular';
}

</style>

<div >
    <h2>안녕하세요 {{ $user->username}}님 Fin.mate 입니다</h2>

    <p>비밀번호 변경을 위한 링크를 보내드립니다.</p>
    <p> 아래의 링크를 클릭해주세요</p>

    <a href="{{ route('users.pwemail',['data' => $EmailVerify->token])}}">비밀번호 변경하기</a>

    <p>비밀번호 인증 유효 시간은 {{$EmailVerify->expire_at}}까지 입니다</p>

    <br>
    <p>FIN.MATE 신은영 김진아 노수빈 최혁재</p>
    <p> 돈 맡겨주시조 </p>

</div>