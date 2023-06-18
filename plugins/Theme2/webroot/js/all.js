let sidebar = document.querySelector(".sidebar");

let sidebarToggler = document.querySelector(".menu-toggler");
let overlay = document.querySelector(".mobile-overlay");

// contactIcon.addEventListener("click", () => {
//   sendDropdown.classList.toggle("show");
//   scoreDropdown.classList.remove("show");
// });
sidebarToggler.addEventListener("click", () => {
  sidebar.classList.toggle("active");
  overlay.classList.toggle("active");
});

overlay.addEventListener("click", () => {
  sidebar.classList.remove("active");
  overlay.classList.remove("active");
});

// sidebar.addEventListener = () => {
console.log("dasd");
// };
