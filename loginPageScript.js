const trustedUsers = [
    {username: "admin_01@cremedelecreme.com", password:"pascua2005", name:"Joseph Pascua", role:"CEO", userLevel: "1"},
    {username: "admin_02@cremedelecreme.com", password:"cabahug2006", name:"Reyson Cabahug", role:"Inventory Manager", userLevel: "1"},
    {username: "admin_03@cremedelecreme.com", password:"lagunda2004", name:"Dave Lagunda", role:"Warehouse Manager", userLevel: "1"},
    {username: "admin_04@cremedelecreme.com", password:"jao2006", name:"Cliff Jao", role:"Frontend Developer", userLevel: "2"},
    {username: "admin_05@cremedelecreme.com", password:"leones2006", name:"Ethan Leones", role:"Secretary", userLevel: "1"},
    {username: "admin_06@cremedelecreme.com", password:"api2006", name:"Erika Api", role:"UI/UX Designer", userLevel: "2"}
];

const buttonHTML = document.getElementById('login');
const errorMessage = document.getElementById('error-message');
const forgotA = document.getElementById('forgot1');

buttonHTML.onclick = (event) => {
    event.preventDefault();

    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;

    const checkUser = trustedUsers.find(user => user.username === usernameInput);

    if (checkUser && checkUser.password === passwordInput) {
        sessionStorage.setItem('name', checkUser.name);
        sessionStorage.setItem('role', checkUser.role);
        
        window.location.href = `mainPage.php?userLevel=${checkUser.userLevel}`;
    } else {
        errorMessage.textContent = "Invalid username or password. Please try again.";
        errorMessage.style.display = "block"; 
        document.getElementById('password').value = '';
    }
};

forgotA.onclick = (event) => {
    event.preventDefault();
    window,location.href= "forgotPassword.php"
}