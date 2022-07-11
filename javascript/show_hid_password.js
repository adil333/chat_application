const eyeBtn = document.querySelector(".form .field i"),
      passwordInput = document.querySelector(".form  input[type='password']");


eyeBtn.onclick = ()=>{
    if(passwordInput.type === "password"){
        passwordInput.type = "text";
        eyeBtn.classList.add("active");
    }else{
        passwordInput.type = "password";
        eyeBtn.classList.remove("active");
    }
}