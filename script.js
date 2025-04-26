/*const FirstName = document.getElementById("fname");
const SecondName = document.getElementById("lname");
const Email = document.getElementById("mail");
const pass = document.getElementById("pass");
const Cpass = document.getElementById("Cpass");
const location = document.getElementById("location");
const Zcode = document.getElementById("zcode");

const form1 = document.querySelector(".form1");
const Fnameerror = document.getElementById("fnameerror");

form1.addEventListener("submit", (e) => {
    if (FirstName.value === "" || FirstName.value == null) {
        e.preventDefault();
        Fnameerror.innerHTML = "Error: Please fill it";
    }
});*/
document.addEventListener("DOMContentLoaded", function () {
    const FirstName = document.getElementById("fname");
    const form1 = document.getElementById("form1");
    const Fnameerror = document.getElementById("fnameerror");

    form1.addEventListener("submit", (e) => {
        if (FirstName.value.trim() === "") {
            e.preventDefault();
            Fnameerror.innerHTML = "Error: Please fill it";
            Fnameerror.style.color = "red";
        } 
        else {
            e.preventDefault();
            Fnameerror.innerHTML = "";
            
        }
    });
});

