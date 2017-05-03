<?php session_start(); session_destroy(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loguin Stock 0.1</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="dist/css/sb-admin-2.css" rel="stylesheet">
   <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Stock 0.1</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form"  method="POST" action="l/validar.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuarios" name="nn" type="text" id="nn" autocomplete="off" onkeypress="DeHasta('nn','np')" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Clave" name="np" type="password" id="np" value="" autocomplete="off" onkeypress="DeHasta('np','VA')" >
                                </div>
                               <p></p>
                                <button class="btn btn-lg btn-success btn-block" type="submit" id="VA"  >Entrar</button>
                                <p> </p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery.js"></script>
    <script>
        function DeHasta(enter,campo){
            var D= document.getElementById(enter);
            $(D).keydown(function(e){
                if (e.keyCode==13){
                    e.preventDefault();
                    document.getElementById(campo).focus();
                    return false;
                }
            });
        }
    </script>
</body>

</html>
