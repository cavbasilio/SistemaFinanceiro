<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API PLAYFIBRA</title>
            <!--Fonte Poppins-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />

            <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
            <!-- Only CSS -->
    <link rel="stylesheet" href="css/style.css"/>  

            <!--JS Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</head>
<body>

        <img src="img/playfibraImg.png" alt="logoplayfibra"/>
        <div id="txtFinanceiro">FINANCEIRO</div>
<div class="login">
        <div class="container-fluiid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4"></div>
                    <div class="card-body">
                    <form action="consultaCliente.php" method="POST" id="formLogin">
                                <div>
                                    <div class="mb-3">
                                        <label id="nomeUsuario
                                        ">Usuário</label>
                                        <input type="text" name="usuario" class="form-control">
                                    </div>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label>Senha</label>
                                    <input type="password" name="senha" class="form-control">
                                </div>
                            
                            <div>
                                <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary" id="btEntrar"><h6>Entrar</h6></button>
                            </div>
                        </form>
                      
        </div>
    </div>
</div>
</body>
</html>