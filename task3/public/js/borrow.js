document.addEventListener("DOMContentLoaded", () => {

    console.log("Borrow Module Loaded");




    const searchInput =
        document.getElementById(
            "searchInput"
        );


    if(searchInput)
    {
        searchInput.addEventListener(
            "keyup",

            async function()
            {
                const query =
                    this.value;


                const response =
                    await fetch(
                        `/project/Web-Technologies-project-final/Project/api/active-loans-search?q=${query}`
                    );


                const loans =
                    await response.json();


                const tbody =
                    document.querySelector(
                        "#loan-table-body"
                    );


                tbody.innerHTML = "";


                if(loans.length === 0)
                {
                    tbody.innerHTML = `

                        <tr>

                            <td colspan="7">

                                No active loans found.

                            </td>

                        </tr>
                    `;

                    return;
                }


                loans.forEach(loan => {

                    tbody.innerHTML += `

                        <tr>

                            <td>${loan.id}</td>

                            <td>${loan.member_name}</td>

                            <td>${loan.book_title}</td>

                            <td>${loan.borrow_date}</td>

                            <td>${loan.due_date}</td>

                            <td>

                                <span class="status active">

                                    ${loan.status}

                                </span>

                            </td>

                            <td>

                                <form method="POST"
                                      action="/project/Web-Technologies-project-final/Project/return-book">

                                    <input type="hidden"
                                           name="borrow_id"
                                           value="${loan.id}">

                                    <button type="submit"
                                            class="return-btn">

                                        Process Return

                                    </button>

                                </form>

                            </td>

                        </tr>
                    `;
                });
            }
        );
    }




    document.querySelectorAll(".approve-btn")
        .forEach(button => {

            button.addEventListener(
                "click",

                async function()
                {
                    const id =
                        this.dataset.id;

                    const response =
                        await fetch(
                            "/project/Web-Technologies-project-final/Project/approve-request",
                            {
                                method: "POST",

                                headers: {
                                    "Content-Type":
                                        "application/x-www-form-urlencoded"
                                },

                                body: `id=${id}`
                            }
                        );

                    const data =
                        await response.json();

                    if(data.success)
                    {
                        document
                            .getElementById(
                                `request-row-${id}`
                            )
                            .remove();
                    }
                    else
                    {
                        alert("Approve failed");
                    }
                }
            );
        });




    document.querySelectorAll(".reject-btn")
        .forEach(button => {

            button.addEventListener(
                "click",

                async function()
                {
                    const id =
                        this.dataset.id;

                    const response =
                        await fetch(
                            "/project/Web-Technologies-project-final/Project/reject-request",
                            {
                                method: "POST",

                                headers: {
                                    "Content-Type":
                                        "application/x-www-form-urlencoded"
                                },

                                body: `id=${id}`
                            }
                        );

                    const data =
                        await response.json();

                    if(data.success)
                    {
                        document
                            .getElementById(
                                `request-row-${id}`
                            )
                            .remove();
                    }
                    else
                    {
                        alert("Reject failed");
                    }
                }
            );
        });

});