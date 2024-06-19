document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();
});

class CartItem {
    constructor(id, name, price, quantity) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.quantity = quantity || 1; // Si no se proporciona cantidad, por defecto es 1
    }
}


async function fetchProducts() {
    try {
        const response = await fetch('http://localhost/proyecto1/api.php');
        const products = await response.json();
        displayProducts(products);
        // Process products
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}

function displayProducts(products) {
    const productsContainer = document.getElementById('products-container');
    productsContainer.innerHTML = '';

    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('column');
        productDiv.innerHTML = `
            <img src="${product.imagenProducto}" alt="${product.nombreProducto}">
            <div class="product-info">
                <h2>${product.nombreProducto}</h2>
                <h1>$${product.precioProducto}</h1>
                <button class="button addToCart" data-id="${product.idProducto}" data-nombre="${product.nombreProducto}" data-precio="${product.precioProducto}">Agregar al carrito</button>
            </div>
        `;
        productsContainer.appendChild(productDiv);
    });

    document.querySelectorAll('.addToCart').forEach(button => {
        button.addEventListener('click', (event) => {
            const id = event.target.getAttribute('data-id');
            const nombre = event.target.getAttribute('data-nombre');
            const precio = parseFloat(event.target.getAttribute('data-precio'));
            addToCart(id, nombre, precio);
        });
    });
}

function addToCart(id, name, price) {
    // Obtener el carrito actual de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Buscar si el producto ya está en el carrito
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        // Si ya está, incrementar la cantidad
        existingItem.quantity++;
    } else {
        // Si no está, crear un nuevo CartItem y añadirlo al carrito
        const newItem = new CartItem(id, name, price);
        cart.push(newItem);
    }
    
    // Guardar el carrito actualizado en localStorage
    alert('Producto agregado!');
    localStorage.setItem('cart', JSON.stringify(cart));
}