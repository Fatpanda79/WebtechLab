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
    const Email= document.getElementById("mail");
    const Emailerror =document.getElementById("emailerror");
    const Password = document.getElementById("pass");
    const Passworderror = document.getElementById("Passworderror");
    const confirmpassword = document.getElementById("Cpass");
    const confirmpassworderror = document.getElementById("confirmpassworderror");
    const zipcode=document.getElementById("zcode");
    const ziperror = document.getElementById("ziperror");
    const terms = document.getElementById("terms");
    const termserror = document.getElementById("termerror");

    function checkName(fn){
        for(let i=0;i < fn.length;++i)
        {
            const f = fn[i];
            const fcode = f.charCodeAt(0);
            if(!(fcode>=65 && f<=90) && !(fcode >= 97 && fcode <= 122) && f !== '.' &&
            f !== ' ')
            {
                return false;
            }

           
        }
        return true;
    }

    const regex = /^[a-zA-Z0-9._%+-]+@aiub\.edu$/;
    function checkEmail(em) {
        return regex.test(em);
    }
    function checkEmail(em)
    {
        if(regex.test(em))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    const regex1 = /^[A-Za-z\d.,?!@#%]+$/
    function checkPass(pass)
    {

        if(pass.length>=5 && regex1.test(pass))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    const regex2 = /^[0-9]+$/
    function checkzip(zip)
    {
        if(regex2.test(zip))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    form1.addEventListener("submit", (e) => {
        let valid = true;
        if (FirstName.value.trim() === "") {
            //e.preventDefault();
            Fnameerror.innerHTML = "Error: Please fill it";
            Fnameerror.style.color = "red";
            valid = false;
        } 
       
        FirstName.addEventListener('input',()=>{

            if (FirstName.value.trim() === "") {
                //e.preventDefault();
                Fnameerror.innerHTML = "Error: Please fill it";
                Fnameerror.style.color = "red";
                valid = false;
            } 
            
            else if(!checkName(FirstName.value.trim()))
            {
                //e.preventDefault();
                Fnameerror.innerHTML = "Error: Please only use (Alphabets,dot,space)";
                Fnameerror.style.color = "red";
                valid = false;
            }
            else {
                //e.preventDefault();
                Fnameerror.innerHTML = "";   
            }

        })
        if(Email.value =="")
        {
            valid=false;
                    
            Emailerror.innerHTML = "Error: Please use proper email format(eg: abc123@aiub.edu)";
            Emailerror.style.color = "red";
        }
        Email.addEventListener('input',()=>{
                if (Email.value.trim() === "" || !checkEmail(Email.value.trim()))
                    {
                        Emailerror.innerHTML = "Error: Please use proper email format(eg: abc123@aiub.edu)";
                        Emailerror.style.color = "red";
                    }
                    else
                    {
                        Emailerror.innerHTML="";
                    }

            })
        if(!checkPass(Password.value))
            {
                valid=false;
                Passworderror.innerHTML = "Error: Please use proper password format(eg:aAb123?!@#%.,)";
                Passworderror.style.color = "red";
            }
            else
            {
                Passworderror.innerHTML="";
            }
        Password.addEventListener('input',()=>{
            if(!checkPass(Password.value))
                {
                    valid=false;
                    Passworderror.innerHTML = "Error: Please use proper password format(eg:aAb123?!@#%.,)";
                    Passworderror.style.color = "red";
                }
                else
                {
                    Passworderror.innerHTML="";
                }
            
        })
       if(confirmpassword.value == "")
       {
        valid=false;
        confirmpassworderror.innerHTML = "Error: Match the password";
        confirmpassworderror.style.color = "red";
       }
        confirmpassword.addEventListener('input',()=>{
            if(confirmpassword.value !== Password.value)
                {
                 valid=false;
                 confirmpassworderror.innerHTML = "Error: Match the password";
                 confirmpassworderror.style.color = "red";
                }
                else
                {
                 confirmpassworderror.innerHTML="";
                }
        })
        if(zipcode.value == "")
        {
            valid=false;
            ziperror.innerHTML="Error:please provide proper zipcode";
            ziperror.style.color="red";
        }
        zipcode.addEventListener('input',()=>{
            if(!checkzip(zipcode.value) || (zipcode.value.length !== 4 ))
            {
                valid=false;
                ziperror.innerHTML="Error:please provide proper zipcode";
                ziperror.style.color="red";
            }
            else
            {
                ziperror.innerHTML="";
            }
        })
        if(!terms.checked)
            {
                valid=false;
                termserror.innerHTML="Error:please check terms and conditions";
                termserror.style.color="red";
            }
        terms.addEventListener('input',()=>
        {
            if(!terms.checked)
            {
                    valid=false;
                    termserror.innerHTML="Error:please check terms and conditions";
                    termserror.style.color="red";
            }
            else
            {
                    termserror.innerHTML="";
            }

        })
        
        if(!valid)
        {
            e.preventDefault();
        }
        else if (valid)
        {
            alert("Submitted successfully!");
        }


    });
});
