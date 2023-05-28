const likeButtons = document.querySelectorAll('.like');
    const dislikeButtons = document.querySelectorAll('.dislike');
    

    likeButtons.forEach((likeButton) => {
      likeButton.addEventListener('click', () => {
        likeButton.classList.toggle('fas');
        likeButton.classList.toggle('selected');
        likeButton.nextElementSibling.classList.remove('selected');
        likeButton.nextElementSibling.classList.remove('fas');
      });
    });

    dislikeButtons.forEach((dislikeButton) => {
      dislikeButton.addEventListener('click', () => {
        dislikeButton.classList.toggle('fas');
        dislikeButton.classList.toggle('selected');
        dislikeButton.previousElementSibling.classList.remove('selected');
        dislikeButton.previousElementSibling.classList.remove('fas');
      });
    });

const addReviewText = document.querySelector('.add-review-text');
const reviewContainer = document.querySelector('.review-container');
const addReviewButton = document.querySelector('.add-review');


addReviewButton.addEventListener('click', () => {
  addReviewText.style.display = 'block';
});


const submitButton = addReviewText.querySelector('.click');
submitButton.addEventListener('click', () => {
  const reviewText = addReviewText.querySelector('textarea').value;
  if (reviewText.trim() !== '') {
    const newReview = document.createElement('div');
    newReview.classList.add('review');
    const newReviewText = document.createElement('p');
    newReviewText.classList.add('review-text');
    newReviewText.textContent = reviewText;
    const newIcons = document.createElement('div');
    newIcons.classList.add('icons');
    const newLike = document.createElement('i');
    newLike.classList.add('far', 'fa-thumbs-up', 'like');
    const newDislike = document.createElement('i');
    newDislike.classList.add('far', 'fa-thumbs-down', 'dislike');
    newIcons.appendChild(newLike);
    newIcons.appendChild(newDislike);
    newReview.appendChild(newReviewText);
    newReview.appendChild(newIcons);

  
    document.querySelector('.container').appendChild(newReview);

    
    addReviewText.remove();
  }
});

