// password
document.addEventListener("DOMContentLoaded", function () {
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  if (togglePassword && password) {
    togglePassword.addEventListener("click", function (e) {
      // Toggle the type attribute
      const type =
        password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      // Toggle the icon
      this.classList.toggle("fa-eye-slash");
    });
  }
});

// opsi pertanyaan
document.addEventListener("DOMContentLoaded", function () {
  const tambahOpsiButton = document.querySelector(".tambah .opsi");
  if (tambahOpsiButton) {
    tambahOpsiButton.addEventListener("click", function () {
      const opsiContainer = document.getElementById("opsiContainer");
      const newOpsi = document.createElement("input");
      newOpsi.type = "text";
      newOpsi.className = "form-control mb-2";
      newOpsi.placeholder = "Tulis Opsi Jawaban...";
      newOpsi.name = "opsi[]"; // Gunakan array untuk nama opsi agar bisa menangani multiple input

      // Tambahkan input baru ke dalam container
      opsiContainer.appendChild(newOpsi);
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var navbar = document.querySelector(".navbar");

  if (navbar) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        // Jika halaman di-scroll lebih dari 50px
        navbar.classList.add("navbar-scrolled");
      } else {
        navbar.classList.remove("navbar-scrolled");
      }
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll("div[id]");
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

  window.addEventListener("scroll", function () {
    let current = "";
    const scrollPosition = window.scrollY;
    const maxScroll =
      document.documentElement.scrollHeight - window.innerHeight;

    // Memeriksa setiap bagian (div dengan id) untuk menentukan yang sedang dilihat
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 60; // Menyesuaikan dengan offset navbar
      if (scrollPosition >= sectionTop) {
        current = section.getAttribute("id");
      }
    });

    // Menghapus kelas beranda-link dari semua link navigasi
    navLinks.forEach((link) => {
      link.classList.remove("beranda-link");
    });

    const berandaTop = document.querySelector("#beranda").offsetTop - 60; // Menyesuaikan dengan offset navbar
    if (scrollPosition < berandaTop && scrollPosition >= 0) {
      document
        .querySelector('a[href="#beranda"]')
        .classList.add("beranda-link");
    }

    // Menambahkan kelas beranda-link ke link "Kontak" jika scroll telah mencapai posisi maksimal
    if (scrollPosition === maxScroll) {
      document.querySelector('a[href="#kontak"]').classList.add("beranda-link");
    }

    // Menambahkan kelas beranda-link ke link yang sedang aktif
    navLinks.forEach((link) => {
      const href = link.getAttribute("href").substring(1); // Menghilangkan tanda "#" dari href
      if (current === href) {
        link.classList.add("beranda-link");
      }
    });
    
    // Menghapus kelas beranda-link dari link "Kategori" jika scroll telah mencapai posisi maksimal
    if (scrollPosition === maxScroll) {
      document.querySelector('a[href="#kategori"]').classList.remove("beranda-link");
    }
  });
});
