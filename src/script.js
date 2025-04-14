document.addEventListener("DOMContentLoaded", () => {
    fetchBooks();
});

async function fetchBooks() {
    try {
        const response = await fetch("https://antares.dci.uia.mx/ict23amn/Fatima/src/get_books.php");
        if (!response.ok) {
            throw new Error(`Error HTTPS: ${response.status}`);
        }
        const books = await response.json(); // Leer la respuesta solo una vez
        console.log("Datos recibidos:", books); 
        displayBooks(books);

        // Validar
    } catch (error) {
        console.error("Error al cargar libros:", error);
        document.getElementById("book-catalog").innerHTML = `
            <p class="error">No se pudieron cargar los libros. Recarga la página.</p>`;
    }
}

function displayBooks(books) {
    console.log("Datos recibidos:", books);
    
    const catalog = document.getElementById("book-catalog");
    if (!books || books.length === 0) {
        catalog.innerHTML = "<p class='error'>No se encontraron libros.</p>";
        return;
    }

    catalog.innerHTML = books.map(book => {
        return `
        <div class="book-card">
            <a href="detalle_libro.php?id=${book.id}">
                <img src="${book.cover_image}" alt="${book.title}" class="book-cover">
            </a>
            <h5>${book.title}</h5>
            <p>${book.author}</p>
            <h4 class="book-price">$${Number(book.price).toFixed(2)}</h4>
        </div>`;
    }).join('');
}