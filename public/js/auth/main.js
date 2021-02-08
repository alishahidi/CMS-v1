function load(){
    document.getElementById('loading').style.display = "none";
}

let address =location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

function refreshCaptcha(){
    let address =location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
    let captcha = document.getElementById("captcha");
    captcha.src = address+'/admin-Dashboard/Captcha.php?' + Date.now();
}

let xhr = new XMLHttpRequest();
function checkForm(){
    let validate = document.getElementById("validate-email");
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let username = document.getElementById("username").value;
    let name = document.getElementById("name").value;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let status = parseInt(this.responseText);
            if (status === 1){
                return true;
            }
            else{
                return false;
            }
        }
    }

    xhr.open("POST",address+"/template/auth/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("check=true&email="+encodeURIComponent(email)+"&pass="+encodeURIComponent(password)+"&username="+encodeURIComponent(username)+"&name="+encodeURIComponent(name));
}

function testPass(){
    reCheck();
    let validatePass = document.getElementById("validate-password");
    let password = document.getElementById("password").value;
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let strongPass = document.getElementById("strongPass");
            let status = parseInt(this.responseText);
            if (status === 0){
                strongPass.style.width="0%";
                strongPass.className = "progress-bar bg-danger";
            }
            if (status === 1){
                strongPass.style.width="20%";
                strongPass.className = "progress-bar bg-danger";
            }
            if (status === 2){
                strongPass.style.width="40%";
                strongPass.className = "progress-bar bg-danger";
            }
            if (status === 3){
                strongPass.style.width="60%";
                strongPass.className = "progress-bar bg-warning";
            }
            if (status === 4){
                strongPass.style.width="80%";
                strongPass.className = "progress-bar bg-primary";
            }
            if (status === 5){
                strongPass.style.width="100%";
                strongPass.className += "progress-bar bg-success";
                validatePass.className = "fas fa-check position-relative bottom-fix";
                validatePass.style.color="#0d6efd";
                validatePass.style.transition="all 1s";
                return true;
            }
            else {
                validatePass.className = "fas fa-exclamation-circle position-relative bottom-fix";
                validatePass.style.color="#ef0c5b";
                validatePass.style.transition="all 1s";
                return false;
            }
        }
    }

    xhr.open("POST",address+"/template/auth/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("pass="+encodeURIComponent(password));
}


function reCheck(){
    let fPassword = document.getElementById("password").value;
    let lPassword = document.getElementById("rePass").value;
    let validate = document.getElementById("validate-repassword");
    if (fPassword === lPassword){
        validate.className = "fas fa-check";
        validate.style.color="#0d6efd";
        validate.style.transition="all 1s";
        return true;
    }
    if (fPassword !== lPassword || lPassword === "" || fPassword === "") {
        validate.className = "fas fa-exclamation-circle";
        validate.style.color="#ef0c5b";
        validate.style.transition="all 1s";
        return false;
    }
}
function emailValid(){
    let validate = document.getElementById("validate-email");
    let email = document.getElementById("email").value;
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let status = parseInt(this.responseText);
            if (status === 1){
                validate.className = "fas fa-check";
                validate.style.color="#0d6efd";
                validate.style.transition="all 1s";
                return true;

            }
            if(status === 0){
                validate.className = "fas fa-exclamation-circle";
                validate.style.color="#ef0c5b";
                validate.style.transition="all 1s";
                return false;

            }
        }
    }

    xhr.open("POST",address+"/template/auth/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("email="+encodeURIComponent(email));
}
function usernameValid(){
    let validate = document.getElementById("validate-username");
    let username = document.getElementById("username").value;
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let status = parseInt(this.responseText);
            if (status === 1){
                validate.className = "fas fa-check";
                validate.style.color="#0d6efd";
                validate.style.transition="all 1s";
                return true;

            }
            if(status === 0){
                validate.className = "fas fa-exclamation-circle";
                validate.style.color="#ef0c5b";
                validate.style.transition="all 1s";
                return false;

            }
        }
    }

    xhr.open("POST",address+"/template/auth/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("username="+encodeURIComponent(username));
}
function nameValid(){
    let validate = document.getElementById("validate-name");
    let name = document.getElementById("name").value;
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let status = parseInt(this.responseText);
            if (status === 1){
                validate.className = "fas fa-check";
                validate.style.color="#0d6efd";
                validate.style.transition="all 1s";
                return true;

            }
            if(status === 0){
                validate.className = "fas fa-exclamation-circle";
                validate.style.color="#ef0c5b";
                validate.style.transition="all 1s";
                return false;

            }
        }
    }

    xhr.open("POST",address+"/template/auth/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("name="+encodeURIComponent(name));
}

function uploadFile(target) {
    if (target.files[0].size <= 687000){
        document.getElementById("file-name").style.color="snow";
        document.getElementById("file-name").innerHTML = target.files[0].name;
        var reader = new FileReader();
        reader.onload = function (b) {
            $('#image')
                .attr('src', b.target.result);
        };

        reader.readAsDataURL(target.files[0]);
    }
    else {
        target.value="";
        document.getElementById("file-name").innerHTML = "لطفا سایز فایل را کمتر یا برابر 687 کیلوبایت قرار دهید";
        document.getElementById("file-name").style.color="#f61058";

    }
}