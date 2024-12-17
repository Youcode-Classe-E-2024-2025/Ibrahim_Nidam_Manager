const login = document.getElementById("login")
const signup = document.getElementById("signup")


const login_submit = document.getElementById('input[name="login"]')
const signUp_submit = document.querySelector('input[name="signup"]')


//SIGN UP VALIDATION AND DATA SEND START
signup.addEventListener("submit",async e =>{
    e.preventDefault()
    
    const signUp_name = document.getElementById("signup-name").value.trim()
    const signUp_email = document.getElementById("signup-email").value.trim()
    const signUp_pass = document.getElementById("signup-pass").value.trim()
    
    const name_Regex = /^[A-Za-z]{2,50}(?:\s[A-Za-z]{2,50})*$/;
    const email_Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const password_Regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/;
    
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
        const response = await fetch("Assets/includes/signup.php",{
            method : "POST",
            headers :{
                "content-Type" : "application/x-www-form-urlencoded",
            },
            body : `name=${encodeURIComponent(signUp_name)}&email=${encodeURIComponent(signUp_email)}&password=${encodeURIComponent(signUp_pass)}`,
        })
        
        console.log("Response status:", response.status);
    console.log("Response headers:", response.headers);

    // Check the response text before parsing as JSON
    const responseText = await response.text();
    console.log("Raw response text:", responseText);

    try {
        const result = JSON.parse(responseText);
        console.log("Parsed result:", result);

        if(result.Success){
            alert(result.Success);
            signup.reset();
        } else if(result.error) {
            alert(result.error);
        }
    } catch (parseError) {
        console.error("JSON parsing error:", parseError);
        console.log("Unparseable response text:", responseText);
        alert("Error parsing server response");
    }
    }catch(error){
        console.error("error : ", error)
        alert("An error occurred while signing up.")
    }
    //SEND DATA END
    signup.reset()
})
//SIGN UP VALIDATION AND DATA SEND END

//LOGIN VALIDATION AND DATA SEND START
login.addEventListener("submit", async e =>{
    e.preventDefault()
    
    const login_email = document.getElementById("login-email").value.trim()
    const login_pass = document.getElementById("login-pass").value.trim()
    
    try{
        const response = await fetch("Assets/includes/login.php",{
            method : "POST",
            headers : {
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
        console.error("error : ", error)
        alert("An error occurred while signing up.")
    }
    login.reset()
})
//LOGIN DATA SEND END

//HANDLE PASSWORD VISIBILITY START
function setupPasswordToggle(inputId, toggleId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(toggleId);

    toggleIcon.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "Assets/images/icons/eye visibility.svg";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "Assets/images/icons/eye visibility off.svg";
        }
    });
}
//HANDLE PASSWORD VISIBILITY END

document.addEventListener("DOMContentLoaded",()=>{
    setupPasswordToggle("login-pass", "login-toggle");
    setupPasswordToggle("signup-pass", "signup-toggle");
    login.reset()
    signup.reset()
})