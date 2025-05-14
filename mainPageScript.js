const profile = document.getElementById('profile');
const manageButton = document.getElementById('man');

let profName = sessionStorage.getItem('name');
let profRole = sessionStorage.getItem('role');
const urlParams = new URLSearchParams(window.location.search);
const userLevel = urlParams.get('userLevel');

if (profName && profRole){
    profile.innerHTML = `<b>${profName}</b><br><span>${profRole}</span>`;
}

manageButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (userLevel === "1"){
        console.log("Authorized: redirecting to index.php");
        window.location.href = "index.php";
    }
    else {
        alert("You are unauthorized to control the database");
    }
})

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1 
});

document.querySelectorAll('.fade-in-section').forEach(section => {
    observer.observe(section);
});