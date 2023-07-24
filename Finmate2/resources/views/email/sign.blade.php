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
    <h2>안녕하세요 Fin.mate 입니다</h2>

    <p>인증코드를 입력해주시면 인증이 완료됩니다.</p>
    <p>인증코드는 {{$verify->token}} 입니다</p>
    <p>이메일 인증 유효 시간은 {{$verify->expire_at}}까지 입니다</p>

<br>
    <p>FIN.MATE 신은영 김진아 노수빈 최혁재</p>
    <p> 돈 맡겨주시조 </p>
</div>