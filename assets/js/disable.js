var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 
    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        ctrlKeyDown = true;
    }
};

function keyup(e){
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};

function disableF5(e) { 
    if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); 
};
    $(document).ready(function(){
    $(document).on("keydown", disableF5);
});

$(window).bind('beforeunload', function(e) { 
    return "Unloading this page may lose data. What do you want to do..."
    e.preventDefault();
});

function copyToClipboard() {
    var aux = document.createElement("input");
    aux.setAttribute("value", "");
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}

$(window).keyup(function(e){
    if(e.keyCode == 44){
      copyToClipboard();
    }
}); 

$(window).focus(function() {
    $("body").show();
}).blur(function() {
    $("body").hide();
});