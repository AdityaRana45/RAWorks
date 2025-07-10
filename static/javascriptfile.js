(function() {
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slideshow-box .slideshow-slide");
    const dots = document.querySelectorAll(".slideshow-box .slideshow-dot");

    function showSlides() {
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}    

      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }

      slides[slideIndex - 1].style.display = "block";  
      dots[slideIndex - 1].classList.add("active");
      setTimeout(showSlides, 2000); // Change image every 2 seconds
    }

    showSlides();
  })();

  
  function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}