document.addEventListener("DOMContentLoaded", () => {




    const profileForm =
        document.getElementById("profileForm");

    if(profileForm)
    {
        profileForm.addEventListener(
            "submit",
            function(event)
            {
                let isValid = true;

                clearErrors(profileForm);

                const name =
                    document.getElementById("name")
                    .value.trim();

                const email =
                    document.getElementById("email")
                    .value.trim();

                const phone =
                    document.getElementById("phone")
                    .value.trim();


                if(name === "")
                {
                    showError(
                        "name",
                        "Name is required"
                    );

                    isValid = false;
                }


                const emailPattern =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if(!emailPattern.test(email))
                {
                    showError(
                        "email",
                        "Invalid email"
                    );

                    isValid = false;
                }


                if(!/^[0-9]+$/.test(phone))
                {
                    showError(
                        "phone",
                        "Phone must be numeric"
                    );

                    isValid = false;
                }

                if(phone.length < 11)
                {
                    showError(
                        "phone",
                        "Phone minimum 11 digits"
                    );

                    isValid = false;
                }

                if(!isValid)
                {
                    event.preventDefault();
                }
            }
        );
    }




    const passwordForm =
        document.getElementById("passwordForm");

    if(passwordForm)
    {
        passwordForm.addEventListener(
            "submit",
            function(event)
            {
                let isValid = true;

                clearErrors(passwordForm);

                const currentPassword =
                    document.getElementById(
                        "current_password"
                    ).value.trim();

                const newPassword =
                    document.getElementById(
                        "new_password"
                    ).value.trim();


                if(currentPassword === "")
                {
                    showError(
                        "current_password",
                        "Current password required"
                    );

                    isValid = false;
                }


                if(newPassword.length < 8)
                {
                    showError(
                        "new_password",
                        "Password minimum 8 characters"
                    );

                    isValid = false;
                }

                if(!isValid)
                {
                    event.preventDefault();
                }
            }
        );
    }

});




function showError(inputId, message)
{
    const input =
        document.getElementById(inputId);

    const errorElement =
        input.parentElement.querySelector(
            ".js-error"
        );

    errorElement.innerText = message;
}




function clearErrors(form)
{
    const errors =
        form.querySelectorAll(".js-error");

    errors.forEach(error =>
    {
        error.innerText = "";
    });
}