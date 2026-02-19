document.addEventListener('DOMContentLoaded', () => {
    
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".main-nav");

    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    document.querySelectorAll(".main-nav a").forEach(n => n.addEventListener("click", () => {
        hamburger.classList.remove("active");
        navMenu.classList.remove("active");
    }));
});