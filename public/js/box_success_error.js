let time_er;
function showError(message){
    document.querySelector(".p-error-bx").innerHTML = message;
    document.querySelector(".div-error-bx").style.top = "100px";
    clearTimeout(time_er);
    time_er = setTimeout(function(){
        document.querySelector(".div-error-bx").style.top = "-520px";
    }, 4000);
}

let time_su;
function showSuccess(message){
    document.querySelector(".p-success-bx").innerHTML = message;
    document.querySelector(".div-success-bx").style.top = "100px";
    clearTimeout(time_su);
    time_su = setTimeout(function(){
        document.querySelector(".div-success-bx").style.top = "-520px";
    }, 4000);
}