<?php
require_once '../includes/functions.php';

/* ====== FILTROS E PAGINAÇÃO ====== */
$busca  = trim($_GET['q'] ?? '');
$modelo = $_GET['modelo'] ?? '';
$ordem  = $_GET['ordem'] ?? 'recentes';
$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$porPagina = 9;
$offset = ($pagina - 1) * $porPagina;

$filtros = [
    'busca'  => $busca,
    'modelo' => $modelo,
    'ordem'  => $ordem,
    'limite' => $porPagina,
    'offset' => $offset,
];

$produtos = getProdutosFiltrados($filtros);
$total    = contarProdutos(['busca' => $busca, 'modelo' => $modelo]);
$paginas  = max(1, (int)ceil($total / $porPagina));
$flash    = getFlash();

/* ====== MONTA QUERY STRING PARA PAGINAÇÃO ====== */
function urlPagina($p) {
    $params = $_GET;
    $params['pagina'] = $p;
    return '?' . http_build_query($params);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flwrs · nossas flores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0,1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/carrinho.css">
    <style>
    /* ===== RESET & BASE ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: sans-serif;
        background: #fcf8f5;
        color: #3d3835;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2.5rem;
    }

    /* ===== HEADER (idêntico à home) ===== */
    header {
        padding: 1.8rem 0 1.2rem;
        border-bottom: 1px solid rgba(180, 165, 160, 0.12);
        position: sticky;
        top: 0;
        background: rgba(252, 248, 245, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        z-index: 100;
    }

    .header-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* ===== BACK BUTTON (igual ao CSS da FAQ) ===== */
    .back-button {
        color: #5a5552;
        text-decoration: none;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        transition: color 0.3s ease;
    }

    .back-button:hover {
        color: #e94e77;
    }

    .back-button .material-symbols-outlined {
        font-size: 1.8rem;
    }

    .logo-area {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .logo-word {
        font-size: 2.2rem;
        font-weight: 200;
        letter-spacing: 0.04em;
        color: #3d3835;
    }

    .logo-word strong {
        font-weight: 500;
        color: #e94e77;
    }

    .tagline-header {
        font-size: 0.65rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #a8958f;
        padding-left: 1rem;
        border-left: 1px solid #e8d5d0;
        font-weight: 300;
    }

    /* ===== NAVIGATION (idêntico à home) ===== */
    .nav-menu {
        display: flex;
        gap: 2.2rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .nav-menu a {
        text-decoration: none;
        color: #5a5552;
        font-size: 0.75rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-menu a::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 1.5px;
        background: #e94e77;
        transition: width 0.3s ease;
    }

    .nav-menu a:hover {
        color: #e94e77;
    }

    .nav-menu a:hover::after {
        width: 100%;
    }

    .cart-link {
        position: relative;
        display: flex;
        align-items: center;
    }

    .cart-link::after { display: none; }

    .cart-icon-wrapper {
        display: flex;
        align-items: center;
        position: relative;
        padding: 0.3rem 0.5rem;
        border-radius: 30px;
        transition: background 0.3s ease;
    }

    .cart-icon-wrapper:hover {
        background: rgba(184, 122, 142, 0.06);
    }

    .cart-icon-wrapper i {
        font-size: 1.2rem;
        color: #4a4542;
        transition: color 0.3s ease;
    }

    .cart-icon-wrapper:hover i {
        color: #e94e77;
    }

    .cart-count-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #e94e77;
        color: white;
        font-size: 0.6rem;
        font-weight: 600;
        border-radius: 50%;
        min-width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', monospace;
        letter-spacing: 0;
        box-shadow: 0 2px 8px rgba(184, 122, 142, 0.25);
    }

    /* ===== PAGE HERO ===== */
    .page-hero {
        text-align: center;
        padding: 4rem 1rem 2.5rem;
    }

    .page-hero h1 {
        font-size: 2.8rem;
        font-weight: 300;
        line-height: 1.15;
        letter-spacing: -0.03em;
        color: #2d2825;
        margin-bottom: 0.8rem;
    }

    .page-hero h1 span {
        color: #f1a7c1;
        font-weight: 400;
        position: relative;
    }

    .page-hero h1 span::before {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 0;
        width: 100%;
        height: 6px;
        background: #f7d6e7;
        z-index: -1;
    }

    .page-hero p {
        color: #6d6560;
        font-weight: 300;
        font-size: 1.05rem;
        letter-spacing: 0.02em;
        margin: 0;
    }

    /* ===== FILTROS BAR ===== */
    .filtros-bar {
        background: white;
        border-radius: 28px;
        padding: 1.5rem 1.8rem;
        border: 1px solid rgba(180, 165, 160, 0.06);
        box-shadow: 0 15px 40px -20px rgba(0, 0, 0, 0.06);
        margin-bottom: 2rem;
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 1rem;
        align-items: center;
        transition: box-shadow 0.4s ease;
    }

    .filtros-bar:focus-within {
        box-shadow: 0 20px 50px -20px rgba(184, 122, 142, 0.15);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 0.85rem 1.2rem 0.85rem 2.8rem;
        border: 1.5px solid #f5ece9;
        border-radius: 50px;
        outline: none;
        font-size: 0.9rem;
        font-family: inherit;
        background: #fcf8f5;
        color: #3d3835;
        transition: all 0.3s ease;
    }

    .search-box input::placeholder {
        color: #a8958f;
        font-weight: 300;
        letter-spacing: 0.03em;
    }

    .search-box input:focus {
        border-color: #f1a7c1;
        background: white;
        box-shadow: 0 0 0 4px rgba(241, 167, 193, 0.08);
    }

    .search-box .material-symbols-outlined {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a8958f;
        font-size: 1.2rem;
        pointer-events: none;
    }

    .filtros-bar select {
        padding: 0.85rem 2.5rem 0.85rem 1.4rem;
        border: 1.5px solid #f5ece9;
        border-radius: 50px;
        background: #fcf8f5;
        color: #3d3835;
        font-family: inherit;
        font-size: 0.85rem;
        letter-spacing: 0.02em;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23a8958f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat: no-repeat;
        background-position: right 1.2rem center;
    }

    .filtros-bar select:focus {
        border-color: #f1a7c1;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(241, 167, 193, 0.08);
    }

    .filtros-bar button {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.85rem 1.8rem;
        background: transparent;
        color: #91b691;
        border: 1.5px solid #b2e4b3;
        border-radius: 50px;
        font-weight: 500;
        font-family: inherit;
        font-size: 0.75rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .filtros-bar button:hover {
        background: #cae459;
        border-color: #cae459;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(184, 122, 142, 0.2);
    }

    /* ===== CHIPS DE MODELO ===== */
    .chips {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
        justify-content: center;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        padding: 0.55rem 1.3rem;
        background: white;
        border: 1.5px solid #f5ece9;
        border-radius: 50px;
        color: #5a5552;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 400;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .chip:hover {
        border-color: #f1a7c1;
        color: #e94e77;
        transform: translateY(-2px);
    }

    .chip.ativo {
        background: linear-gradient(135deg, #e94e77, #f1a7c1);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 20px -6px rgba(233, 78, 119, 0.35);
    }

    .chip.ativo:hover {
        color: white;
        transform: translateY(-2px);
    }

    /* ===== INFO RESULTADOS ===== */
    .produtos-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.8rem;
        color: #a8958f;
        font-size: 0.8rem;
        letter-spacing: 0.04em;
        padding: 0 0.2rem;
    }

    .produtos-info strong {
        color: #e94e77;
        font-weight: 500;
    }

    .produtos-info a {
        color: #91b691 !important;
        text-decoration: none;
        font-size: 0.75rem !important;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        border-bottom: 1px solid transparent;
        transition: all 0.3s ease;
    }

    .produtos-info a:hover {
        border-bottom-color: #91b691;
    }

    /* ===== GRID DE PRODUTOS ===== */
    .produtos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* ===== CARD DE PRODUTO ===== */
    .produto-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(180, 165, 160, 0.06);
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
    }

    .produto-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f5ece9, #e94e77, #f5ece9);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }

    .produto-card:hover {
        transform: translateY(-8px);
        border-color: rgba(184, 122, 142, 0.12);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.06);
    }

    .produto-card:hover::before {
        opacity: 1;
    }

    .produto-imagem {
        width: 100%;
        aspect-ratio: 1 / 1;
        background: linear-gradient(150deg, #fde8f3 30%, #fefaf5 70%, #c8e8d8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        overflow: hidden;
        position: relative;
    }

    .produto-imagem img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .produto-card:hover .produto-imagem img {
        transform: scale(1.06);
    }

    .produto-badge {
        position: absolute;
        top: 0.9rem;
        left: 0.9rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #e94e77;
        padding: 0.35rem 0.9rem;
        border-radius: 50px;
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .produto-info {
        padding: 1.6rem 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }

    .produto-nome {
        font-size: 1.15rem;
        font-weight: 500;
        margin: 0;
        color: #2d2825;
        letter-spacing: -0.01em;
        line-height: 1.3;
    }

    .produto-descricao {
        color: #6d6560;
        font-size: 0.85rem;
        line-height: 1.6;
        font-weight: 300;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .produto-preco {
        font-size: 1.4rem;
        font-weight: 500;
        color: #e94e77;
        margin-top: auto;
        letter-spacing: -0.02em;
        padding-top: 0.4rem;
    }

    .produto-actions {
        padding: 0 1.5rem 1.5rem;
    }

    .btn-add {
        width: 100%;
        padding: 0.85rem 1rem;
        background: transparent;
        color: #e94e77;
        border: 1.5px solid #f1a7c1;
        border-radius: 50px;
        font-weight: 500;
        cursor: pointer;
        font-family: inherit;
        font-size: 0.7rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #e94e77, #f1a7c1);
        border-color: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(233, 78, 119, 0.25);
    }

    .btn-add:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .btn-add .material-symbols-outlined {
        font-size: 1.05rem;
    }

    /* ===== PAGINAÇÃO ===== */
    .paginacao {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin: 3rem 0 2rem;
        flex-wrap: wrap;
    }

    .paginacao a,
    .paginacao span {
        min-width: 42px;
        height: 42px;
        padding: 0 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        background: white;
        color: #5a5552;
        text-decoration: none;
        border: 1.5px solid #f5ece9;
        font-size: 0.8rem;
        font-weight: 400;
        letter-spacing: 0.04em;
        transition: all 0.3s ease;
    }

    .paginacao a:hover {
        border-color: #f1a7c1;
        color: #e94e77;
        transform: translateY(-2px);
    }

    .paginacao .atual {
        background: linear-gradient(135deg, #e94e77, #f1a7c1);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 20px -6px rgba(233, 78, 119, 0.35);
    }

    .paginacao .disabled {
        opacity: 0.35;
        pointer-events: none;
    }

    /* ===== ESTADO VAZIO ===== */
    .vazio {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 28px;
        border: 1px solid rgba(180, 165, 160, 0.06);
        box-shadow: 0 15px 40px -20px rgba(0, 0, 0, 0.06);
    }

    .vazio .icon {
        font-size: 4rem;
        display: block;
        margin-bottom: 1rem;
    }

    .vazio h3 {
        font-size: 1.4rem;
        font-weight: 300;
        margin: 0 0 0.6rem;
        color: #2d2825;
        letter-spacing: -0.02em;
    }

    .vazio p {
        color: #6d6560;
        margin: 0 0 2rem;
        font-weight: 300;
    }

    .vazio .chip {
        display: inline-flex;
    }

    /* ===== NOTIFICAÇÃO ===== */
    .notificacao {
        position: fixed;
        top: 100px;
        right: 24px;
        padding: 1rem 1.6rem;
        border-radius: 16px;
        color: white;
        font-weight: 500;
        font-size: 0.85rem;
        letter-spacing: 0.03em;
        z-index: 2000;
        box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        max-width: 400px;
        backdrop-filter: blur(8px);
    }

    .notificacao.sucesso {
        background: linear-gradient(135deg, #91b691, #6da06d);
    }

    .notificacao.erro {
        background: linear-gradient(135deg, #e94e77, #c73e63);
    }

    @keyframes slideIn {
        from { transform: translateX(120%); opacity: 0; }
        to   { transform: translateX(0);    opacity: 1; }
    }

    /* ===== FOOTER (idêntico à home) ===== */
    footer {
        text-align: center;
        padding: 3rem 2rem;
        border-top: 1px solid rgba(180, 165, 160, 0.08);
        margin-top: 3rem;
    }

    footer p {
        font-size: 0.75rem;
        color: #a8958f;
        letter-spacing: 0.04em;
        font-weight: 300;
    }

    footer span {
        color: #91b691;
        font-weight: 400;
        font-style: italic;
    }

    /* ===== RESPONSIVO ===== */
    @media (max-width: 1024px) {
        .page-hero h1 { font-size: 2.4rem; }
        .produtos-grid {
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 1.5rem;
        }
    }

    @media (max-width: 900px) {
        .filtros-bar {
            grid-template-columns: 1fr 1fr;
        }
        .filtros-bar .search-box {
            grid-column: 1 / -1;
        }
        .filtros-bar button {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .container { padding: 0 1.5rem; }

        .header-flex {
            flex-direction: column;
            text-align: center;
        }

        .header-left { justify-content: center; }
        .logo-area { justify-content: center; }

        .tagline-header {
            border-left: none;
            padding-left: 0;
        }

        .nav-menu {
            justify-content: center;
            gap: 1.5rem;
        }

        .page-hero { padding: 3rem 1rem 2rem; }
        .page-hero h1 { font-size: 2rem; }
        .page-hero p { font-size: 0.95rem; }

        .filtros-bar {
            grid-template-columns: 1fr;
            padding: 1.2rem;
        }

        .produtos-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }

        .produto-info { padding: 1.1rem 1rem 0.8rem; }
        .produto-nome { font-size: 1rem; }
        .produto-descricao { font-size: 0.78rem; }
        .produto-preco { font-size: 1.15rem; }
        .produto-actions { padding: 0 1rem 1rem; }
        .btn-add { font-size: 0.62rem; padding: 0.75rem 0.6rem; }
        .produto-badge { font-size: 0.55rem; padding: 0.28rem 0.7rem; }

        .notificacao {
            left: 12px;
            right: 12px;
            max-width: none;
            top: 90px;
        }
    }

    @media (max-width: 600px) {
        .nav-menu { gap: 1rem; }
        .nav-menu a {
            font-size: 0.65rem;
            letter-spacing: 0.08em;
        }

        .logo-word { font-size: 1.8rem; }
        .page-hero h1 { font-size: 1.6rem; }

        .paginacao a,
        .paginacao span {
            min-width: 36px;
            height: 36px;
            font-size: 0.72rem;
            padding: 0 0.7rem;
        }
    }
    </style>
</head>
<body>

<?php if ($flash): ?>
    <div class="notificacao <?= e($flash['tipo']) ?>"><?= e($flash['msg']) ?></div>
<?php endif; ?>

<header>
    <div class="container header-flex">
        <div class="header-left">
            <a href="home.php" class="back-button">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div class="logo-area">
                <div class="logo-word">flwrs <strong>·</strong></div>
                <div class="tagline-header">"Flowers that feel like feeling"</div>
            </div>
        </div>
        <nav class="nav-menu">
            <a href="produtos.php">Produtos</a>
            <a href="faq.php">FAQ de delivery</a>
            <a href="info.php">Sobre nós</a>
            <a href="carrinho.php" class="cart-link">
                <div class="cart-icon-wrapper">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count-badge"><?= countCarrinho() ?></span>
                </div>
            </a>
            <?php if (isLogged()): ?>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="container">

    <section class="page-hero">
        <h1><span>nossas flores</span> · escolhidas com afeto</h1>
        <p>Cada buquê conta uma história. Encontre a sua.</p>
    </section>

    <!-- FILTROS -->
    <form method="GET" class="filtros-bar">
        <div class="search-box">
            <span class="material-symbols-outlined">search</span>
            <input type="text" name="q" placeholder="Buscar flores..." value="<?= e($busca) ?>">
        </div>

        <select name="ordem">
            <option value="recentes"     <?= $ordem === 'recentes'     ? 'selected' : '' ?>>Mais recentes</option>
            <option value="menor_preco"  <?= $ordem === 'menor_preco'  ? 'selected' : '' ?>>Menor preço</option>
            <option value="maior_preco"  <?= $ordem === 'maior_preco'  ? 'selected' : '' ?>>Maior preço</option>
            <option value="nome"         <?= $ordem === 'nome'         ? 'selected' : '' ?>>Nome (A-Z)</option>
        </select>

        <button type="submit">
            <span class="material-symbols-outlined" style="vertical-align:middle;font-size:1.1rem;">filter_alt</span>
            Filtrar
        </button>
    </form>

    <!-- CHIPS DE MODELO -->
    <div class="chips">
        <?php
        $chipBase = $_GET;
        unset($chipBase['modelo'], $chipBase['pagina']);
        ?>
        <a href="?<?= http_build_query($chipBase) ?>" class="chip <?= $modelo === '' ? 'ativo' : '' ?>">
            Todos
        </a>
        <?php foreach (modelosMap() as $k => $v):
            $params = $chipBase; $params['modelo'] = $k;
        ?>
            <a href="?<?= http_build_query($params) ?>" class="chip <?= $modelo === $k ? 'ativo' : '' ?>">
                <?= e($v) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- INFO RESULTADOS -->
    <div class="produtos-info">
        <span>
            <?= $total ?> <?= $total === 1 ? 'produto encontrado' : 'produtos encontrados' ?>
            <?= $busca ? " para \"<strong>" . e($busca) . "</strong>\"" : '' ?>
        </span>
        <?php if ($busca || $modelo): ?>
            <a href="produtos.php" style="color:var(--coral);text-decoration:none;font-size:.85rem;">✕ limpar filtros</a>
        <?php endif; ?>
    </div>

    <!-- GRID DE PRODUTOS -->
    <div class="produtos-grid">
        <?php if (empty($produtos)): ?>
            <div class="vazio">
                <span class="icon">🌷</span>
                <h3>Nenhuma flor encontrada</h3>
                <p>Tente ajustar os filtros ou buscar por outro nome.</p>
                <a href="produtos.php" class="chip ativo">ver todas as flores</a>
            </div>
        <?php else: ?>
            <?php foreach ($produtos as $p): ?>
                <div class="produto-card">
                    <div class="produto-imagem">
                        <?php if (!empty($p['imagem']) && file_exists($p['imagem'])): ?>
                            <img src="<?= e(imagemUrl($p['imagem'])) ?>" alt="<?= e($p['nome']) ?>" loading="lazy">
                        <?php elseif (!empty($p['imagem'])): ?>
                            <img src="<?= e(imagemUrl($p['imagem'])) ?>" alt="<?= e($p['nome']) ?>" loading="lazy"
                                 onerror="this.style.display='none';this.parentNode.innerHTML='🌸';">
                        <?php else: ?>
                            🌸
                        <?php endif; ?>
                        <span class="produto-badge"><?= e(modeloNome($p['modelo'])) ?></span>
                    </div>

                    <div class="produto-info">
                        <h3 class="produto-nome"><?= e($p['nome']) ?></h3>
                        <p class="produto-descricao"><?= e($p['descricao']) ?></p>
                        <div class="produto-preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></div>
                    </div>

                    <form method="POST" action="carrinho_action.php" class="produto-actions">
                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                        <input type="hidden" name="quantidade" value="1">
                        <button type="submit" class="btn-add">
                            <span class="material-symbols-outlined" style="font-size:1.1rem;">add_shopping_cart</span>
                            adicionar ao carrinho
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- PAGINAÇÃO -->
    <?php if ($paginas > 1): ?>
        <nav class="paginacao">
            <?php if ($pagina > 1): ?>
                <a href="<?= urlPagina($pagina - 1) ?>">←</a>
            <?php else: ?>
                <span class="disabled">←</span>
            <?php endif; ?>

            <?php
            $inicio = max(1, $pagina - 2);
            $fim    = min($paginas, $pagina + 2);

            if ($inicio > 1) {
                echo '<a href="' . urlPagina(1) . '">1</a>';
                if ($inicio > 2) echo '<span class="disabled">…</span>';
            }

            for ($i = $inicio; $i <= $fim; $i++):
            ?>
                <?php if ($i === $pagina): ?>
                    <span class="atual"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= urlPagina($i) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($fim < $paginas): ?>
                <?php if ($fim < $paginas - 1) echo '<span class="disabled">…</span>'; ?>
                <a href="<?= urlPagina($paginas) ?>"><?= $paginas ?></a>
            <?php endif; ?>

            <?php if ($pagina < $paginas): ?>
                <a href="<?= urlPagina($pagina + 1) ?>">→</a>
            <?php else: ?>
                <span class="disabled">→</span>
            <?php endif; ?>
        </nav>
    <?php endif; ?>

</main>

<footer>
    <p>flwrs — <span>"Flowers that feel like feeling"</span> — pequenos gestos, memórias eternas</p>
</footer>

<script>
    // Auto-esconde notificação após 4s
    setTimeout(() => {
        const n = document.querySelector('.notificacao');
        if (n) {
            n.style.transition = 'opacity .4s, transform .4s';
            n.style.opacity = '0';
            n.style.transform = 'translateX(120%)';
            setTimeout(() => n.remove(), 500);
        }
    }, 4000);
</script>

</body>
</html>