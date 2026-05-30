const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
}

// Close navbar when link is clicked
const navLink = document.querySelectorAll(".nav-link");

navLink.forEach((n) => n.addEventListener("click", closeMenu));

function closeMenu() {
  hamburger.classList.remove("active");
  navMenu.classList.remove("active");
}

// Event Listeners: Handling toggle event
const toggleSwitch = document.querySelector(
  '.theme-switch input[type="checkbox"]'
);

// Store color theme for future visits
function switchTheme(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute("data-theme", "dark");
    localStorage.setItem("theme", "dark");
  } else {
    document.documentElement.setAttribute("data-theme", "light");
    localStorage.setItem("theme", "light");
  }
}

if (toggleSwitch) {
  toggleSwitch.addEventListener("change", switchTheme, false);
}

// Save user preference on load
const currentTheme = localStorage.getItem("theme")
  ? localStorage.getItem("theme")
  : null;

if (currentTheme) {
  document.documentElement.setAttribute("data-theme", currentTheme);

  if (currentTheme === "dark" && toggleSwitch) {
    toggleSwitch.checked = true;
  }
}

// Adding date
let myDate = document.querySelector("#datee");
const yes = new Date().getFullYear();
if (myDate) {
  myDate.innerHTML = yes;
}

// Dynamic/Interactive Starfield Background
const canvas = document.createElement("canvas");
canvas.id = "starfield";
document.body.prepend(canvas);
const ctx = canvas.getContext("2d");

let stars = [];
const starCount = 100;
let mouse = { x: null, y: null };

function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  initStars();
}

class Star {
  constructor() {
    this.reset();
  }

  reset() {
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;
    this.size = Math.random() * 2 + 0.5;
    this.speedX = (Math.random() - 0.5) * 0.2;
    this.speedY = (Math.random() - 0.5) * 0.2;
    this.alpha = Math.random();
    this.fade = Math.random() * 0.02 + 0.005;
  }

  update() {
    this.x += this.speedX;
    this.y += this.speedY;

    // Boundary check
    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
      this.reset();
    }

    // Interactivity: gentle pull towards mouse
    if (mouse.x !== null && mouse.y !== null) {
      const dx = mouse.x - this.x;
      const dy = mouse.y - this.y;
      const dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < 150) {
        this.x += dx * 0.005;
        this.y += dy * 0.005;
      }
    }

    // Twinkle effect
    this.alpha += this.fade;
    if (this.alpha > 1 || this.alpha < 0.1) {
      this.fade = -this.fade;
    }
  }

  draw() {
    const isDark = document.documentElement.getAttribute("data-theme") === "dark";
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fillStyle = isDark
      ? `rgba(255, 255, 255, ${this.alpha})`
      : `rgba(139, 44, 114, ${this.alpha})`; // deep purple/magenta stars for light mode
    ctx.fill();
  }
}

function initStars() {
  stars = [];
  for (let i = 0; i < starCount; i++) {
    stars.push(new Star());
  }
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  stars.forEach((star) => {
    star.update();
    star.draw();
  });
  requestAnimationFrame(animate);
}

window.addEventListener("resize", resizeCanvas);
window.addEventListener("mousemove", (e) => {
  mouse.x = e.clientX;
  mouse.y = e.clientY;
});
window.addEventListener("mouseleave", () => {
  mouse.x = null;
  mouse.y = null;
});

// Burst of stars on click
window.addEventListener("click", (e) => {
  // Only spawn if not clicking a link or button
  if (e.target.tagName !== "A" && e.target.tagName !== "BUTTON" && !e.target.closest("a") && !e.target.closest("button") && !e.target.closest(".theme-switch")) {
    for (let i = 0; i < 15; i++) {
      const star = new Star();
      star.x = e.clientX;
      star.y = e.clientY;
      star.speedX = (Math.random() - 0.5) * 2;
      star.speedY = (Math.random() - 0.5) * 2;
      stars.push(star);
      if (stars.length > 200) stars.shift(); // keep star count bounded
    }
  }
});

// Trigger initial setup
resizeCanvas();
animate();
