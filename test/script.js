document.getElementById('terms-link').addEventListener('click', function() {
    document.getElementById('terms-modal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Disable scrolling outside modal
});

document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('terms-modal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Enable scrolling again
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('terms-modal')) {
        document.getElementById('terms-modal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scrolling again
    }
});