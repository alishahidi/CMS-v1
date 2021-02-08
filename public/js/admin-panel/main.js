

function load(){
    document.getElementById('loading').style.display = "none";
        
}

function uploadFile(target) {
    if (target.files[0].size <= 687000){
        document.getElementById("image").alt="loading";
        document.getElementById("image").className="d-block article-image my-4";
        document.getElementById("file-name").innerHTML = target.files[0].name;
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image')
                .attr('src', e.target.result);
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

let options = document.getElementsByClassName("option-cog");

function showCog(i) {
    options[i].className = "option-cog animate__animated animate__bounceIn";
    options[i].style.display = "flex";
}

function closeCog(b) {
    options[b].className = "option-cog animate__animated animate__bounceOutLeft";
}
$(function() {
    var navmenulist = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown)
    }

    navmenulist.prototype.dropdown = function(e) {
        var $el = e.data.el;
        $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }

    var navmenulist = new navmenulist($('#navmenulist'), false);
});


function uploadFileLogo(target) {
    if (target.files[0].size <= 687000){
        document.getElementById("file-logo").innerHTML = target.files[0].name;
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imagelogo')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(target.files[0]);
    }
    else {
        target.value="";
        document.getElementById("file-logo").innerHTML = "لطفا سایز فایل را کمتر یا برابر 687 کیلوبایت قرار دهید";

    }
}
function uploadFileIcon(target1){
    if (target1.files[0].size <= 687000){
        document.getElementById("file-icon").innerHTML = target1.files[0].name;

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imageicon')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(target1.files[0]);
    }
    else {
        target1.value="";
        target1.type="";
        target1.type="file";
        document.getElementById("file-icon").innerHTML = "لطفا سایز فایل را کمتر یا برابر 687 کیلوبایت قرار دهید";
        document.getElementById("file-name").style.color="#f61058";
    }
}

$(document).ready(function() {
	$( 'textarea#editor' ).ckeditor({
            language: 'fa' 
        });
} );

let xhr = new XMLHttpRequest();
let address =location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

function approved(id){
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            let status = parseInt(this.responseText);
            let btn = document.getElementById("approved"+id);
            if(status === 1){
                btn.innerHTML = "حذف از حالت تایید شده";
                btn.className = "btn btn-outline-success";
            }
            else{
                btn.innerHTML = "تایید کردن نظر";
                btn.className = "btn btn-success";
            }
        }
    }
    xhr.open("GET",address+"/admin-Dashboard/Comment.class.php?approved="+id,true);
    xhr.send();

}
