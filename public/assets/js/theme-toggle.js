// Theme Toggle for ClassHub

document.addEventListener("DOMContentLoaded", function() {
    const themeToggle = document.getElementById("theme-toggle");
    const body = document.body;

    // Check saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        body.setAttribute("data-theme", savedTheme);
    }

    // Toggle theme on button click
    if (themeToggle) {
        themeToggle.addEventListener("click", function() {
            const currentTheme = body.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";

            body.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);

            // Update icon
            const icon = this.querySelector("i");
            if (newTheme === "dark") {
                icon.classList.remove("bx-sun");
                icon.classList.add("bx-moon");
            } else {
                icon.classList.remove("bx-moon");
                icon.classList.add("bx-sun");
            }
        });
    }

    // Also handle the original light-dark-mode button if it exists
    const originalToggle = document.querySelector(".light-dark-mode");
    if (originalToggle) {
        originalToggle.addEventListener("click", function() {
            const currentTheme = body.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";

            body.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);

            // Update icon
            const icon = this.querySelector("i");
            if (newTheme === "dark") {
                icon.classList.remove("bx-sun");
                icon.classList.add("bx-moon");
            } else {
                icon.classList.remove("bx-moon");
                icon.classList.add("bx-sun");
            }
        });
    }
});
