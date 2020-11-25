const BsR1 = document.querySelector(".BsR1");
const BsR2 = document.querySelector(".BsR2");

const Bs1 = document.querySelector(".Bs1");
const Bs2 = document.querySelector(".Bs2");

const Role4 = document.querySelector(".4role");

BsR1.onclick = () => {
    Bs1.classList.remove("show");
    Bs1.classList.add("hide");
    Bs2.classList.remove("hide");
    Bs2.classList.add("show");
}

Role4.onclick = () => {
    document.getElementById("login").style.visibility = "hidden";
    document.getElementById("code").style.visibility = "block";
}