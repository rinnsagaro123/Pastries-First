

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});



//    jQuery('#login-form').on('submit', function(e) {
//      jQuery.ajax({
//         url: 'login.php',
//         type: 'POST',
//         data: jQuery('#login-form').serialize(),

//      })

//    })

function submitData()
{

    $(document).ready(function(){

        var data = {
            user: $('#user').val(),
            pass: $('#pass').val(),
            action: $('#action').val(),
        };

        $.ajax({
            url: 'login-hover.php',
            type: 'POST',
            data: data,
            success: function(response){
                // alert(response);
                if(response == "Login Successful"){
                    window.location.reload();
                }
            }

        })
    })
}


    function zoom() {
        document.body.style.zoom = "90%" 
    }






function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);


window.onscroll = () =>{
  profile.classList.remove('active');
  navbar.classList.remove('active');
  shoppingCart.classList.remove('active');

}

var box  = document.getElementById('notif-box');
var down = false;


function toggleNotif()
{
	if (down) {
		box.style.height  = '0px';
		box.style.opacity = 0;
		down = false;
	}else {
		box.style.height  = '510px';
		box.style.opacity = 1;
		down = true;
	}
}

var swiper = new Swiper(".product-slider", {
  loop:true,
  spaceBetween: 20,
  autoplay: {
      delay: 7500,
      disableOnInteraction: false,
  },
  centeredSlides: true,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".review-slider", {
  loop:true,
  spaceBetween: 20,
  autoplay: {
      delay: 7500,
      disableOnInteraction: false,
  },
  centeredSlides: true,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});

function loader(){
    document.querySelector('.loader').style.display = 'none';
  }
  
  function fadeOut(){
    setInterval(loader, 2000);
  }
  
  window.onload = fadeOut;

    
  let navbar = document.querySelector('.navbar');
  
  document.querySelector('#menu-btn').onclick = () =>{
      navbar.classList.toggle('active'); 
      profile.classList.remove('active');  
      shoppingCart.classList.remove('active');
  }
  
  let profile = document.querySelector('.header .flex .profile');
  
  document.querySelector('#user-btn').onclick = () =>{
      profile.classList.toggle('active');
      navbar.classList.remove('active');
      shoppingCart.classList.remove('active');
  }

  
  let shoppingCart = document.querySelector('.shopping-cart');

  document.querySelector('#cart-btn').onclick = () =>{
      shoppingCart.classList.toggle('active');
      profile.classList.remove('active');
      navbar.classList.remove('active');
  }

  document.querySelectorAll('input[type="number"]').forEach(numberInput => {
    numberInput.oninput = () =>{
       if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
    };
 });

