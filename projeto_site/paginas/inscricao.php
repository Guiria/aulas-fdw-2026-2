<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../estilo.css">
</head>
<body>
    <h2>Cadastro de Funcionários</h2>
    <form method="POST" action="cadastro.php">
        <table border="0" cellpadding="8" class="tabela-form">
            <tr class="form-header">
                <td colspan="4">Ficha de Cadastro</td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td colspan="3"><input type="text" name="nome" size="40" maxlength="30"></td>
            </tr>
            <tr>
                <td>Endereço:</td>
                <td><input type="text" name="endereco" size="25" maxlength="50"></td>
                <td>Número:</td>
                <td><input type="text" name="numero" size="10" maxlength="20"></td>
            </tr>
            <tr>
                <td>Complemento:</td>
                <td><input type="text" name="complemento" size="25" maxlength="50"></td>
                <td>Bairro:</td>
                <td><input type="text" name="bairro" size="20" maxlength="30"></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input type="text" name="cidade" size="25" maxlength="50"></td>
                <td>CEP:</td>
                <td><input type="text" name="cep" size="10" maxlength="8"> <span class="dica">8 números</span></td>
            </tr>
            <tr>
                <td>UF:</td>
                <td>
                    <select name="uf">
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP" selected>SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>
                </td>
                <td>Email:</td>
                <td><input type="email" name="email" size="25" maxlength="50"></td>
            </tr>
            <tr>
                <td>Cargo:</td>
                <td>
                    <select name="cargo">
                        <option value="Selecione">Selecione</option>
                        <option value="Programador">Programador</option>
                        <option value="Diretor">Diretor</option>
                        <option value="Coordenador">Coordenador</option>
                        <option value="Analista">Analista</option>
                    </select>
                </td>
                <td>Departamento:</td>
                <td>
                    <select name="departamento">
                        <option value="Selecione Departamento">Selecione Departamento</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="TI">TI</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Usuário:</td>
                <td><input type="text" name="usuario" size="12" maxlength="8"></td>
                <td>Senha:</td>
                <td><input type="password" name="senha" size="12" maxlength="8"></td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <input type="submit" value="Cadastrar">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
