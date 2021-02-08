var address =location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
let xhr = new XMLHttpRequest();
function testPassa(){
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
                return true;
            }
            else {
                return false;
            }
        }
    }

    xhr.open("POST",address+"/template/user-panel/security/valid.php?",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("pass="+encodeURIComponent(password));
}
function load(){
    document.getElementById('loading').style.display = "none";
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
$('#exampleModal').on('show.bs.modal', event => {
    var button = $(event.relatedTarget);
    var modal = $(this);
    // Use above variables to manipulate the DOM

});

