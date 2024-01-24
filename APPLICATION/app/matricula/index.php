<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Matricula</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body class="bg_matricula">
    <div class="container">

        <div class="abs-center ">
            <form method="post" action="../matricula/login/autentication.php" id="formLogin" class="p-5 rounded-4 bg-info shadow ">
                <h2 class="pb-4">GESTION DE MATRICULA</h2>
                <div>
                    <div class="mb-3">
                        <label for="textdni" class="form-label">DNI:</label>
                        <input type="text" class="form-control" name="textdni" id="textdni" placeholder="Ingresa tu DNI">
                    </div>
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" aria-describedby="passwordHelpBlock">
                </div>
                <div class="col-auto text-center">
                    <button type="submit" class="btn btn-dark mt-3">Acceder</button>
                </div>
            </form>

        </div>
    </div>



    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>

    <style>
        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</body>

</html>