function displayCart() {
    // Leer el carrito de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Obtener el contenedor de la tabla en tu HTML
    const cartContainer = document.getElementById('cart-container');
    cartContainer.innerHTML = '';
    
    // Crear la tabla y sus encabezados
    const table = document.createElement('table');
    table.innerHTML = `
        <caption>Tu carrito de compras</caption>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Eliminar</th>
        </tr>
    `;
    
    // Añadir una fila por cada producto en el carrito ${item.quantity}
    cart.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.name}</td>
            <td>$${item.price.toFixed(2)}</td>
            <td><input type="number" class="cart-item-quantity" data-id="${item.id}" value="${item.quantity}" min="1"></td> 
            <td><p class="item-total">$${(item.price * item.quantity).toFixed(2)}</p></td>
            <td><button type="image" class="erase-button remove-item" data-id="${item.id}"></button></td>
        `;
        table.appendChild(row);
    });
    
    // Añadir la tabla al contenedor
    cartContainer.appendChild(table);


    // Añadir event listeners a los campos de entrada para actualizar la cantidad
    document.querySelectorAll('.cart-item-quantity').forEach(input => {
        input.addEventListener('change', (event) => {
            const id = event.target.dataset.id; // Asegúrate de que cada campo tenga un data-id correspondiente al id del producto
            const newQuantity = parseInt(event.target.value, 10);
            
            updateCartItemQuantity(id, newQuantity);
            
            // Aquí también podrías querer actualizar la visualización del total del carrito
            const itemRow = event.target.closest('tr');
            const itemTotalElement = itemRow.querySelector('.item-total');
            const itemPrice = parseFloat(itemRow.cells[1].textContent.replace('$', ''));
            itemTotalElement.textContent = `$${(itemPrice * newQuantity).toFixed(2)}`;
            
            // Actualizar la visualización del total del carrito
            updateCartTotal();        
        });
    });
    
    // Añadir event listeners a los botones de eliminar
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', (event) => {
            const id = event.target.dataset.id;
            removeCartItem(id);
        });
    });

    updateCartTotal();
}





function updateCartItemQuantity(id, newQuantity) {
    // Leer el carrito de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Encontrar el producto en el carrito
    const itemIndex = cart.findIndex(item => item.id === id);
    
    if (itemIndex !== -1) {
        // Actualizar la cantidad si el producto existe en el carrito
        cart[itemIndex].quantity = newQuantity;
        
        // Guardar el carrito actualizado en localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Actualizar la visualización del carrito aquí si es necesario
    }
}

function removeCartItem(id) {
    // Leer el carrito de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Filtrar el producto a eliminar
    const updatedCart = cart.filter(item => item.id !== id);
    
    // Guardar el carrito actualizado en localStorage
    localStorage.setItem('cart', JSON.stringify(updatedCart));
    
    // Actualizar la visualización del carrito
    displayCart();
}


function updateCartTotal() {
    // Leer el carrito de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Calcular el nuevo total del carrito
    let cartTotal = 0;
    cart.forEach(item => {
        cartTotal += item.price * item.quantity;
    });
    
    // Actualizar la visualización del total del carrito en tu HTML
    const cartTotalElement = document.getElementById('cart-total');
    if(cartTotalElement){
        cartTotalElement.textContent = `Total: $${cartTotal.toFixed(2)}`;
    }
    
    
}

// Llamar a displayCart cuando se cargue la página del carrito
document.addEventListener('DOMContentLoaded', displayCart);