// Esperar a que todo el contenido del HTML esté cargado
document.addEventListener('DOMContentLoaded', function() {

    // Seleccionar el formulario por su ID
    const form = document.getElementById('registroForm');

    // Escuchar el evento 'submit' del formulario
    form.addEventListener('submit', function(event) {
        
        // 1. Prevenir el comportamiento por defecto del formulario (evitar que la página se recargue)
        event.preventDefault();

        // 2. Obtener los valores de los campos del formulario
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const mensajeDiv = document.getElementById('mensaje');
       

        // 3. Crear un objeto con los datos a enviar
        const data = {
            "name": "name",
            "email": "email",
        };

        // 4. Usar la API Fetch para enviar los datos a nuestro endpoint en PHP
        fetch('api_registrar.php', {
            method: 'POST', // Método de la petición
            headers: {
                'Content-Type': 'application/json' // Indicamos que enviaremos JSON
            },
            body: JSON.stringify(data) // Convertimos el objeto JS a una cadena JSON
        })
        .then(response => response.json()) // Convertimos la respuesta de la API a un objeto JS
        .then(result => {
            // 5. Manejar la respuesta de la API
            if (result.status === 'success') {
                mensajeDiv.innerHTML = `<h3 class="ok">${result.message}</h3>`;
                form.reset(); // Limpiar el formulario
            } else {
                mensajeDiv.innerHTML = `<h3 class="bad">${result.message}</h3>`;
            }
        })
        .catch(error => {
            // 6. Manejar posibles errores en la comunicación
            console.error('Error:', error);
            mensajeDiv.innerHTML = `<h3 class="bad">Error de conexión con el servidor.</h3>`;
        });
    });
});