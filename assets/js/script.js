document.getElementById('commentForm').addEventListener('submit', (event) => {
    event.preventDefault();
    const commentText = document.getElementById('commentText').value;
  
    // Send comment to server-side script using AJAX
    fetch('submit_comment.php', {
      method: 'POST',
      body: JSON.stringify({ comment: commentText })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Clear the comment input field
        document.getElementById('commentText').value = '';
        // Fetch and display updated comments
        fetchComments();
      } else {
        // Handle error
        console.error(data.error);
      }
    });
  });
  
  function fetchComments() {
    fetch('fetch_comments.php')
    .then(response => response.json())
    .then(comments => {
      const commentSection = document.getElementById('commentSection');
      commentSection.innerHTML = ''; // Clear existing comments
  
      comments.forEach(comment => {
        const commentDiv = document.createElement('div');
        commentDiv.textContent = comment.text;
        commentSection.appendChild(commentDiv);
      });
    });
  }
  
  // Initial fetch of comments
  fetchComments();