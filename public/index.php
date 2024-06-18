<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DE PRODUCTOS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="main.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">FORMULARIO DE PRODUCTOS</h1>
        <form id="productForm" class="bg-white p-4 rounded shadow-md mb-4" method="POST" action="">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full border-gray-300 rounded" required>
                <p id="errorNombre" class="text-red-500 text-sm"></p>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-gray-700">Precio por Unidad:</label>
                <input type="number" id="precio" name="precio" class="mt-1 block w-full border-gray-300 rounded" step="0.01" required>
                <p id="errorPrecio" class="text-red-500 text-sm"></p>
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700">Cantidad en Inventario:</label>
                <input type="number" id="cantidad" name="cantidad" class="mt-1 block w-full border-gray-300 rounded" required>
                <p id="errorCantidad" class="text-red-500 text-sm"></p>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Producto</button>
        </form>

        <?php
        session_start();
        if (!isset($_SESSION['productos'])) {
            $_SESSION['productos'] = [];
        }

        function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
            $productos[] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
                'valor_total' => $precio * $cantidad,
                'estado' => $cantidad > 0 ? 'En Stock' : 'Agotado'
            ];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $precio = floatval($_POST['precio']);
            $cantidad = intval($_POST['cantidad']);
            agregarProducto($_SESSION['productos'], $nombre, $precio, $cantidad);
        }

        function mostrarProductos($productos) {
            echo '<table class="min-w-full bg-white">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="py-2">Nombre del Producto</th>';
            echo '<th class="py-2">Precio por Unidad</th>';
            echo '<th class="py-2">Cantidad en Inventario</th>';
            echo '<th class="py-2">Valor Total</th>';
            echo '<th class="py-2">Estado</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($productos as $producto) {
                echo '<tr>';
                echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['nombre']) . '</td>';
                echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['precio']) . '</td>';
                echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['cantidad']) . '</td>';
                echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['valor_total']) . '</td>';
                echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['estado']) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }

        mostrarProductos($_SESSION['productos']);
        ?>
    </div>
    <script src="main.js"></script>
</body>
</html>
