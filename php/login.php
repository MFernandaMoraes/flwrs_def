<?php
// login.php - VERSÃO CORRIGIDA (sem redirecionamentos antes do formulário)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Configuração do banco
require_once 'config.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro no banco: " . $e->getMessage());
}

$erro = '';

// IMPORTANTE: SÓ redirecionar se for POST e login bem sucedido
// NÃO redirecionar se for GET (quando a página está carregando)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos";
    } else {
        try {
            $sql = "SELECT id, nome_completo, email, senha_hash, tipo, status FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario) {
                if (password_verify($senha, $usuario['senha_hash'])) {
                    if ($usuario['status'] !== 'ativo') {
                        $erro = "Conta inativa ou bloqueada";
                    } else {
                        // Login bem sucedido - só AGORA criamos a sessão
                        $_SESSION['usuario_id'] = $usuario['id'];
                        $_SESSION['usuario_nome'] = $usuario['nome_completo'];
                        $_SESSION['usuario_email'] = $usuario['email'];
                        $_SESSION['usuario_tipo'] = $usuario['tipo'] ?? 'usuario';
                        
                        // Redirecionar após login
                        if ($usuario['tipo'] === 'admin') {
                            header('Location: admin.php');
                        } else {
                            header('Location: home.php');
                        }
                        exit;
                    }
                } else {
                    $erro = "Senha incorreta";
                }
            } else {
                $erro = "E-mail não encontrado";
            }
        } catch(PDOException $e) {
            $erro = "Erro no banco: " . $e->getMessage();
        }
    }
}

// Se chegou aqui, mostra o formulário normalmente
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flwrs · login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-box">
        <div class="logo">
            flwrs <strong>·</strong>
            <small>Flowers that feel like felling</small>
        </div>
        
        <h2>Bem-vindo(a)</h2>
        <div class="sub">faça login para continuar</div>
        
        <?php if ($erro): ?>
            <div class="error">⚠️ <?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
       
        
        <form method="POST" action="">
            <div class="input-group">
                <label>E-MAIL</label>
                <input type="email" name="email" required autofocus>
            </div>
            
            <div class="input-group">
                <label>SENHA</label>
                <input type="password" name="senha" required>
            </div>
            
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <div class="links">
            <a href="cadastro.php">Criar conta</a>
            | 
            <a href="home.php">Voltar ao site</a>
        </div>
          
    </div>

<script src="../js/login.js"></script>
</body>
</html>