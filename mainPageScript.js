const profile = document.getElementById('profile');
const manageButton = document.getElementById('man');

let profName = sessionStorage.getItem('name');
let profRole = sessionStorage.getItem('role');

if (profName && profRole){
    profile.innerHTML = `<b>${profName}</b><br><span>${profRole}</span>`;
}

manageButton.addEventListener('click', (event) => {
    event.preventDefault();
    window.location.href = "index.php";
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