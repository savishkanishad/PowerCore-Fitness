// 🌍 Change this to your actual deployed Vercel URL
const BASE_URL = "https://yourproject.vercel.app/api";

// ✅ Test API call
async function testAPI() {
  try {
    const res = await fetch(`${BASE_URL}/hello`);
    const data = await res.json();
    console.log("API Test:", data.message);
  } catch (err) {
    console.error("Error testing API:", err);
  }
}

// ✅ Get users
async function getUsers() {
  try {
    const res = await fetch(`${BASE_URL}/users`);
    const users = await res.json();
    console.log("Users:", users);
    // Example: render users in HTML
    // document.querySelector("#users").innerText = JSON.stringify(users, null, 2);
  } catch (err) {
    console.error("Error fetching users:", err);
  }
}

// ✅ Register user
async function registerUser(user) {
  try {
    const res = await fetch(`${BASE_URL}/register`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(user)
    });
    const data = await res.json();
    console.log("Register response:", data);
    alert(data.message || "User registered!");
  } catch (err) {
    console.error("Error registering user:", err);
  }
}

// ✅ Contact form
async function submitContact(contact) {
  try {
    const res = await fetch(`${BASE_URL}/contact`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(contact)
    });
    const data = await res.json();
    console.log("Contact response:", data);
    alert(data.message || "Message sent!");
  } catch (err) {
    console.error("Error submitting contact:", err);
  }
}

// Example usage
document.addEventListener("DOMContentLoaded", () => {
  testAPI(); // Run API test on page load

  // Example: handle registration form
  const regForm = document.getElementById("registerForm");
  if (regForm) {
    regForm.addEventListener("submit", e => {
      e.preventDefault();
      const user = {
        name: regForm.name.value,
        email: regForm.email.value,
        password: regForm.password.value,
        phone: regForm.phone.value,
        program: regForm.program.value
      };
      registerUser(user);
    });
  }

  // Example: handle contact form
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", e => {
      e.preventDefault();
      const contact = {
        name: contactForm.name.value,
        email: contactForm.email.value,
        message: contactForm.message.value
      };
      submitContact(contact);
    });
  }
});
