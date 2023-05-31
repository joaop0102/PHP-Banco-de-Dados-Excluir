<?php
$host = 'localhost:3306';
$user = 'root';
$senha = '';
$banco = 'clientes';

$conexao = mysqli_connect($host, $user, $senha, $banco);

if (!$conexao) {
    die('Falha ao conectar ao banco de dados: ' . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];


    $query = "SELECT * FROM clientes WHERE id = $id";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        $nome = $row['nome'];
        $endereco = $row['endereco'];
        $bairro = $row['bairro'];
        $cep = $row['cep'];
        $cidade = $row['cidade'];
        $estado = $row['estado'];
    } else {
        echo 'Erro ao buscar o registro: ' . mysqli_error($conexao);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM clientes WHERE id = $id";

    if (mysqli_query($conexao, $query)) {
        echo 'Registro excluído com sucesso!';
    } else {
        echo 'Erro ao excluir o registro: ' . mysqli_error($conexao);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de exclusão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="logo_consultar">
                            <img class="img-fluid" src="consult1.png" alt="">
                        </div>
                        <div class="text-center">
                            <div class="textinho">
                                <h3>Confirmação de exclusão</h3>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-secondary table-striped-columns">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Bairro</th>
                                        <th scope="col">CEP</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $nome; ?></td>
                                        <td><?php echo $endereco; ?></td>
                                        <td><?php echo $bairro; ?></td>
                                        <td><?php echo $cep; ?></td>
                                        <td><?php echo $cidade; ?></td>
                                        <td><?php echo $estado; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p>Você tem certeza que deseja excluir esse registro?</p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" name="confirmar" class="btn btn-outline-danger">Confirmar Exclusão</button>
                            </form>
                            <a href="consulta.php" class="btn btn-outline-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
