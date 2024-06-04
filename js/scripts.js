document.addEventListener("DOMContentLoaded", function() {
    const formularioRegistro = document.getElementById('registroClienteForm');

    if (formularioRegistro) {
        formularioRegistro.addEventListener('submit', function(event) {
            event.preventDefault();

            // Validar formulario antes de enviar
            if (validarFormulario()) {
                registrarCliente();
            } else {
                alert('Por favor, complete todos los campos correctamente.');
            }
        });
    }

    function registrarCliente() {
        const nombreCompleto = document.getElementById('nombreCompleto').value;
        const tipoDocumento = document.getElementById('tipoDocumento').value;
        const numeroDocumento = document.getElementById('numeroDocumento').value;
        const telefono = document.getElementById('telefono').value;
        const email = document.getElementById('email').value;

        fetch('../../controllers/ClienteController.php?action=registrar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombreCompleto,
                tipoDocumento,
                numeroDocumento,
                telefono,
                email
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redireccionar a listado de clientes o mostrar mensaje de éxito
                window.location.href = 'listado.php';
            } else {
                alert('Error al registrar el cliente.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al conectar con el servidor.');
        });
    }

    function validarFormulario() {
        const nombreCompleto = document.getElementById('nombreCompleto').value;
        const tipoDocumento = document.getElementById('tipoDocumento').value;
        const numeroDocumento = document.getElementById('numeroDocumento').value;
        const telefono = document.getElementById('telefono').value;
        const email = document.getElementById('email').value;

        if (!nombreCompleto || !tipoDocumento || !numeroDocumento || !telefono || !email) {
            return false;
        }

        return true;
    }
});
