<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje Recibido</title>
</head>
<body>
    <h1>te responderé a la brevedad posible</h1>
    <p>
        Nombre: {{$mensaje->name}} <br>
        Correo: {{$mensaje->email}} <br>
        Teléfono: {{$mensaje->telefono}} <br>
        Mensaje: {{$mensaje->mensaje}} <br>
    </p>

</body>
</html>
