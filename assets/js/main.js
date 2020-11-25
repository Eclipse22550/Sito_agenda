function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );
input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileTitle = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileTitle;
}
function share(){
    element = document.querySelector('#share');
    element.style.display = 'block';
    element = document.querySelector('#sharet');
    element.style.display = 'block';
    element = document.querySelector('#nshare');
    element.style.display = 'none';
    document.getElementById("#nshare").remove();
}
function shareN(){
    element = document.querySelector('#nshare');
    element.style.display = 'block';
    element = document.querySelector('#share');
    element.style.display = 'none';
    element = document.querySelector('#sharet');
    element.style.display = 'none';
    document.getElementById("#sharet").remove();
}
function show_admin(){
    element = document.querySelector('#admin');
    element.style.display = 'block';
    element = document.querySelector('#user');
    element.style.display = 'none';
}
function show_user(){
    element = document.querySelector('#admin');
    element.style.display = 'none';
    element = document.querySelector('#user');
    element.style.display = 'block';
}
function showPassLL() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}
function A(){
    element = document.querySelector('#ANM');
    element.style.display = 'block';
    element = document.querySelector('#BNM');
    element.style.display = 'none';
    element = document.querySelector('#CNM');
    element.style.display = 'none';
    element = document.querySelector('#DNM');
    element.style.display = 'none';
}
function B(){
    element = document.querySelector('#ANM');
    element.style.display = 'none';
    element = document.querySelector('#BNM');
    element.style.display = 'block';
    element = document.querySelector('#CNM');
    element.style.display = 'none';
    element = document.querySelector('#DNM');
    element.style.display = 'none';
}
function C(){
    element = document.querySelector('#ANM');
    element.style.display = 'none';
    element = document.querySelector('#BNM');
    element.style.display = 'none';
    element = document.querySelector('#CNM');
    element.style.display = 'block';
    element = document.querySelector('#DNM');
    element.style.display = 'none';
}
function D(){
    element = document.querySelector('#ANM');
    element.style.display = 'none';
    element = document.querySelector('#BNM');
    element.style.display = 'none';
    element = document.querySelector('#CNM');
    element.style.display = 'none';
    element = document.querySelector('#DNM');
    element.style.display = 'block';
}
function AA(){
    element = document.querySelector('#AMM');
    element.style.display = 'block';
    element = document.querySelector('#BMM');
    element.style.display = 'none';
    element = document.querySelector('#CMM');
    element.style.display = 'none';
    element = document.querySelector('#DMM');
    element.style.display = 'none';
}
function BB(){
    element = document.querySelector('#AMM');
    element.style.display = 'none';
    element = document.querySelector('#BMM');
    element.style.display = 'block';
    element = document.querySelector('#CMM');
    element.style.display = 'none';
    element = document.querySelector('#DMM');
    element.style.display = 'none';
}
function CC(){
    element = document.querySelector('#AMM');
    element.style.display = 'none';
    element = document.querySelector('#BMM');
    element.style.display = 'none';
    element = document.querySelector('#CMM');
    element.style.display = 'block';
    element = document.querySelector('#DMM');
    element.style.display = 'none';
}
function DD(){
    element = document.querySelector('#AMM');
    element.style.display = 'none';
    element = document.querySelector('#BMM');
    element.style.display = 'none';
    element = document.querySelector('#CMM');
    element.style.display = 'none';
    element = document.querySelector('#DMM');
    element.style.display = 'block';
}
function OSS(){
    element = document.querySelector('#AMM');
    element.style.display = 'none';
    element = document.querySelector('#BMM');
    element.style.display = 'none';
    element = document.querySelector('#CMM');
    element.style.display = 'none';
    element = document.querySelector('#DMM');
    element.style.display = 'none';
    element = document.querySelector('#OSS');
    element.style.display = 'block';
}
$(document).ready(function () {
    $("#flash-msg").delay(7000).fadeOut("slow");
});
$(document).ready(function() {
    $('#example').DataTable();
});
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})
$('.popover-dismiss').popover({
    trigger: 'focus'
})
function addFile(){
    element = document.querySelector('#princiale_file');
    element.style.display = 'none';
    element = document.querySelector('#share');
    element.style.display = 'none';
    element = document.querySelector('#shareMe');
    element.style.display = 'none';
    element = document.querySelector('#addFile');
    element.style.display = 'block'; 
}
function NullFile(){
    element = document.querySelector('#princiale_file');
    element.style.display = 'block';
    element = document.querySelector('#share');
    element.style.display = 'none';
    element = document.querySelector('#shareMe');
    element.style.display = 'none';
    element = document.querySelector('#addFile');
    element.style.display = 'none'; 
}
function NullOss(){
    element = document.querySelector('#AMM');
    element.style.display = 'block';
    element = document.querySelector('#BMM');
    element.style.display = 'none';
    element = document.querySelector('#CMM');
    element.style.display = 'none';
    element = document.querySelector('#DMM');
    element.style.display = 'none';
    element = document.querySelector('#OSS');
    element.style.display = 'none'; 
}
function ShowShare(){
    element = document.querySelector('#princiale_file');
    element.style.display = 'none';
    element = document.querySelector('#sharenj');
    element.style.display = 'block';
    element = document.querySelector('#shareMe');
    element.style.display = 'none';
}
function ShowPrinc(){
    element = document.querySelector('#sharenj');
    element.style.display = 'none';
    element = document.querySelector('#princiale_file');
    element.style.display = 'block';
}
function ShowShareWith(){
    element = document.querySelector('#princiale_file');
    element.style.display = 'none';
    element = document.querySelector('#shareMe');
    element.style.display = 'block';
}
function ShowSharePrinc(){
    element = document.querySelector('#sharenj');
    element.style.display = 'none';
    element = document.querySelector('#shareMe');
    element.style.display = 'block';
}
function HomeGO(){
    element = document.querySelector('#shareMe');
    element.style.display = 'none';
    element = document.querySelector('#sharenj');
    element.style.display = 'none';
    element = document.querySelector('#princiale_file');
    element.style.display = 'block';
}
// -------POPUP Warning------- //
$('#delete').click(function(){
    $('.alert').removeClass("hide");
    $('.alert').addClass("show");
    setTimeout(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    }, 5000);
});
$('.close-btn').click(function(){
    $('.alert').removeClass("show");
    $('.alert').addClass("hide");
});