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
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';

    $query = "UPDATE clientes SET nome='$nome', endereco='$endereco', bairro='$bairro', cep='$cep', cidade='$cidade', estado='$estado' WHERE id=$id";

    if (mysqli_query($conexao, $query)) {
        echo 'Dados atualizados com sucesso!';
    } else {
        echo 'Erro ao atualizar os dados: ' . mysqli_error($conexao);
    }
}

$query = "SELECT * FROM clientes";
$resultado = mysqli_query($conexao, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de dados</title>
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
                                <h3>Consulte seus dados</h3>
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
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['endereco'] . "</td>";
                                        echo "<td>" . $row['bairro'] . "</td>";
                                        echo "<td>" . $row['cep'] . "</td>";
                                        echo "<td>" . $row['cidade'] . "</td>";
                                        echo "<td>" . $row['estado'] . "</td>";
                                        echo "<td>";
                                        echo "<form action='editar.php' method='POST' style='display: inline;'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<input type='hidden' name='nome' value='" . $row['nome'] . "'>";
                                        echo "<input type='hidden' name='endereco' value='" . $row['endereco'] . "'>";
                                        echo "<input type='hidden' name='bairro' value='" . $row['bairro'] . "'>";
                                        echo "<input type='hidden' name='cep' value='" . $row['cep'] . "'>";
                                        echo "<input type='hidden' name='cidade' value='" . $row['cidade'] . "'>";
                                        echo "<input type='hidden' name='estado' value='" . $row['estado'] . "'>";
                                        echo "<button type='submit' class='btn btn-outline-warning btn-sm me-1'>Editar</button>";
                                        echo "</form>";
                                        echo "<form action='excluir.php' method='POST' style='display: inline;'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<button type='submit' class='btn btn-outline-danger btn-sm'>Excluir</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
