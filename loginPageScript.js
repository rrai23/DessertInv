const trustedUsers = [
    {username: "admin_01@cremedelecreme.com", password:"pascua2005"},
    {username: "admin_02@cremedelecreme.com", password:"cabahug2006"},
    {username: "admin_03@cremedelecreme.com", password:"lagunda2004"},
    {username: "admin_04@cremedelecreme.com", password:"jao2006"},
    {username: "admin_05@cremedelecreme.com", password:"leones2006"},
    {username: "admin_06@cremedelecreme.com", password:"api2006"}
];

const buttonHTML = document.getElementById('login');
const errorMessage = document.getElementById('error-message');

buttonHTML.onclick = (event) => {
    event.preventDefault();

    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;

    const checkUser = trustedUsers.find(user => user.username === usernameInput);

    if (checkUser && checkUser.password === passwordInput) {
        window.location.href = "mainPage.php";
    } else {
        errorMessage.textContent = "Invalid username or password. Please try again.";
        errorMessage.style.display = "block"; 
        document.getElementById('password').value = '';
    }
};