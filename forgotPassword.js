const resetPasswordButton = document.getElementById('reset-password');
const emailInput = document.getElementById('email');
const errorMessage = document.getElementById('error-message');

resetPasswordButton.addEventListener('click', function(event) {
    event.preventDefault();  

    const email = emailInput.value.trim();

    if (validateEmail(email)) {
        errorMessage.textContent = 'Password reset link sent successfully!';
        errorMessage.style.color = 'green';

    } else {
        errorMessage.textContent = 'Please enter a valid email address (must be @cremedelecreme.com).';
        errorMessage.style.color = 'red';
    }
});

function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@cremedelecreme\.com$/;
    return emailPattern.test(email);
}

