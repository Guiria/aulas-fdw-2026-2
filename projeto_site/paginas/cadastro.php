<?php
// Dados de conexao com o banco
$host     = getenv("DB_HOST") ?: "localhost";
$username = "root";
$password = "";
$db_name  = "empresa";

function pagina($titulo, $mensagem, $voltar = true) {
    echo "<html><head><meta charset='UTF-8'><title>Meu Site</title>";
    echo "<link rel='stylesheet' type='text/css' href='../estilo.css'></head><body>";
    echo "<h2>" . htmlspecialchars($titulo) . "</h2><p>" . $mensagem . "</p>";
    if ($voltar) {
        echo "<a href='javascript:history.back()'>Voltar</a>";
    }
    echo "</body></html>";
    exit;
}

function processa_formulario() {
    // Campos obrigatorios
    $obrigatorios = array(
        "nome" => "Nome", "endereco" => "Endereco", "numero" => "Numero",
        "bairro" => "Bairro", "cidade" => "Cidade", "cep" => "CEP", "uf" => "UF",
        "email" => "Email", "cargo" => "Cargo", "departamento" => "Departamento",
        "usuario" => "Usuario", "senha" => "Senha"
    );
    foreach ($obrigatorios as $campo => $rotulo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) == "") {
            pagina("Erro no cadastro", $rotulo . " incorreto");
        }
    }

    // Campos de texto sem caracteres especiais
    $textos = array("nome" => "Nome", "endereco" => "Endereco", "complemento" => "Complemento",
                    "bairro" => "Bairro", "cidade" => "Cidade");
    foreach ($textos as $campo => $rotulo) {
        $valor = isset($_POST[$campo]) ? trim($_POST[$campo]) : "";
        if ($valor != "" && !preg_match("/^[\p{L}0-9 .,\-ºª]+$/u", $valor)) {
            pagina("Erro no cadastro", $rotulo . " invalido");
        }
    }

    // Processamento anti-SQL Injection
    $proibidas = array("drop", "update", "insert", "delete", "select", "union", "--", ";");
    foreach ($_POST as $valor) {
        foreach ($proibidas as $palavra) {
            if (stripos($valor, $palavra) !== false) {
                pagina("Erro no cadastro", "Conteudo invalido informado");
            }
        }
    }

    if (!preg_match("/^[0-9]{8}$/", $_POST["cep"])) {
        pagina("Erro no cadastro", "CEP invalido (informe 8 numeros)");
    }
    $ufs = array("AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB",
                 "PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO");
    if (!in_array($_POST["uf"], $ufs, true)) {
        pagina("Erro no cadastro", "UF invalida");
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        pagina("Erro no cadastro", "Email invalido");
    }
    if (strlen($_POST["usuario"]) > 8 || strlen($_POST["senha"]) > 8) {
        pagina("Erro no cadastro", "Usuario e senha aceitam no maximo 8 caracteres");
    }
    if ($_POST["cargo"] == "Selecione" || $_POST["departamento"] == "Selecione Departamento") {
        pagina("Erro no cadastro", "Selecione o cargo e o departamento");
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    pagina("Cadastro", "Acesse o formulario de cadastro para enviar os dados.", false);
}

processa_formulario();

// Captura os dados digitados no formulario
$nome         = trim($_POST["nome"]);
$endereco     = trim($_POST["endereco"]);
$numero       = trim($_POST["numero"]);
$complemento  = isset($_POST["complemento"]) ? trim($_POST["complemento"]) : "";
$bairro       = trim($_POST["bairro"]);
$cidade       = trim($_POST["cidade"]);
$cep          = $_POST["cep"];
$uf           = $_POST["uf"];
$email        = trim($_POST["email"]);
$cargo        = $_POST["cargo"];
$departamento = $_POST["departamento"];
$usuario      = $_POST["usuario"];
$senha        = $_POST["senha"];

// O id nao e preenchido pois e acrescentado automaticamente
$sql = "INSERT INTO `funcionarios`
        (`nome`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `uf`, `email`, `cargo`, `departamento`, `usuario`, `senha`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

mysqli_report(MYSQLI_REPORT_OFF);
$con = mysqli_connect($host, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    pagina("Erro de conexao", "Falhou ao conectar ao MySQL: " . htmlspecialchars(mysqli_connect_error()), false);
}
mysqli_set_charset($con, "utf8mb4");

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "sssssssssssss", $nome, $endereco, $numero, $complemento, $bairro,
                       $cidade, $cep, $uf, $email, $cargo, $departamento, $usuario, $senha);
$result = mysqli_stmt_execute($stmt);

if (!$result) {
    $erro = htmlspecialchars(mysqli_stmt_error($stmt));
    mysqli_close($con);
    pagina("Erro na inclusao", $erro);
}
mysqli_stmt_close($stmt);
mysqli_close($con);
pagina("Cadastro realizado", "Registro incluido com sucesso", false);
