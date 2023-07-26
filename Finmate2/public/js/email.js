const sentbtn = document.getElementById('sentbtn');
const emailspan = document.getElementById('errMsg');
const signbtn = document.querySelector('.signbtn');

let btnchk = false;
let apiDate = null;

const codechk = document.getElementById('codechk');
const emailcode = document.getElementById('emailcode');
const codeerrMsg = document.getElementById('codeerrMsg');

let code =false;

const email = document.getElementById('email');

function checkDupeemail() {
    const url =  "/users/email/"+email.value;
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.value === '') {
        emailspan.innerHTML = "이메일을 입력해 주세요.";
        emailspan.style.color = "red";
        return;
    }

    if(regex.test(email.value) === false) {
        emailspan.innerHTML = "이메일 형식으로 입력해 주세요.";
        emailspan.style.color = "red";
        return;
    }

    sentbtn.innerHTML = "재발송하기";

    fetch(url)
    .then(data=> {
        if(data.status !== 200) {
            throw new Error(data.status + ' : API Response Error');
        }
        return data.json();
    })
    .then(apiDate =>{
        if(apiDate["errordode"] === "E01"){
            emailspan.innerHTML = apiDate['msg'];
            emailspan.style.color = "red";
        }
        else{
            emailspan.innerHTML = apiDate['msg'];
            emailspan.style.color = "green";
            codechk.disabled = false;
            emailcode.disabled = false;
        }
    })
    .catch(error=>alert(error.message));
}

codechk.addEventListener('click', emailcodechk);

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function emailcodechk() {
    const url = "/users/codechk/"+email.value;
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept":"application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'PUT',
        credentials: "same-origin",
        body:JSON.stringify({
            email:email.value,
            codechk: emailcode.value
        })
    })
    .then(data=>{
        if(data.status !== 200){
            throw new Error (data.status + ' : API Response Error');
        }
        return data.json();
    })
    .then(data=>{
        if(data["errorcode"] === "E02") {
            codeerrMsg.innerHTML = data['mag'];
            codeerrMsg.style.color = "red";
            btnchk = false;
        }
        else {
            codeerrMsg.innerHTML = data['mag'];
            codeerrMsg.style.color = "green";
            btnchk = true;
            codechk.disabled = true;
            emailcode.disabled = true;
        }
    })
    .catch(error => alert(error.message));
}

// signbtn.addEventListener('click',checkDupeemail);

signbtn.addEventListener('click', function(event) {
    if(btnchk !== true) {
        event.preventDefault();

        codeerrMsg.innerHTML = '이메일을 인증해주세요.';
        codeerrMsg.style.color = 'red';
    }
});

function emailvalidation(){
    const emailcode = emailcode.value;
    const codeRegex = /^[0-9]{6}$/;
    if(emailcode == ''){
        codeerrMsg.innerHTML = '인증번호를 입력해주세요.';
        codeerrMsg.style.color = 'red';
    } else if (codeRegex.test(emailcode) === false) {
        codeerrMsg.innerHTML = '인증번호가 옳지 않습니다.';
        codeerrMsg.style.color = 'red';
        
    } else{
        codeerrMsg.innerHTML = '';
    }
}

const emailmagg = document.querySelector('.emailresentpls')

function modal(){
    alert('이메일로 인증코드를 발송했습니다.');
}
