document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('productForm');

    form.addEventListener('submit', function (event) {
        let isValid = true;

        const nombre = document.getElementById('nombre').value.trim();
        const precio = document.getElementById('precio').value.trim();
        const cantidad = document.getElementById('cantidad').value.trim();

        const errorNombre = document.getElementById('errorNombre');
        const errorPrecio = document.getElementById('errorPrecio');
        const errorCantidad = document.getElementById('errorCantidad');

        errorNombre.textContent = '';
        errorPrecio.textContent = '';
        errorCantidad.textContent = '';

        if (nombre === '') {
            isValid = false;
            errorNombre.textContent = 'El nombre del producto es obligatorio.';
        }

        if (precio === '' || isNaN(precio) || parseFloat(precio) <= 0) {
            isValid = false;
            errorPrecio.textContent = 'El precio debe ser un número mayor que cero.';
        }

        if (cantidad === '' || isNaN(cantidad) || parseInt(cantidad) < 0) {
            isValid = false;
            errorCantidad.textContent = 'La cantidad debe ser un número entero no negativo.';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
