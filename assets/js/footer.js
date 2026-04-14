//Newsletter
const form = document.getElementById("newsletterForm");
const emailInput = document.getElementById("emailInput");
const successMsg = document.getElementById("successMsg");
const btn = document.querySelector(".btn-subscribe");
const ALLOWED_DOMAINS = [
  "gmail.com",
  "yahoo.com",
  "outlook.com",
  "hotmail.com"
];

function isValidEmail(email) {
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(email)) return false;
  const domain = email.split("@")[1]?.toLowerCase();
  return ALLOWED_DOMAINS.includes(domain);
}
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = emailInput.value.trim();
  if (!isValidEmail(email)) {
    emailInput.classList.add("is-invalid");
    btn.classList.remove("valid");
    return;
  }
  // Success
  emailInput.classList.remove("is-invalid");
  emailInput.classList.add("is-valid");
  const originalText = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
  btn.disabled = true;
  await new Promise((r) => setTimeout(r, 1500));
  form.style.display = "none";
  successMsg.style.display = "block";
  setTimeout(() => {
    form.reset();
    form.style.display = "block";
    successMsg.style.display = "none";
    emailInput.classList.remove("is-valid");
    btn.classList.remove("valid");
    btn.innerHTML = originalText;
    btn.disabled = false;
    emailInput.focus();
  }, 4000);
});
emailInput.addEventListener("input", () => {
  const email = emailInput.value.trim();
  emailInput.classList.remove("is-invalid", "is-valid");
  if (email && isValidEmail(email)) {
    emailInput.classList.add("is-valid");
    btn.classList.add("valid");
    btn.disabled = false;
  } else {
    btn.classList.remove("valid");
    btn.disabled = true;
  }
});
emailInput.addEventListener("focus", () => {
  emailInput.classList.remove("is-invalid", "is-valid");
  btn.classList.remove("valid");
});
