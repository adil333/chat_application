const searchInput = document.querySelector(".search input"),
searchBtn = document.querySelector(".search button");

searchBtn.onclick = ()=>{
   searchInput.classList.toggle("show");
   searchInput.focus();
   searchBtn.classList.toggle("active");
}

