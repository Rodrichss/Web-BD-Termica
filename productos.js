// Event Listener para agregar al carrito
document.querySelectorAll('.addToCart').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nombre = this.getAttribute('data-nombre');
        const precio = parseFloat(this.getAttribute('data-precio'));
        const cantidad = 1; // Cantidad por defecto

        const producto = { id, nombre, precio, cantidad };

        // Obtener carrito del LocalStorage o inicializar vacío
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Verificar si el producto ya está en el carrito
        const productoExistente = carrito.find(item => item.id === id);
        if (productoExistente) {
            productoExistente.cantidad += 1;
        } else {
            carrito.push(producto);
        }

        // Guardar carrito en LocalStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));

        // Opcional: Mostrar mensaje de éxito o actualizar interfaz
        alert('Producto agregado al carrito');

        // Redirigir o actualizar interfaz según necesites
    });
});