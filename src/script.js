/*
 * @author Atom Alexander M. Nava
 * @brief Manejamos la lógica del cleinte para desplear el catálogo de libros.
 * Se ejecuta cuando el DOM está completamente cargado.
 */

//Espera a que el DOM esté completamente cargado antes de ejecutarse el código.
document.addEventListener("DOMContentLoaded", () => {
    fetchBooks();
})

/*
 * @brief Función ASYNC para obtener la lista de libros desde el servidor.
 * @async
 * @throws Error Si hay un problema con la solicitud HTTP o la respuesta
 */
async function fetchBooks()
{
    try {
        // Realizar la solicitud GET al endpoint PHP que devuelve los libros.
        // Creación del archivo «get_books.php» para obtener los libros.
        const respuesta = await fetch("https://antares.dci.uia.mx/ict23amn/Fatima/src/get_books.php");

        // Validación
        if (!respuesta.ok) {
            throw new Error('Error HTTPS: ${respuesta.status}');
        }
        // Convertir la respuesta a JSON
        const books = await respuesta.json();
        console.log("Datos recibidos:)", books);

        // Depslegar los libros
        displayBooks(books);
    } catch(error) {
        // Error Handling: mensajes en consola e interfaz
        console.error("Error al cargar libros: ", error);
        document.getElementById("book-catalog").innerHTML = `
        <p class="error"> No se pudieron cargar los libros correctamente.</p>`;
    }
}

/*
 * @brief Desplegamos los libros en el catálogo de la página.
 * @param {Arreglo} books - Lista de los libros a mostrar.
 */
function displayBooks(books) {
    console.log("Datos recibidos:", books);
    
    const catalogo = document.getElementById("book-catalog");
    
    // Verifica si hay libros para mostrar
    if (!books || books.length === 0) {
        catalogo.innerHTML = "<p class='error'>No se encontraron libros.</p>";
        return;
    }

    // Genera el HTML para cada libro y lo une en un solo string
    catalogo.innerHTML = books.map(book => {
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