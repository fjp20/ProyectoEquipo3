<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validación de CURP y RFC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Validaciones</h2>

    <h3>Validar CURP</h3>
    <form action="/validar-curp" method="GET">
        <input type="text" name="curp" placeholder="Ingresa CURP" required>
        <button type="submit">Validar CURP</button>
    </form>

    <hr>

    <h3>Validar RFC</h3>
    <form action="/validar-rfc" method="GET">
        <input type="text" name="rfc" placeholder="Ingresa RFC" required>
        <button type="submit">Validar RFC</button>
    </form>
</div>

</body>
</html>
