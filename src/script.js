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
            <h3>${book.title}</h3>
            <p><strong>Autor:</strong> ${book.author}</p>
            <p><strong>Género:</strong> ${book.genre}</p>
            <p><strong>Precio:</strong> $${book.price}</p>
            <button class="buy-button">Comprar</button>
        `;

        catalog.appendChild(bookElement);
    });
}
