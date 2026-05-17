// =========================
// MARK FINE AS PAID
// =========================

const payButtons =
    document.querySelectorAll(
        ".pay-btn"
    );


payButtons.forEach(button => {

    button.addEventListener(
        "click",

        async function()
        {
            const fineId =
                this.dataset.id;


            // FORM DATA

            const formData =
                new FormData();

            formData.append(
                "fine_id",
                fineId
            );


            // API CALL

            const response =
                await fetch(

                    "/project/Web-Technologies-project-final/Project/api/fines/pay",

                    {
                        method: "POST",

                        body: formData
                    }
                );


            const data =
                await response.json();


            // REMOVE ROW

            if(data.success)
            {
                const row =
                    document.querySelector(
                        `#fine-row-${fineId}`
                    );

                row.remove();
            }
        }
    );

});