// const userMenu = document.querySelector(".profile-menu");
// const userIcon = document.querySelector(".user-btn");

// userIcon.addEventListener("click", ()=>{
//     userMenu.classList.toggle("hidden");
// })

// window.addEventListener("scroll", ()=>{
//     userMenu.classList.add("hidden");
// })

const hamburger = document.querySelector(".hamburger");
const navbar = document.querySelector(".sideMenu");
const mainList = document.querySelectorAll(".list-inline");

hamburger.addEventListener("click", ()=>{
    // mobileMenu();
    navbar.classList.toggle("side-menu");
    console.log("dfvdfvdfvdf")
});

// hide mobile menu when scrolling
// window.addEventListener("scroll", ()=>{
//     hideMobileMenu();
// })


function mobileMenu(){
    navbar.classList.toggle("navbar");
    navbar.classList.toggle("mobile-menu");
    mainList.forEach((list)=>{
        list.classList.toggle("list-inline");
        list.classList.toggle("list-block-mobile");
    });
}

// function hideMobileMenu(){
//     navbar.classList.add("navbar");
//     navbar.classList.remove("mobile-menu");
//     mainList.forEach((list)=>{
//         list.classList.add("list-inline");
//         list.classList.remove("list-block-mobile");
//     });
// }




// ****************update user coin*******************
// const topUpForm = document.querySelector("#top-up-form")

// topUpForm.addEventListener("submit", (e)=>{
//     e.preventDefault();
//     const fbk = document.querySelector('.feedback');
//     const coin = document.querySelector('#coin').value;
//     const amt = document.querySelector('#amt').value;
//     const addr = document.querySelector('#addr').value;
//     const id = document.querySelector('#id').value;
//     const sWrap = document.querySelector('.selection-wrapper');
//     sWrap.style.zIndex = 1;

//     let req = new XMLHttpRequest();
//     req.open('POST', 'process.php', true);
//     req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
//     req.onload = function(){
//         if (req.responseText == "Successful") {
//             location.reload();
//         }else{
//             sWrap.style.zIndex = 4;
//             fbk.innerHTML = req.responseText;
//         }
//     }

//     req.send("coin="+coin+"&amt="+amt+"&addr="+addr+"&id="+id);
// })
