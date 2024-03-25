
window.onscroll = function() {scrollFunction()};
// This function is necessary becuase we need to create a point where the user scrolls down past a point so the logo can "disappear" and "reappear"
//The Scroll Function is triggered when the user scrolls past a certain point , then it will adjust the styling on the logo div and the logo image itself.This creates a animation 
function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("logo_div").style.padding ="10px 5px";
    
    document.getElementById("logo").style.width ="5%";
    document.getElementById("logo").style.height ="5%";



  } else {
    document.getElementById("logo_div").style.padding = "10px 10px";

   

    document.getElementById("logo").style.width ="300px";
    document.getElementById("logo").style.height ="300px";
  }
}

    let slideIndex = 0;
    showSlides();
    //This function is required so that the slideshow can automatically move along and have the indicators follow in suit 
function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("Slide_Indicator");
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 10000); 
    }


    
//This function has been designed to display a modal window the first time a user visits a webpage and then hide it on subsequent visits. It accomplishes this by using cookies to keep track of whether the modal has been shown before .
        
window.addEventListener('load', function() {
    var modal = document.getElementById('Login_Modal');
    var closeModal = document.getElementById('close_Modal');
    var modalShown = getCookie('modalShown');

    if (!modalShown) {
        modal.style.display = 'block';

        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            setCookie('modalShown', 'true', 30);
        });
    }
});

//Sets a cookie with a given name, value and expiration time 
function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + value + expires + '; path=/';
}
//Retrieves the value of a cookie by name 
function getCookie(name) {
    var nameEQ = name + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) == ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) == 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}

    // Sets up the Owl Carousel for the image carousel
    var owl = $('.owl-carousel');
    
    function pauseCarousel() {
        owl.trigger('stop.owl.autoplay');
    }

    function playCarousel() {
        owl.trigger('play.owl.autoplay');
    }

    owl.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        autoplay: true,
        dots: false,
        autoplayTimeout: 1000,
        padding: 0,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // ShowRegisterForm , ShowAdminForm ,ShowLoginForm these dynamically change the modal in realtime 
    //This function is needed to change the login modal so that other forms can be displayed 
function showRegisterForm() {
    // Get the form element
    const modalForm = document.getElementById('modalForm');

    // Change the form content
    modalForm.innerHTML = `
        <button class="Register_button" onclick="showLoginForm()">Back to Login</button>
        <span class="close" id="close_Modal" onclick="closeModal()">&times;</span>
        <div class="model_img_container">
            <a href="javascript:showAdminForm()"><img src="Images/logo.png" class="Login_img"></a>
        </div>
        <div class="username_password_container">
            <label class="Label" for="newUsername"><b><p> Create a Username</b></p></label>
            <input type="username" placeholder="Enter a Username" name="newUsername">
            <label class="Label" for="newPassword"><b><p>Create a Password</p></b</label>
            <input type="password" placeholder="Enter a Password" name="newPassword">
            <button class="Login_submit_button" type="submit"><b>Register</b></button>
        </div>
    `;

   

}

function showLoginForm() {
    
    const modalForm = document.getElementById('modalForm');
    modalForm.innerHTML = `
        <button class="Register_button" onclick="showRegisterForm()">Register Here</button>
        <span class="close" id="close_Modal"onclick="closeModal()">&times;</span>
        <div class="model_img_container">
            <a href="javascript:showAdminForm()"><img src="Images/logo.png" class="Login_img"></a>
        </div>
        <div class="username_password_container">
            <label class="Label" for="uname"><b><p>Username</p></b></label>
            <input type="username" placeholder="Enter Username" name="uname">
            <label class="Label" for="psw"><b><p>Password</p></b></label>
            <input type="password" placeholder="Enter Password" name="psw">
            <button class="Login_submit_button" type="submit"><b>Login</b></button>
            <div class="username_password_footer">
                <label>
                    <input type="checkbox" unchecked="unchecked" name="remember"><b> Remember me</b>
                </label>
                <br><br>
                <a href="javascript:alert('We have sent a password reset email to your email address , please check your inbox');" ><b>Change Password</b></a>
            </div>
        </div>
    `;
}
function showAdminForm(){
    const modalForm = document.getElementById('modalForm');
    modalForm.innerHTML = `
        <button class="Register_button" onclick="showLoginForm()">Customer Login</button>
        <span class="close" id="close_Modal"onclick="closeModal()">&times;</span>
        <div class="model_img_container">
            <a href="javascript:showAdminForm()"><img src="Images/logo.png" class="Login_img"></a>
        </div>
        <div class="username_password_container">
            <label class="Label" for="uname"><b><p>Admin Username<b></p></label>
            <input type="username" placeholder="Enter Admin Username" name="uname">
            <label class="Label" for="psw"><b><p>Admin Password</p></b></label>
            <input type="password" placeholder="Enter Admin Password" name="psw">
            <button class="Login_submit_button" type="submit"><b>Login</b></button>
            <div class="username_password_footer">
                <a href="javascript:alert('We have sent a password reset email to your email address , please check your inbox');" ><b>Change Password</b></a>
            </div>
        </div>
    `;
}
// Closes the login modal
function closeModal() {
    const openModal = document.querySelector('.login_modal[style="display: block;"]');
    if (openModal) {
        openModal.style.display = 'none';
        }
    }
//Changes the styling of a section when the mouse  hovers over it 
function Colour_Change_Left() {
    var elementToChange = document.querySelector('.section_left_container');
    var elementToChange2= document.querySelector('.section_left_container_text');
    var elementToChange3= document.querySelector('.section_left_button');
    elementToChange.style.backgroundColor = 'darkgray';
    elementToChange2.style.color ='black';
    elementToChange.style.borderColor='6px black';
    elementToChange.style.borderStyle='dashed';



}

function Colour_Restore_Left() {
    var elementToChange = document.querySelector('.section_left_container');
    var elementToChange2= document.querySelector('.section_left_container_text');
    var elementToChange3= document.querySelector('.section_left_button');
    elementToChange.style.backgroundColor = 'black';
    elementToChange2.style.color ='white';
    elementToChange3.style.backgroundColor='black';
    elementToChange3.style.color='white';
    elementToChange3.style.borderColor='white';
    elementToChange.style.borderColor='none';
    elementToChange.style.borderStyle='none';



}

function Colour_Change_Right() {
    var elementToChange = document.querySelector('.section_right_container');
    var elementToChange2= document.querySelector('.section_right_container_text');
    var elementToChange3= document.querySelector('.section_right_button');
    elementToChange.style.backgroundColor = 'darkgray';
    elementToChange2.style.color ='black';
    elementToChange.style.borderColor='6px black';
    elementToChange.style.borderStyle='dashed';



}

function Colour_Restore_Right() {
    var elementToChange = document.querySelector('.section_right_container');
    var elementToChange2= document.querySelector('.section_right_container_text');
    var elementToChange3= document.querySelector('.section_right_button');
    elementToChange.style.backgroundColor = 'black';
    elementToChange2.style.color ='white';
    elementToChange3.style.backgroundColor='black';
    elementToChange3.style.color='white';
    elementToChange3.style.borderColor='white';        
    elementToChange.style.borderColor='none';
    elementToChange.style.borderStyle='none';



}
//Opens up the login modal when a button is pressed and sets up to needed behaviours 
function Open_Login_Modal(){
    var modal = document.getElementById('Login_Modal');
    var closeModal = document.getElementById('close_Modal');
    var modalShown = getCookie('modalShown');

    if (!modalShown) {
        modal.style.display = 'block';
        showLoginForm();

        closeModal.addEventListener('click', function() {
        
            modal.style.display = 'none';
            setCookie('modalShown', 'true', 30);
        });
    }
}

  // JavaScript to open the login modal
function Open_Login_Modal() {
    document.getElementById('Login_Modal').style.display = 'block';
}

// JavaScript to close the modal
function closeModal() {
    document.getElementById('Login_Modal').style.display = 'none';
}

// Call this function on page load to close the modal if the login was successful
function checkLoginStatus() {
    // This will check a hidden field in your HTML that gets set if there's a success message
    var loginStatus = document.getElementById('loginStatus').value;
    if (loginStatus === 'success') {
        closeModal();
    }
}

// Call checkLoginStatus on page load
window.onload = checkLoginStatus;
// Function to open the registration modal
function openRegisterModal() {
    document.getElementById('Register_Modal').style.display = 'flex';
}

// Function to close the registration modal
function closeRegisterModal() {
    document.getElementById('Register_Modal').style.display = 'none';
}

// This function will run once the window is loaded
window.onload = function() {
    // Check if the login status element exists and if its value is 'success'
    var loginStatus = document.getElementById('loginStatus');
    if (loginStatus && loginStatus.value === 'success') {
        // If successful, close the login modal
        closeModal();
        // Optionally, you can also display the success message using an alert or in a page element
        alert('Login successful! Welcome to La Paradis.');
    }
};

// Function to close the login modal
function closeModal() {
    // Hide the login modal by setting its display style to 'none'
    document.getElementById('Login_Modal').style.display = 'none';
}

// Attach event listeners to buttons
document.getElementById('adminLoginBtn').addEventListener('click', function() {
    showAdminLoginForm();
});

document.getElementById('adminRegisterBtn').addEventListener('click', function() {
    showAdminRegisterForm();

});


function showAdminLoginForm() {
    document.getElementById('Admin_Login_Modal').style.display = 'block';
}

function showAdminRegisterForm() {
    document.getElementById('Admin_Register_Modal').style.display = 'block';
}

function closeAdminRegisterModal() {
    document.getElementById('Admin_Register_Modal').style.display = 'none';
}

function closeAdminLoginModal() {
    document.getElementById('Admin_Login_Modal').style.display = 'none';
}


