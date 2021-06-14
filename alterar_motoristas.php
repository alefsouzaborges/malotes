<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
//include_once('navbar.php');

$idMotorista = $_GET['id'];

    $sql = "SELECT * FROM motoristas WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':id', $idMotorista);
    $sql->execute();

    $dados = $sql->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scalable=1">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/template.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#numero").mask("000000000000000")
            $("#unidade").mask("000")
            $("#cpf").mask("000.000.000-00")
            $("#cnpj").mask("00.000.000/0000-00")
            $("#telefone01").mask("00000-0000")
            $("#telefone02").mask("0000-0000")
            $("#salario").mask("999.999.990,00", {reverse: true})
            $("#cep").mask("00.000-000")
            $("#dataNascimento").mask("00/00/0000")

            $("#rg").mask("999.999.999-W", {
                translation: {
                    'W': {
                        pattern: /[X0-9]/
                    }
                },
                reverse: true
            })

            var options = {
                translation: {
                    'A': {pattern: /[A-Z]/},
                    'a': {pattern: /[a-zA-Z]/},
                    'S': {pattern: /[a-zA-Z0-9]/},
                    'L': {pattern: /[a-z]/},
                }
            }

            $("#placa").mask("AAA-0000", options)

            $("#codigo").mask("AA.LLL.0000", options)

            $("#celular").mask("(00) 0000-00009")

            $("#celular").blur(function (event) {
                if ($(this).val().length == 15) {
                    $("#celular").mask("(00) 00000-0009")
                } else {
                    $("#celular").mask("(00) 0000-00009")
                }
            })
        })
    </script>
</head>
<body class="bg-body-image">
<div class="container-fluid">
    <div class="row justify_row justify-content-center">
        <div class="box-form-cad-usuarios">
            <div class="row justify-content-center text-cadastrar">
                ALTERAR MOTORISTAS
            </div>
            <form style="border: 1px solid #ccc;padding: 20px;" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Nome</label>
                        <input type="text" class="form-control" id="inputEmail4" placeholder="Nome" name="nome"
                               required="" autocomplete="off" value="<?php echo $dados['nome'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputTelefone">Telefone</label>
                        <input type="text" class="form-control" id="celular" placeholder="Telefone" name="telefone"
                               required="" value="<?php echo $dados['telefone'] ?>">
                    </div>
                    <a type="hidden" href="classes/alterar-motoristas.php?id=<?php echo $dados['id']; ?>"></a>
                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    <a href="listar_motoristas.php" class="btn btn-primary btn-block">Voltar</a>
                    <span style="color: red; font-weight: 600;"><?php include_once('classes/alterar-motoristas.php'); ?></span>
            </form>
        </div>
    </div>
</div>
</body>
</body>
</html>
