const form = document.querySelector(".signup form"),
  continueBtn =form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");
 

function Ajaxo(){
   // Create an XMLHttpRequest object
const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onload = function() {
  // Here you can use the Data
 
  if(this.readyState === XMLHttpRequest.DONE){
    if(this.status === 200){
       let data = xhttp.response
        console.log(data);
        if (data === "Account created successfully" || data === "Connexion..."){ 
          errorText.style.color = " #0f5132"
          errorText.style.background = "#d1e7dd"
          errorText.style.display = "block"
          errorText.textContent = data
          // header to login if we ara in sgnup and count alrady created 
          if(currentUrl.at(-1) == "index.php" || currentUrl.at(-1) == ""){
            setTimeout(headerTransfer , 2000)
            function headerTransfer(){
              location.href="login.php"; 
            }
          }
          //header to users if we are authentificat user from php/login
          if(currentUrl.at(-1) == "login.php" && data === "Connexion..."){
            setTimeout(headerTransfer , 2000)
            function headerTransfer(){
              location.href="users.php"; 
            }
          }
          
          
        }else{
          errorText.style.color = "#721c24"
          errorText.style.background = "#f8d7da"
          errorText.style.display = "block"
          errorText.textContent = data
        }       
    }
  }

}
form.onsubmit = (e)=>{
  console.log(e)
    e.preventDefault();
  }
// Send a request
let currentUrl = window.location.href;
// show which url chose for POSt information
currentUrl = currentUrl.split("/");
if(currentUrl.at(-1) == "index.php" || currentUrl.at(-1) == ""){
  xhttp.open("POST", "php/signup.php", true);
}else if(currentUrl.at(-1) == "login.php"){
   xhttp.open("POST", "php/login.php", true);
}

let dataForm = new FormData(form)
xhttp.send(dataForm)
}
    