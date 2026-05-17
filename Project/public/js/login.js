const form = document.getElementById("loginForm");

form.addEventListener("submit", function(event)
{
    let isValid = true;

    const email =
        document.getElementById("email").value.trim();

    const password =
        document.getElementById("password").value.trim();

    clearErrors();


    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailPattern.test(email))
    {
        showError("email", "Invalid email");

        isValid = false;
    }


    if(password.length < 8)
    {
        showError(
            "password",
            "Password minimum 8 characters"
        );

        isValid = false;
    }


    if(!isValid)
    {
        event.preventDefault();
    }
});




function showError(inputId, message)
{
    const input = document.getElementById(inputId);

    const errorElement =
        input.parentElement.querySelector(".js-error");

    errorElement.innerText = message;
}




function clearErrors()
{
    const errors = document.querySelectorAll(".js-error");

    errors.forEach(error =>
    {
        error.innerText = "";
    });
}