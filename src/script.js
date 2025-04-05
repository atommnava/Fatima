document.addEventListener("DOMContentLoaded", () => {
    fetchBooks();
});

async function fetchBooks() {
    try {
        const response = await fetch("./get_books.php")  // Ruta relativa
        
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const books = await response.json();
        displayBooks(books);
    } catch (error) {
        console.error("Error al cargar libros:", error);
        document.getElementById("book-catalog").innerHTML = `
            <p class="error">No se pudieron cargar los libros. Recarga la página.</p>
        `;
    }
}

function displayBooks(books) {
    const catalog = document.getElementById("book-catalog");
    
    if (!books || books.length === 0) {
        catalog.innerHTML = "<p class='error'>No se encontraron libros.</p>";
        return;
    }

    catalog.innerHTML = books.map(book => `
        <div class="book-card">
            <img src="${book.cover_image}" alt="${book.title}" class="book-cover">
            <h5>${book.title}</h5>
            <p>${book.author}</p>
            <h4 class="book-price">$${book.price.toFixed(2)}</h4>
        </div>
    `).join('');
}