const register_btn = document.querySelector(".forgot-pw");
const register_sct = document.querySelector(".form-register");
const login_btn = document.querySelector(".forgot-lw");
const login_sct = document.querySelector(".form");

const s1 = document.querySelector(".submit-btn-s1");
const s2 = document.querySelector(".submit-btn-s2");

const s1R = document.querySelector(".s1R");
const s2R = document.querySelector(".s2R");
const s3R = document.querySelector(".s3R");

const cardAM = document.querySelector(".card A");
const cardBM = document.querySelector(".card B");
const cardCM = document.querySelector(".card C");
const cardDM = document.querySelector(".card D");

const cardAM_btn = document.querySelector(".AM");
const cardBM_btn = document.querySelector(".BM");
const cardCM_btn = document.querySelector(".CM");
const cardDM_btn = document.querySelector(".DM");

register_btn.onclick = () =>{
    login_sct.classList.remove("show");
    login_sct.classList.add("hidden");
    register_sct.classList.add("show");
    register_sct.classList.remove("hidden");
    return false;
}

login_btn.onclick = () =>{
    register_sct.classList.remove("show");
    register_sct.classList.add("hidden");
    login_sct.classList.remove("hidden");
    login_sct.classList.add("show");
    return false;
}

s1.onclick = () =>{
    s2R.classList.remove("hide");
    s2R.classList.add("show");
    s1R.classList.remove("show");
    s1R.classList.add("hide");
    return false;
}

s2.onclick = () =>{
    s3R.classList.remove("hide");
    s3R.classList.add("show");
    s2R.classList.remove("show");
    s2R.classList.add("hide");
    return false;
}

cardBM_btn.onclick = () => {
    cardAM.classList.remove("show");
    cardAM.classList.add("hide");
    cardBM.classList.remove("hide");
    cardBM.classList.add("show");
}

document.getElementById("update_profile").disabled = true;