<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flwrs · finalizar compra</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0,1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* ===== RESET & BASE ===== */
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
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

    /* ===== HEADER ===== */
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

    /* ===== NAVIGATION ===== */
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

    /* ===== CHECKOUT ===== */
    .checkout-header {
    padding: 3rem 0 2rem;
    }

    .checkout-header h1 {
    font-size: 2.6rem;
    font-weight: 300;
    letter-spacing: -0.02em;
    color: #2d2825;
    }

    .checkout-header h1 span {
    color: #f07d9d;
    font-weight: 400;
    }

    .checkout-header p {
    font-size: 1.05rem;
    color: #6d6560;
    font-weight: 300;
    margin-top: 0.3rem;
    }

    .checkout-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 3rem;
    padding: 1rem 0 4rem;
    }

    /* ===== FORMULÁRIO ===== */
    .form-section {
    background: white;
    border-radius: 28px;
    padding: 2.5rem;
    border: 1px solid rgba(180, 165, 160, 0.06);
    }

    .form-section h2 {
    font-size: 1.1rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    color: #2d2825;
    margin-bottom: 0.2rem;
    }

    .form-section .subtitle {
    font-size: 0.85rem;
    color: #a8958f;
    font-weight: 300;
    margin-bottom: 1.8rem;
    }

    .form-group {
    margin-bottom: 1.5rem;
    }

    .form-group label {
    display: block;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #5a5552;
    margin-bottom: 0.4rem;
    }

    .form-group label .required {
    color: #e94e77;
    margin-left: 0.2rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    border-radius: 16px;
    border: 1.5px solid rgba(180, 165, 160, 0.12);
    font-family: inherit;
    font-size: 0.95rem;
    background: #fcf8f5;
    transition: all 0.3s ease;
    color: #3d3835;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
    outline: none;
    border-color: #e94e77;
    background: white;
    box-shadow: 0 0 0 4px rgba(233, 78, 119, 0.04);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
    color: #b0a8a3;
    font-weight: 300;
    }

    .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    }

    .form-group textarea {
    resize: vertical;
    min-height: 80px;
    }

    .form-divider {
    border: none;
    border-top: 1px solid rgba(180, 165, 160, 0.08);
    margin: 2rem 0;
    }

    /* ===== MÉTODOS DE PAGAMENTO ===== */
    .payment-methods {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.8rem;
    margin-top: 0.5rem;
    }

    .payment-option {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0.8rem 1rem;
    border-radius: 16px;
    border: 1.5px solid rgba(180, 165, 160, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fcf8f5;
    }

    .payment-option:hover {
    border-color: rgba(233, 78, 119, 0.2);
    }

    .payment-option input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #e94e77;
    cursor: pointer;
    flex-shrink: 0;
    }

    .payment-option label {
    font-size: 0.85rem;
    font-weight: 400;
    color: #3d3835;
    cursor: pointer;
    text-transform: none;
    letter-spacing: 0;
    margin: 0;
    }

    .payment-option .payment-icon {
    font-size: 1.4rem;
    color: #a8958f;
    margin-left: auto;
    }

    .payment-option.selected {
    border-color: #e94e77;
    background: rgba(233, 78, 119, 0.04);
    }

    /* ===== RESUMO DO PEDIDO ===== */
    .order-summary {
    background: white;
    border-radius: 28px;
    padding: 2.5rem;
    border: 1px solid rgba(180, 165, 160, 0.06);
    position: sticky;
    top: 100px;
    height: fit-content;
    }

    .order-summary h2 {
    font-size: 1.1rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    color: #2d2825;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(180, 165, 160, 0.08);
    }

    .order-item {
    display: flex;
    gap: 1rem;
    padding: 0.8rem 0;
    border-bottom: 1px solid rgba(180, 165, 160, 0.05);
    align-items: center;
    }

    .order-item:last-of-type {
    border-bottom: none;
    }

    .order-item .item-icon {
    font-size: 1.8rem;
    flex-shrink: 0;
    width: 44px;
    text-align: center;
    }

    .order-item .item-info {
    flex: 1;
    }

    .order-item .item-name {
    font-size: 0.9rem;
    font-weight: 500;
    color: #2d2825;
    }

    .order-item .item-detail {
    font-size: 0.75rem;
    color: #a8958f;
    font-weight: 300;
    }

    .order-item .item-price {
    font-size: 0.9rem;
    font-weight: 500;
    color: #2d2825;
    }

    .order-totals {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(180, 165, 160, 0.08);
    }

    .order-totals .total-line {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: #6d6560;
    padding: 0.3rem 0;
    }

    .order-totals .total-line strong {
    font-weight: 500;
    color: #2d2825;
    }

    .order-totals .total-grand {
    display: flex;
    justify-content: space-between;
    font-size: 1.2rem;
    font-weight: 600;
    color: #2d2825;
    padding: 1rem 0 0.5rem;
    border-top: 1px solid rgba(180, 165, 160, 0.08);
    margin-top: 0.5rem;
    }

    .order-totals .total-grand span {
    color: #e94e77;
    }

    /* ===== BOTÃO FINALIZAR ===== */
    .btn-finalizar {
    width: 100%;
    background: #e94e77;
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1.5rem;
    box-shadow: 0 4px 20px rgba(233, 78, 119, 0.2);
    }

    .btn-finalizar:hover {
    background: #d43d66;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(233, 78, 119, 0.25);
    }

    .btn-finalizar:active {
    transform: translateY(0);
    }

    .btn-finalizar:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none !important;
    }

    /* ===== TOAST ===== */
    .toast-msg {
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    background: #2d2825;
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 400;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    z-index: 999;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    animation: slideUp 0.4s ease;
    max-width: 90%;
    text-align: center;
    }

    .toast-msg i {
    color: #91b691;
    font-size: 1.2rem;
    }

    @keyframes slideUp {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
    }

    /* ===== MENSAGEM DE SEGURANÇA ===== */
    .secure-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    margin-top: 1.2rem;
    font-size: 0.7rem;
    color: #a8958f;
    letter-spacing: 0.04em;
    }

    .secure-badge i {
    font-size: 1rem;
    color: #91b691;
    }

    /* ===== FOOTER ===== */
    footer {
    text-align: center;
    padding: 3rem 2rem;
    border-top: 1px solid rgba(180, 165, 160, 0.08);
    margin-top: 1rem;
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
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
    .checkout-grid {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    }

    @media (max-width: 900px) {
    .checkout-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .order-summary {
        position: static;
    }

    .checkout-header h1 {
        font-size: 2rem;
    }
    }

    @media (max-width: 768px) {
    .container {
        padding: 0 1.5rem;
    }

    .header-flex {
        flex-direction: column;
        text-align: center;
    }

    .header-left {
        flex-direction: row;
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
    }

    .back-button {
        font-size: 1.3rem;
    }

    .back-button .material-symbols-outlined {
        font-size: 1.6rem;
    }

    .logo-area {
        justify-content: center;
    }

    .tagline-header {
        border-left: none;
        padding-left: 0;
    }

    .nav-menu {
        justify-content: center;
        gap: 1.5rem;
    }

    .form-section {
        padding: 1.8rem;
    }

    .order-summary {
        padding: 1.8rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .payment-methods {
        grid-template-columns: 1fr;
    }

    .checkout-header h1 {
        font-size: 1.6rem;
    }

    .toast-msg {
        font-size: 0.8rem;
        padding: 0.8rem 1.5rem;
        bottom: 1.5rem;
    }
    }

    @media (max-width: 480px) {
    .header-left {
        gap: 0.8rem;
    }

    .logo-word {
        font-size: 1.8rem;
    }

    .back-button .material-symbols-outlined {
        font-size: 1.4rem;
    }

    .form-section {
        padding: 1.2rem;
    }

    .order-summary {
        padding: 1.2rem;
    }

    .payment-option {
        padding: 0.6rem 0.8rem;
    }

    .payment-option label {
        font-size: 0.8rem;
    }
    }

    /* ===== MATERIAL SYMBOLS FALLBACK ===== */
    .material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
    }
</style>
</head>
<body>
<header>
<div class="container header-flex">
    <div class="header-left">
    <a href="carrinho.php" class="back-button" aria-label="Voltar ao carrinho">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <div class="logo-area">
        <div class="logo-word">
        flwrs <strong>·</strong>
        </div>
        <div class="tagline-header">
        “Flowers that feel like feeling”
        </div>
    </div>
    </div>
    <nav class="nav-menu">
    <a href="produtos.php">Produtos</a>
    <a href="faq.php">FAQ de delivery</a>
    <a href="info.php">Sobre nós</a>
    <a href="carrinho.php" class="cart-link" id="cartNavLink">
        <div class="cart-icon-wrapper">
        <i class="fas fa-shopping-bag"></i>
        <span class="cart-count-badge" id="cartCountBadge">3</span>
        </div>
    </a>
    <a href="login.php">Login</a>
    </nav>
</div>
</header>

<main>
<div class="container">
    <!-- Título da página -->
    <div class="checkout-header">
    <h1>finalizar <span>compra</span></h1>
    <p>Preencha os dados abaixo para concluir seu pedido com carinho.</p>
    </div>

    <!-- Grid checkout -->
    <div class="checkout-grid">
    <!-- Coluna do formulário -->
    <section class="form-section">
        <h2>dados de entrega</h2>
        <p class="subtitle">Informe onde quer receber seu buquê</p>

        <form id="checkoutForm" onsubmit="return false;">
        <div class="form-group">
            <label for="nome">Nome completo <span class="required">*</span></label>
            <input type="text" id="nome" placeholder="Seu nome completo" required>
        </div>

        <div class="form-row">
            <div class="form-group">
            <label for="cpf">CPF <span class="required">*</span></label>
            <input type="text" id="cpf" placeholder="000.000.000-00" required>
            </div>
            <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" id="telefone" placeholder="(00) 00000-0000">
            </div>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="seu@gmail.com">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço <span class="required">*</span></label>
            <input type="text" id="endereco" placeholder="Rua, número, complemento" required>
        </div>

        <div class="form-row">
            <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" placeholder="Bairro">
            </div>
            <div class="form-group">
            <label for="cidade">Cidade <span class="required">*</span></label>
            <input type="text" id="cidade" placeholder="Cidade" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" id="cep" placeholder="00000-000">
            </div>
            <div class="form-group">
            <label for="uf">UF</label>
            <select id="uf">
                <option value="">Selecione</option>
                <option value="SP">SP</option>
                <option value="RJ">RJ</option>
                <option value="MG">MG</option>
                <option value="RS">RS</option>
                <option value="PR">PR</option>
                <option value="SC">SC</option>
                <option value="BA">BA</option>
                <option value="DF">DF</option>
                <option value="GO">GO</option>
                <option value="PE">PE</option>
                <option value="CE">CE</option>
                <option value="ES">ES</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
            </select>
            </div>
        </div>

        <hr class="form-divider">

        <div class="form-group">
            <label for="recado">Recado personalizado (opcional)</label>
            <textarea id="recado" placeholder="Escreva aqui a mensagem que vai junto com o buquê..."></textarea>
        </div>

        <hr class="form-divider">

        <h2 style="font-size:1rem; margin-bottom:0.8rem;">forma de pagamento</h2>
        <div class="payment-methods">
            <div class="payment-option selected">
            <input type="radio" name="payment" id="pix" value="pix" checked>
            <label for="pix">PIX</label>
            <span class="payment-icon"><i class="fas fa-qrcode"></i></span>
            </div>
            <div class="payment-option">
            <input type="radio" name="payment" id="cartao" value="cartao">
            <label for="cartao">Cartão</label>
            <span class="payment-icon"><i class="fas fa-credit-card"></i></span>
            </div>
            <div class="payment-option">
            <input type="radio" name="payment" id="boleto" value="boleto">
            <label for="boleto">Boleto</label>
            <span class="payment-icon"><i class="fas fa-barcode"></i></span>
            </div>
        </div>

        <button type="submit" class="btn-finalizar" id="finalizarBtn">
            <i class="fas fa-check" style="margin-right:0.5rem;"></i> finalizar dados
        </button>

        <div class="secure-badge">
            <i class="fas fa-lock"></i>
            <span>Compra segura · Dados criptografados</span>
        </div>
        </form>
    </section>

    <!-- Resumo do pedido -->
    <aside class="order-summary">
        <h2>seu pedido</h2>

        <div class="order-item">
        <span class="item-icon">🌹</span>
        <div class="item-info">
            <div class="item-name">Buquê Afetivo</div>
            <div class="item-detail">Rosas · 12 unidades</div>
        </div>
        <span class="item-price">R$ 89,90</span>
        </div>

        <div class="order-item">
        <span class="item-icon">🌸</span>
        <div class="item-info">
            <div class="item-name">Palavras em Flor</div>
            <div class="item-detail">Recado personalizado</div>
        </div>
        <span class="item-price">R$ 0,00</span>
        </div>

        <div class="order-item">
        <span class="item-icon">💐</span>
        <div class="item-info">
            <div class="item-name">Assinatura Mensal</div>
            <div class="item-detail">1º mês · entrega surpresa</div>
        </div>
        <span class="item-price">R$ 49,90</span>
        </div>

        <div class="order-totals">
        <div class="total-line">
            <span>Subtotal</span>
            <span><strong>R$ 139,80</strong></span>
        </div>
        <div class="total-line">
            <span>Entrega</span>
            <span><strong>R$ 15,00</strong></span>
        </div>
        <div class="total-line" style="font-size:0.8rem; color:#91b691;">
            <span>🌿 Embalagem ecológica</span>
            <span><strong>Gratuito</strong></span>
        </div>
        <div class="total-grand">
            <span>Total</span>
            <span>R$ 154,80</span>
        </div>
        </div>

        <button class="btn-finalizar" id="finalizarBtnAside" style="margin-top:1rem;">
        <i class="fas fa-check" style="margin-right:0.5rem;"></i> finalizar pedido
        </button>

        <div class="secure-badge">
        <i class="fas fa-truck"></i>
        <span>Entrega em até 3 dias úteis</span>
        </div>
    </aside>
    </div>
</div>
</main>

<footer>
<p>flwrs — <span>“Flowers that feel like feeling”</span> — pequenos gestos, memórias eternas</p>
</footer>

<script>
(function() {
    // ===== BADGE DO CARRINHO =====
    const badge = document.getElementById('cartCountBadge');
    if (badge) {
    badge.textContent = '3';
    }

    // ===== MÉTODOS DE PAGAMENTO =====
    const paymentOptions = document.querySelectorAll('.payment-option');
    paymentOptions.forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    if (radio) {
        radio.addEventListener('change', function() {
        paymentOptions.forEach(opt => opt.classList.remove('selected'));
        if (this.checked) {
            option.classList.add('selected');
        }
        });
    }
    });

    // ===== TOAST =====
    function showToastMessage(message, icon = '🌸') {
    const existingToast = document.querySelector('.toast-msg');
    if (existingToast) existingToast.remove();

    const toast = document.createElement('div');
    toast.className = 'toast-msg';
    toast.innerHTML = `<i class="fas fa-${icon === '🌸' ? 'flower' : 'check-circle'}"></i> ${message}`;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
    }

    // ===== VALIDAR CPF =====
    function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, '');
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false;
    
    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let rest = 11 - (sum % 11);
    let dig1 = rest >= 10 ? 0 : rest;
    if (parseInt(cpf.charAt(9)) !== dig1) return false;

    sum = 0;
    for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }
    rest = 11 - (sum % 11);
    let dig2 = rest >= 10 ? 0 : rest;
    return parseInt(cpf.charAt(10)) === dig2;
    }

    // ===== FORMATAR CPF =====
    function formatarCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g, '');
    if (cpf.length <= 3) return cpf;
    if (cpf.length <= 6) return cpf.replace(/(\d{3})(\d+)/, '$1.$2');
    if (cpf.length <= 9) return cpf.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }

    // ===== FORMATAR TELEFONE =====
    function formatarTelefone(telefone) {
    telefone = telefone.replace(/[^\d]/g, '');
    if (telefone.length <= 2) return telefone;
    if (telefone.length <= 6) return telefone.replace(/(\d{2})(\d+)/, '($1) $2');
    if (telefone.length <= 10) return telefone.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
    return telefone.replace(/(\d{2})(\d{5})(\d+)/, '($1) $2-$3');
    }

    // ===== FORMATAR CEP =====
    function formatarCEP(cep) {
    cep = cep.replace(/[^\d]/g, '');
    if (cep.length <= 5) return cep;
    return cep.replace(/(\d{5})(\d+)/, '$1-$2');
    }

    // ===== MASCARAS =====
    document.getElementById('cpf')?.addEventListener('input', function(e) {
    const start = this.selectionStart;
    const end = this.selectionEnd;
    const formatted = formatarCPF(this.value);
    this.value = formatted;
    // Ajusta posição do cursor
    const diff = formatted.length - this.value.length;
    if (diff > 0) {
        this.setSelectionRange(start + diff, end + diff);
    }
    });

    document.getElementById('telefone')?.addEventListener('input', function(e) {
    const start = this.selectionStart;
    const end = this.selectionEnd;
    const formatted = formatarTelefone(this.value);
    this.value = formatted;
    const diff = formatted.length - this.value.length;
    if (diff > 0) {
        this.setSelectionRange(start + diff, end + diff);
    }
    });

    document.getElementById('cep')?.addEventListener('input', function(e) {
    const start = this.selectionStart;
    const end = this.selectionEnd;
    const formatted = formatarCEP(this.value);
    this.value = formatted;
    const diff = formatted.length - this.value.length;
    if (diff > 0) {
        this.setSelectionRange(start + diff, end + diff);
    }
    });

    // ===== FINALIZAR COMPRA =====
    function finalizarCompra() {
    const nome = document.getElementById('nome')?.value.trim();
    const cpf = document.getElementById('cpf')?.value.trim();
    const endereco = document.getElementById('endereco')?.value.trim();
    const cidade = document.getElementById('cidade')?.value.trim();

    // Validações
    if (!nome) {
        showToastMessage('Por favor, preencha seu nome completo.', '⚠️');
        document.getElementById('nome')?.focus();
        return;
    }

    if (!cpf) {
        showToastMessage('Por favor, informe seu CPF.', '⚠️');
        document.getElementById('cpf')?.focus();
        return;
    }

    const cpfLimpo = cpf.replace(/[^\d]/g, '');
    if (!validarCPF(cpfLimpo)) {
        showToastMessage('CPF inválido. Verifique o número digitado.', '⚠️');
        document.getElementById('cpf')?.focus();
        return;
    }

    if (!endereco) {
        showToastMessage('Por favor, preencha seu endereço.', '⚠️');
        document.getElementById('endereco')?.focus();
        return;
    }

    if (!cidade) {
        showToastMessage('Por favor, preencha sua cidade.', '⚠️');
        document.getElementById('cidade')?.focus();
        return;
    }

    const pagamento = document.querySelector('input[name="payment"]:checked');
    const metodo = pagamento ? pagamento.value : 'não selecionado';

    // Mostra toast de sucesso nos dados
    showToastMessage('Dados cadastrados com sucesso! ✅', '✅');

    // Desabilita o botão
    const btn = document.getElementById('finalizarBtn');
    btn.innerHTML = '<i class="fas fa-check"></i> dados salvos!';
    btn.style.background = '#91b691';
    btn.disabled = true;

    // Reabilita após 3 segundos
    setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-check" style="margin-right:0.5rem;"></i> finalizar dados';
        btn.style.background = '#e94e77';
        btn.disabled = false;
    }, 3000);

    // Simula envio para o resumo
    console.log('📦 Dados do pedido:', {
        nome,
        cpf: cpfLimpo,
        endereco,
        cidade,
        metodo_pagamento: metodo
    });
    }

    const btnFinalizar = document.getElementById('finalizarBtn');
    const btnAside = document.getElementById('finalizarBtnAside');

    if (btnFinalizar) {
    btnFinalizar.addEventListener('click', finalizarCompra);
    }

    if (btnAside) {
    btnAside.addEventListener('click', function() {
        // Verifica se os dados já foram preenchidos
        const nome = document.getElementById('nome')?.value.trim();
        const cpf = document.getElementById('cpf')?.value.trim();
        const endereco = document.getElementById('endereco')?.value.trim();
        const cidade = document.getElementById('cidade')?.value.trim();

        if (!nome || !cpf || !endereco || !cidade) {
        showToastMessage('Preencha todos os dados obrigatórios primeiro!', '⚠️');
        document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
        return;
        }

        // Verifica CPF
        const cpfLimpo = cpf.replace(/[^\d]/g, '');
        if (!validarCPF(cpfLimpo)) {
        showToastMessage('CPF inválido. Verifique o número digitado.', '⚠️');
        document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
        return;
        }

        showToastMessage('Compra finalizada com sucesso! Obrigado por escolher a flwrs 🌸', '🌸');
    });
    }

    // ===== VALIDAÇÃO DO FORM =====
    const form = document.getElementById('checkoutForm');
    if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        finalizarCompra();
    });
    }

    console.log('🌸 flwrs · checkout carregado');
})();
</script>
</body>
</html>