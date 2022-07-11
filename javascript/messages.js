const form = document.querySelector("form"),
input = form.querySelector("input"),
btnSned = form.querySelector("button"),
incoming_id = form.querySelector(".incoming_id").value;
chatbox = document.querySelector(".chat-area .chat-box")




function ajax_SendMsg(){
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {        
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200){
                let data = xhr.response;
                console.log(data)
        }else{
            console.log("200")
        }
    }

    btnSned.onsubmit = (e)=>{
        e.preventDefault();}
        
    xhr.open("POST", "php/post_msg.php", true)
    let formdata = new FormData(form);
    console.log(formdata)
    xhr.send(formdata)
}

setInterval( () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get_chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatbox.innerHTML = data
            console.log(data)
          }
      }
    }
    //permet de renvoyer le header type sous form de couple cle valeur 
     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("incoming_id="+incoming_id);
}

,500)