const trustedUsers = [
    {username: "admin_01@cremedelecreme.com", password:"pascua2005"},
    {username: "admin_02@cremedelecreme.com", password:"cabahug2006"},
    {username: "admin_03@cremedelecreme.com", password:"lagunda2004"},
    {username: "admin_04@cremedelecreme.com", password:"jao2006"},
    {username: "admin_05@cremedelecreme.com", password:"leones2006"},
    {username: "admin_06@cremedelecreme.com", password:"api2006"}
]

let buttonHTML = document.getElementById('login');

buttonHTML.onclick = () => {
    event.preventDefault();
    let usernameInput = document.getElementById('username').value;
    let passwordInput = document.getElementById('password').value;
    let checkUser = trustedUsers.find(user => user.username === usernameInput);

    if (checkUser && checkUser.password === passwordInput){
        alert("Valid!");
    }
    else {
        alert("Invalid");
    }
}