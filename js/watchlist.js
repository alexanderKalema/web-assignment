// Select all movie boxes with the 'box' class
document.querySelectorAll('.box').forEach((movieBox) => {
    // Add a click event listener to each movie box
    movieBox.addEventListener('click', (event) =>{
      // Get the movie information and populate the sidebar
      const movieInfo = getImageSource(event.target); // Replace with your function to fetch movie info
      document.getElementById('simg').src = movieInfo;
  
      // Open the sidebar by setting its right position to 0
      document.getElementById('sidebar').style.right = '0';
  
      // Shift the main content by adding the 'content-shift' class
      document.getElementById('container').classList.add('content-shift');
    });
  });
  // Add a click event listener to the close button
document.getElementById('close-sidebar').addEventListener('click', () => {
    // Close the sidebar by setting its right position back to -100%
    document.getElementById('sidebar').style.right = '-100%';
  
    // Reset the main content position by removing the 'content-shift' class
    document.getElementById('container').classList.remove('content-shift');
  });
  function getImageSource(event) {
    if (event.target.tagName === 'img') {
      return event.target.src;
    } else {
      return null;
    }
  }