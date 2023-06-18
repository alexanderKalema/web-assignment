   const favoriteBtn = document.getElementById('favoriteBtn');
const watchlistBtn = document.getElementById('watchlistBtn');
const messageBox = document.getElementById('messageBox');
let favclick=false;
let watchclick=false;
function handleLikeClick(button) {
            button.classList.toggle("clicked");
            
        }
        function handleDislikeClick(button) {
            button.classList.toggle("clicked");
        }
favoriteBtn.addEventListener('click', () => {
     if(favclick==false){
    showMessage('added to favorites');
    favclick=true;
     }
     else{
        showMessage('Removed from favorites');
        favclick=false;

     }
});

watchlistBtn.addEventListener('click', () => {
    const check = document.querySelector('.check');
    if(watchclick==false){
        check.classList.remove('fa-plus');
    check.classList.add('fa-check');
        showMessage('added to watchlist');
    watchclick=true;
     }
     else{
        

    check.classList.remove('fa-check');
        check.classList.add('fa-plus');
        showMessage('Removed from watchlist');
       watchclick=false;

     }

     
});



function showMessage(text) {
    messageBox.textContent = text;
    messageBox.style.display = 'block';
    setTimeout(() => {
        messageBox.style.display = 'none';
    }, 2000);
}



        const images = document.querySelectorAll('.bg-image');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
let currentImage = 0;

function changeImage() {
    
    images.forEach((img, index) => {
    
        img.style.opacity = index === currentImage ? 1 : 0;
    });
    
}

function nextImage() {
    currentImage = (currentImage + 1) % images.length;
    changeImage();
}

function prevImage() {
    currentImage = (currentImage - 1 + images.length) % images.length;
    changeImage();
}

prevBtn.addEventListener('click', prevImage);
nextBtn.addEventListener('click', nextImage);

setInterval(nextImage, 5000); 



const stars = document.querySelectorAll('.star');
const starsContainer = document.getElementById('stars');
const ratingText = document.getElementById('rating-text');

let totalrate=4.5;
let oldrate=0;
let num=1;
let numcheck=1;
let orginalrate=4.5;
let update=false;
let rating = 0;


starsContainer.addEventListener('mouseout', () => {
  if (rating === 0) {
    stars.forEach(star => star.classList.remove('filled'));
  } else {
    for (let i = 0; i < rating; i++) {
      stars[i].classList.add('filled');
    }
    for (let i = rating; i < stars.length; i++) {
      stars[i].classList.remove('filled');
    }
  }
});

stars.forEach((star, index) => {
  star.addEventListener('mouseover', () => {
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add('filled');
    }
  });


  star.addEventListener('click', () => {
    if (rating === index + 1) {
      rating = 0;
      num--;
      stars.forEach(star => star.classList.remove('filled'));
    } else {
        if(rating==0){ 
            num++;
        }
        
      for (let i = 0; i <= index; i++) {
        stars[i].classList.add('filled');
      }
      for (let i = index + 1; i < stars.length; i++) {
        stars[i].classList.remove('filled');
      }
      
      rating = index + 1;
    }
    if(num>numcheck){
        numcheck=num;
    }
   
    
    if(update==false){
    totalrate= (totalrate-oldrate+rating)/num;
    oldrate=rating;
    update=true;
    }
    else{
        if(numcheck==num){
       totalrate= ((totalrate*num)-oldrate+rating)/num;
       oldrate=rating;
    
       
       
    }
    else{
        oldrate=0;
        update=false;
        totalrate=orginalrate;
       
    }
    }
    numcheck=num;
    
    
    
    
    var ratingparagraph = document.getElementById("rating-paragraph");
    ratingparagraph.textContent = "Rating: " + totalrate + "/5";
   
  });

});



const watchTrailerBtn = document.querySelector('.watch-trailer-btn');
const videoPlayer = document.querySelector('.video-player');
const closeBtn = document.querySelector('.close-btn');

watchTrailerBtn.addEventListener('click', () => {
  videoPlayer.style.display = 'flex';
});

closeBtn.addEventListener('click', () => {
  videoPlayer.style.display = 'none';

const video = document.getElementById('video');

  video.pause();
  





});
