



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


            const formData =
                new FormData();

            formData.append(
                "fine_id",
                fineId
            );


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