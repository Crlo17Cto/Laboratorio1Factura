<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Factura</title>
    <link rel="stylesheet" href="/facturacion_tienda/css/formulario.css">
     <!--letra titulo header-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Danfo&family=Jaro:opsz@6..72&family=Jersey+25+Charted&family=
    Permanent+Marker&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <!--letra opciones header-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Danfo&family=Jaro:opsz@6..72&family=Jersey+25+Charted&family=
    Oleo+Script:wght@400;700&family=Permanent+Marker&family=Rubik+Mono+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once 'views/partials/header.php'; ?>

    <div class="container">
        <h2>Generar Factura</h2>
        <form id="facturaForm" method="post" action="/facturacion_tienda/index.php?controller=factura&action=generarFactura">
            <div>
                <label for="idCliente">Seleccionar Cliente:</label>
                <select name="idCliente" id="idCliente" required>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombreCompleto']; ?></option>
                    <?php endforeach; ?>
                    <option value="nuevo">Registrar nuevo cliente</option>
                </select>
            </div>

            <div class="productos-container">
                <h3 class="titulo-productos">Productos</h3>
                <div class="producto" id="producto1">
                    <div>
                        <label for="producto1">Producto:</label>
                        <select name="producto[]" required>
                            <?php foreach ($productos as $producto) : ?>
                                <option value="<?php echo $producto['id']; ?>">
                                    <?php echo $producto['nombre'] . " - $" . number_format($producto['precio'], 0, ',', '.'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="cantidad1">Cantidad:</label>
                        <input type="number" name="cantidad[]" min="1" value="1" required>
                    </div>
                </div>
            </div>

            <button type="button" id="agregarProducto">Agregar Producto</button>
            <div class="productos-agregados" id="productosAgregados"></div>
            <div class="total" id="totalFactura">
                Total a Pagar: $<span id="total">0</span>
            </div>
            <button type="submit">Generar Factura</button>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const agregarProductoBtn = document.getElementById('agregarProducto');
            const productosContainer = document.querySelector('.productos-container');
            const productosAgregados = document.getElementById('productosAgregados');
            let productoIndex = 1;

            agregarProductoBtn.addEventListener('click', function() {
                const productoSelect = document.querySelector('select[name="producto[]"]');
                const cantidadInput = document.querySelector('input[name="cantidad[]"]');

                const productoId = productoSelect.value;
                const productoTexto = productoSelect.options[productoSelect.selectedIndex].text;
                const cantidad = cantidadInput.value;

                const productoHtml = `
                    <div class="producto-agregado" id="productoAgregado${productoIndex}">
                        Producto: ${productoTexto}, Cantidad: ${cantidad}
                    </div>
                `;

                productosAgregados.insertAdjacentHTML('beforeend', productoHtml);

                // Agregar el producto al formulario (para ser enviado)
                const hiddenProductoInput = document.createElement('input');
                hiddenProductoInput.type = 'hidden';
                hiddenProductoInput.name = `productos_agregados[${productoIndex}][id]`;
                hiddenProductoInput.value = productoId;

                const hiddenCantidadInput = document.createElement('input');
                hiddenCantidadInput.type = 'hidden';
                hiddenCantidadInput.name = `productos_agregados[${productoIndex}][cantidad]`;
                hiddenCantidadInput.value = cantidad;

                productosContainer.appendChild(hiddenProductoInput);
                productosContainer.appendChild(hiddenCantidadInput);

                productoIndex++;

                // Calcular y mostrar el total
                calcularTotal();

                // Resetear los campos de selección
                productoSelect.selectedIndex = 0;
                cantidadInput.value = 1;
            });

            // Función para calcular y mostrar el total
            function calcularTotal() {
                let total = 0;
                const productosAgregados = document.querySelectorAll('.producto-agregado');
                productosAgregados.forEach(productoAgregado => {
                    const productoTexto = productoAgregado.textContent;
                    const cantidadTexto = productoTexto.match(/Cantidad: (\d+)/);
                    const cantidad = cantidadTexto ? parseInt(cantidadTexto[1], 10) : 0;
                    const precioTexto = productoTexto.match(/\$([\d.]+)/);
                    const precio = precioTexto ? parseFloat(precioTexto[1].replace(/\./g, '')) : 0;
                    total += precio * cantidad;
                });

                // Actualizar el valor en el DOM
                document.getElementById('total').textContent = total.toLocaleString('es-CO');
            }

            // Redirigir al formulario de registro de cliente si se selecciona "Registrar nuevo cliente"
            document.getElementById('idCliente').addEventListener('change', function() {
                if (this.value === 'nuevo') {
                    window.location.href = '/facturacion_tienda/index.php?controller=cliente&action=mostrarFormularioRegistro';
                }
            });
        });
    </script>
    <?php require_once 'views/partials/footer.php'; ?>
</body>

</html>