//--- Start Header ---
let bars = document.querySelector(".bars");
let toggleMenu = document.querySelector(".toggle-menu");


bars.addEventListener("click", () => {
    toggleMenu.classList.toggle("active");
    bars.classList.toggle("active");
});
//--- End Header ---

// Loading
const load = document.querySelector(".loading");
window.onload = function() {
    setTimeout(() => {
        load.style.display = "block";
        document.body.style.overflow = "hidden";
    });
};
setTimeout(() => {
    load.style.display = "none";
    document.body.style.overflow = "visible";
}, 500);

// Scroll Top
scrollBtn = document.querySelector('.scroll-btn');
window.addEventListener("scroll", function() {
    if (window.scrollY > 300) {
        scrollBtn.classList.add('active');
    } else {
        scrollBtn.classList.remove('active');
    }
});
scrollBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    })
});