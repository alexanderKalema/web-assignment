const paragraph = document.getElementById("clip");
const button = document.getElementById("read");

button.addEventListener("click", function () {
  if (paragraph.style.height === "100px") {
    paragraph.style.height = "auto";
    button.textContent = "Read less";
  } else {
    paragraph.style.height = "100px";
    button.textContent = "Read more";
  }
});
const stars = document.querySelectorAll(".star");
const rating = document.getElementById("rating");

stars.forEach((star) => {
  star.addEventListener("click", function() {
    const value = this.getAttribute("data-value");
    rating.setAttribute("data-value", value);
    updateStars(value);
  });
});

function updateStars(value) {
  stars.forEach((star) => {
    const starValue = star.getAttribute("data-value");
    if (starValue <= value) {
      star.classList.add("selected");
    } else {
      star.classList.remove("selected");
    }
  });
}