console.log("Register Page Loaded");

const form = document.getElementById("registerForm");

form.addEventListener("submit", function(event)
{
    let isValid = true;

    // Input Values
    const name = document.getElementById("name").value.trim();

    const email = document.getElementById("email").value.trim();

    const phone = document.getElementById("phone").value.trim();

    const password = document.getElementById("password").value.trim();

    // Clear Previous Errors
    clearErrors();

    // =========================
    // NAME VALIDATION
    // =========================

    if(name === "")
    {
        showError("name", "Name is required");

        isValid = false;
    }

    // =========================
    // EMAIL VALIDATION
    // =========================

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailPattern.test(email))
    {
        showError("email", "Invalid email");

        isValid = false;
    }

    // =========================
    // PHONE VALIDATION
    // =========================

   if(!/^[0-9]+$/.test(phone))
{
    showError("phone", "Phone must be numeric");

    isValid = false;
}

    // =========================
    // PASSWORD VALIDATION
    // =========================

    if(password.length < 8)
    {
        showError(
            "password",
            "Password minimum 8 characters"
        );

        isValid = false;
    }
    if(phone.length < 11)
{
    showError(
        "phone",
        "Phone must be at least 11 digits"
    );

    isValid = false;
}

    // =========================
    // STOP FORM SUBMIT
    // =========================

    if(!isValid)
    {
        event.preventDefault();
    }
});


// =========================
// SHOW ERROR
// =========================

function showError(inputId, message)
{
    const input = document.getElementById(inputId);

    const errorElement =
        input.parentElement.querySelector(".js-error");

    errorElement.innerText = message;
}


// =========================
// CLEAR ERRORS
// =========================

function clearErrors()
{
    const errors = document.querySelectorAll(".js-error");

    errors.forEach(error =>
    {
        error.innerText = "";
    });
}