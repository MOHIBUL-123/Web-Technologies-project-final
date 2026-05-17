document.addEventListener("DOMContentLoaded", () => {

    console.log("Book Module Loaded");

});
document.addEventListener("DOMContentLoaded", () => {

    console.log("Book Module Loaded");




    const form =
        document.querySelector("form");

    if(form)
    {
        form.addEventListener(
            "submit",
            function(event)
            {
                let isValid = true;

                clearErrors();




                const genre =
                    document.querySelector(
                        '[name="genre_id"]'
                    );

                const title =
                    document.querySelector(
                        '[name="title"]'
                    );

                const author =
                    document.querySelector(
                        '[name="author"]'
                    );

                const isbn =
                    document.querySelector(
                        '[name="isbn"]'
                    );

                const copies =
                    document.querySelector(
                        '[name="total_copies"]'
                    );

                const shelf =
                    document.querySelector(
                        '[name="shelf_location"]'
                    );

                const year =
                    document.querySelector(
                        '[name="published_year"]'
                    );




                if(genre.value.trim() === "")
                {
                    showError(
                        genre,
                        "Genre required"
                    );

                    isValid = false;
                }




                if(title.value.trim().length < 2)
                {
                    showError(
                        title,
                        "Title too short"
                    );

                    isValid = false;
                }




                if(author.value.trim().length < 2)
                {
                    showError(
                        author,
                        "Author name too short"
                    );

                    isValid = false;
                }




                const isbnPattern =
                    /^[0-9\-]{10,20}$/;

                if(
                    !isbnPattern.test(
                        isbn.value.trim()
                    )
                )
                {
                    showError(
                        isbn,
                        "Invalid ISBN"
                    );

                    isValid = false;
                }




                if(
                    copies.value <= 0
                )
                {
                    showError(
                        copies,
                        "Copies must be greater than 0"
                    );

                    isValid = false;
                }




                if(
                    shelf.value.trim().length < 2
                )
                {
                    showError(
                        shelf,
                        "Shelf location too short"
                    );

                    isValid = false;
                }




                const currentYear =
                    new Date().getFullYear();

                if(
                    year.value.length !== 4 ||
                    year.value > currentYear
                )
                {
                    showError(
                        year,
                        "Invalid published year"
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




    function showError(input, message)
    {
        input.classList.add("input-error");

        const error =
            document.createElement("p");

        error.className =
            "js-error";

        error.innerText =
            message;

        input.parentElement.appendChild(error);
    }




    function clearErrors()
    {
        document
            .querySelectorAll(".js-error")
            .forEach(error => error.remove());

        document
            .querySelectorAll(".input-error")
            .forEach(input => {
                input.classList.remove("input-error");
            });
    }
        const deleteForms =
        document.querySelectorAll(".delete-form");

    deleteForms.forEach(form => {

        form.addEventListener(
            "submit",
            function(event)
            {
                const confirmed =
                    confirm(
                        "Are you sure you want to delete this book?"
                    );

                if(!confirmed)
                {
                    event.preventDefault();
                }
            }
        );

    });




if(typeof BOOK_ID !== "undefined")
{
    setInterval(() => {

        fetch(
            `/project/Web-Technologies-project-final/Project/api/books/availability?id=${BOOK_ID}`
        )
        .then(response => response.json())

        .then(data => {

            if(data.success)
            {


                const countElement =
                    document.querySelector(
                        "#availability-count"
                    );

                countElement.innerText =
                    data.available_copies;


                const badge =
                    document.querySelector(
                        "#availability-badge"
                    );


                if(data.available)
                {
                    badge.innerText =
                        "Available";

                    badge.className =
                        "availability-badge available";
                }
                else
                {
                    badge.innerText =
                        "Unavailable";

                    badge.className =
                        "availability-badge unavailable";
                }
            }

        });

    }, 3000);
}





const searchInput =
    document.querySelector("#search-input");


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
                    `/project/Web-Technologies-project-final/Project/api/books/search?q=${query}`
                );

            const books =
                await response.json();

            const tbody =
                document.querySelector(
                    "#book-table-body"
                );

            tbody.innerHTML = "";


            books.forEach(book => {

    let actions = "";



if(currentUserRole && currentUserRole === "member")
{
    if(book.available_copies > 0)
    {
        actions = `

            <form
                method="POST"
                action="/project/Web-Technologies-project-final/Project/borrow"
            >

                <input
                    type="hidden"
                    name="book_id"
                    value="${book.id}"
                >

                <button
                    type="submit"
                    class="borrow-btn"
                >
                    Borrow
                </button>

            </form>
        `;
    }
    else
    {
        actions = `

            <span class="out-stock">
                Unavailable
            </span>
        `;
    }
}


else if(
    currentUserRole &&
    (currentUserRole === "librarian" || currentUserRole === "admin")
)
{
    actions = `

        <a
            class="edit-btn"
            href="/project/Web-Technologies-project-final/Project/books/edit?id=${book.id}"
        >
            Edit
        </a>

        <form
            method="POST"
            action="/project/Web-Technologies-project-final/Project/books/delete"
            class="delete-form"
        >

            <input
                type="hidden"
                name="id"
                value="${book.id}"
            >

            <button
                type="submit"
                class="delete-btn"
            >
                Delete
            </button>

        </form>
    `;
}


else
{
    actions = `

        <a
            href="/project/Web-Technologies-project-final/Project/login"
            class="login-btn"
        >
            Login to Borrow
        </a>

    `;
}


    tbody.innerHTML += `

        <tr>

            <td>${book.id}</td>

            <td>${book.title}</td>

            <td>${book.author}</td>

            <td>${book.genre_name}</td>

            <td>${book.isbn}</td>

            <td>${book.total_copies}</td>

            <td>${book.available_copies}</td>

            <td>${book.shelf_location}</td>

            <td>${book.published_year}</td>

            <td>

                ${actions}

            </td>

        </tr>
    `;
});

        }
    );
}

});