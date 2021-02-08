function dropShow(b) {
    let x = document.getElementsByClassName("drop-down-content");
    let i;
    for (i in x){
        if (i != b){
           x[i].className = "drop-down-content z-index-max";
       }
    }
    x = x[b];
    if (x.className === "drop-down-content z-index-max") {
        x.className += " drop-down-show z-index-max";
    } else {
        x.className = "drop-down-content z-index-max";
    }
}
function showMenu() {
    let x = document.getElementById("menu");
    if (x.className === "header-menu") {
        x.className += " show";
    } else {
        x.className = "header-menu";
    }
}



$(document).ready(function () {
    $("#back-top").hide();

    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 500) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);

            return false;
        });
    });
});
$(function() {
    cbpHorizontalMenu.init();
});

function load(){
    document.getElementById('loading').style.display = "none";
}

$(document).ready(function() {
	$( 'textarea#editor' ).ckeditor({
            language: 'fa' 
        });
} );


