document.getElementById("open-modal-btn").addEventListener("click", function() {
  document.getElementById("review-modal").style.display = "block";
});

document.getElementsByClassName("close")[0].addEventListener("click", function() {
  document.getElementById("review-modal").style.display = "none";
});

document.querySelectorAll(".star").forEach(function(star) {
  star.addEventListener("click", function() {
    document.querySelectorAll(".star").forEach(function(s) {
      s.style.color = "#ccc";
    });

    var value = parseInt(this.getAttribute("data-value"));
    for (var i = 0; i < value; i++) {
      document.querySelectorAll(".star")[i].style.color = "#ffc107";

    }
  });
});


var reviews = [];

function displayPreviousReviews() {
  var reviewsList = document.getElementById("reviews-list");

  reviewsList.innerHTML = "";

  reviews.forEach(function(review) {
    var li = document.createElement("li");
    li.textContent = "Rating: " + review.rating + ", Review: " + review.text;
    reviewsList.appendChild(li);
  });
}

document.getElementById("submit-review").addEventListener("click", function() {
  var rating = document.querySelectorAll(".star[style='color: rgb(255, 193, 7);']").length;
  var reviewText = document.getElementById("review-text").value.trim();
  if (rating === 0) {
    alert("Please rate the product before submitting your review.");
    return;
  }
  if (reviewText === "") {
    alert("Please write your review before submitting.");
    return;
  }

  var review = {
    rating: rating,
    text: reviewText
  };
  reviews.push(review);

  displayPreviousReviews();
  document.querySelectorAll(".star").forEach(function(star) {
    star.style.color = "#ccc";
  });
  document.getElementById("review-text").value = "";
  document.getElementById("review-modal").style.display = "none";
  alert("Thank you for your review!");
});
displayPreviousReviews();
