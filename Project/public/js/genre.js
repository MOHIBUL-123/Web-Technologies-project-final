document.addEventListener("DOMContentLoaded", () => {

    console.log("Genre Module Loaded");




    const deleteForms =
        document.querySelectorAll(".delete-form");


    deleteForms.forEach(form => {

        form.addEventListener(
            "submit",
            function(event)
            {
                const confirmed =
                    confirm(
                        "Are you sure you want to delete this genre?"
                    );

                if(!confirmed)
                {
                    event.preventDefault();
                }
            }
        );

    });

});