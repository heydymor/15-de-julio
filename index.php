<!DOCTYPE html>
<html>
<head>
    <title>Registrar usuario</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <form id="registroForm">
        <img src="logo final.png" width="100">
        <h1>cocopan</h1>
        <input type="text" id="name" name="name" placeholder="Nombre completo" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="submit" name="register" value="Registrarse">

        <div id="mensaje" style="margin-top: 15px;"></div>
    </form>
    
    <script src="app.js"></script>

</body>
</html>