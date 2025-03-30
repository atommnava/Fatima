document.addEventListener("DOMContentLoaded", () => {
    fetchBooks();
});

function fetchBooks() {
    fetch("http://localhost:3000/api/books")
        .then(response => response.json())
        .then(books => {
            displayBooks(books);
        })
        .catch(error => console.error("Error al obtener los libros:", error));
}

function displayBooks(books) {
        const catalog = document.getElementById("book-catalog");
        catalog.innerHTML = "";

        books.forEach(book => {
        const bookElement = document.createElement("div");
        bookElement.classList.add("book-card");

        bookElement.innerHTML = `
            <img src="${book.cover_image}" alt="${book.title}" class="book-cover">
            <h5>${book.title}</h5>
            <p><strong>Autor:</strong> ${book.author}</p>
            <p>Precio:${book.price}</p>
        `;

        catalog.appendChild(bookElement);
    });
}
