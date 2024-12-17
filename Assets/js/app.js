const login = document.getElementById("login")
const signup = document.getElementById("signup")

const login_email = document.getElementById("login-email").value
const login_pass = document.getElementById("login-pass").value
const login_submit = document.getElementById('input[name="login"]')

const signUp_name = document.getElementById("signup-name").value
const signUp_email = document.getElementById("signup-email").value
const signUp_pass = document.getElementById("signup-pass").value
const signUp_submit = document.querySelector('input[name="signup"]')

const name_Regex = /^[A-Za-z]{2,50}(?:\s[A-Za-z]{2,50})*$/;
const email_Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const password_Regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

//SIGN UP VALIDATION AND DATA SEND START
signup.addEventListener("submit",async e=>{
    e.preventDefault()

    //REGEX START
    if(!name_Regex.test(signUp_name)){
        alert("Invalid name format.");
        return;
    }

    if(!email_Regex.test(signUp_email)){
        alert("Invalid email format.")
        return
    }

    if(!password_Regex.test(signUp_pass)){
        alert('Password must be at least 8 characters long and contain both letters and numbers.');
        return;
    }
    //REGEX END

    //SEND DATA START
    try{
        const response = await fetch("../includes/signup.php",{
            method : "POST",
            header:{
                "content-Type" : "application/x-www-form-urlencoded",
            },
            body : `name=${encodeURIComponent(signUp_name)}$email=${encodeURIComponent(signUp_email)}&password=${encodeURIComponent(signUp_pass)}`,
        })

        const result = await response.json();
        if(result.success){
            alert(result.success)
        }else{
            alert(result.error)
        }
    }catch(error){
        console.error("Error : ", error)
        alert("An error occurred while signing up.")
    }
    //SEND DATA END
    signup.reset()
})
//SIGN UP VALIDATION AND DATA SEND END

//LOGIN VALIDATION AND DATA SEND START
login.addEventListener("submit", async e =>{
    e.preventDefault()

    try{
        const response = await fetch("../includes/login.php",{
            method : "POST",
            header : {
                "content-Type" : "application/x-www-form-urlencoded",
            },
            body : `email=${encodeURIComponent(login_email)}&password=${encodeURIComponent(login_pass)}`
        })

        const result = await response.json()
        if(result.success){
            alert(result.success)
        }else{
            alert(result.error)
        }
    }catch(error){
        console.error("Error : ", error)
        alert("An error occurred while signing up.")
    }
    login.reset()
})
//LOGIN DATA SEND END

document.addEventListener("DOMContentLoaded",()=>{
    login.reset()
    signup.reset()
})