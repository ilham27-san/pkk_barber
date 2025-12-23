<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* --- RESET & FONTS --- */
    .products-section {
        background-color: transparent;
        font-family: 'Montserrat', sans-serif;
        padding: 60px 0;
    }

    /* --- HEADER --- */
    .section-title {
        text-align: center;
        margin-bottom: 10px;
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 3px 3px 0px #000000;

    }

    .section-subtitle {
        text-align: center;
        color: #ffffff;
        font-size: 1.3rem;
        max-width: 700px;
        margin: 0 auto 60px;
        line-height: 1.6;
        font-weight: 400;
        text-shadow: 2px 2px 1.5px rgba(0, 0, 0, 0.6);

    }

    /* --- GRID SYSTEM (3 KOLOM & TENGAH) --- */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
    }

    /* --- KARTU PRODUK --- */
    .product-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    /* --- GAMBAR PORTRAIT (MEMANJANG KE ATAS) --- */
    .product-image-wrapper {
        width: 100%;
        position: relative;
        /* TEKNIK PADDING HACK: Memaksa rasio Portrait */
        padding-top: 135%;
        background: #f9f9f9;
        overflow: hidden;
        border-bottom: 1px solid #f5f5f5;
    }

    .product-image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.08);
    }

    /* --- INFO PRODUK --- */
    .product-info {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-between;
    }

    .product-header {
        margin-bottom: 10px;
    }

    .product-title {
        font-size: 1.25rem;
        margin: 0 0 5px;
        color: #333;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        line-height: 1.3;
    }

    .product-price {
        color: var(--primary-red, #c0392b);
        font-weight: 700;
        font-size: 1.1rem;
        display: block;
        margin-top: 5px;
    }

    .product-desc {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 25px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* --- BUTTON --- */
    .btn-pill {
        background: var(--dark-brown, #3e2b26);
        color: white;
        border: none;
        padding: 14px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        width: 100%;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-pill:hover {
        background: #5d4037;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(62, 43, 38, 0.3);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            max-width: 700px;
        }
    }

    @media (max-width: 600px) {
        .product-grid {
            grid-template-columns: 1fr;
            padding: 0 20px;
        }
    }

    /* --- CART & MODAL STYLES --- */
    .floating-cart-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: var(--dark-brown, #3e2b26);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        z-index: 1000;
        transition: transform 0.2s;
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--primary-red, #c0392b);
        color: #fff;
        font-size: 0.8rem;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 2px solid #fff;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(3px);
    }

    .modal-content {
        background: #fff;
        width: 90%;
        max-width: 420px;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        animation: slideDown 0.3s ease;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.8rem;
        cursor: pointer;
        color: #aaa;
    }

    .close-modal:hover {
        color: #333;
    }

    .qty-control {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        margin: 30px 0;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid #ddd;
        background: #fff;
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
        transition: all 0.2s;
    }

    .qty-btn:hover {
        background: #f5f5f5;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #eee;
    }

    .cart-item-info {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .cart-item-title {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    .cart-item-price {
        font-size: 0.9rem;
        color: #888;
    }

    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-item-subtotal {
        font-weight: 700;
        font-size: 1rem;
        color: var(--primary-red);
    }

    .btn-remove-item {
        border: none;
        background: none;
        color: #ccc;
        cursor: pointer;
        font-size: 1.1rem;
    }

    .btn-remove-item:hover {
        color: #e74c3c;
    }

    .cart-footer {
        margin-top: 25px;
    }

    .cart-total-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .btn-checkout-wa {
        background: #25D366;
        color: #fff;
        width: 100%;
        border: none;
        padding: 14px;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 1rem;
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        transition: all 0.3s;
    }

    .btn-checkout-wa:hover {
        background: #128C7E;
        transform: translateY(-2px);
    }
</style>

<div class="container">
    <section class="products-section">

        <h2 class="section-title">All Our Products</h2>
        <p class="section-subtitle">
            Koleksi grooming premium untuk gaya rambut maksimal setiap hari.
        </p>

        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $p) : ?>
                    <div class="product-card">

                        <div class="product-image-wrapper">
                            <img src="<?= base_url('img/products/' . $p['gambar']) ?>"
                                alt="<?= $p['nama_produk'] ?>"
                                onerror="this.src='https://via.placeholder.com/300x450?text=No+Image'">
                        </div>

                        <div class="product-info">
                            <div class="product-header">
                                <h3 class="product-title"><?= esc($p['nama_produk']) ?></h3>
                                <span class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
                            </div>

                            <p class="product-desc"><?= esc($p['deskripsi']) ?></p>

                            <button class="btn-pill"
                                onclick="openProductModal('<?= htmlspecialchars($p['nama_produk'], ENT_QUOTES) ?>', <?= $p['harga'] ?>, '<?= base_url('img/products/' . $p['gambar']) ?>')">
                                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 80px 20px; color: #999;">
                    <i class="fas fa-box-open fa-4x" style="margin-bottom: 20px; opacity: 0.3;"></i>
                    <p style="font-size: 1.1rem;">Belum ada produk yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<div class="floating-cart-btn" onclick="openCartModal()">
    <i class="fas fa-shopping-bag fa-lg"></i>
    <span class="cart-count" id="cartCountBadge">0</span>
</div>

<div id="productModal" class="modal-overlay">
    <div class="modal-content" style="text-align:center;">
        <span class="close-modal" onclick="closeProductModal()">&times;</span>
        <div class="modal-body">
            <h2 style="font-family:'Playfair Display',serif; color:var(--dark-brown); margin-bottom:5px;">Atur Jumlah</h2>
            <p style="color:#888; font-size:0.9rem; margin-bottom:20px;">Berapa banyak yang ingin Anda beli?</p>
            <hr style="margin:15px 0; border:0; border-top:1px dashed #eee;">

            <h4 id="modalName" style="color:#333; margin-bottom:5px; font-weight:700; font-size:1.1rem;">Nama Produk</h4>
            <span id="modalPrice" style="color:var(--primary-red); font-weight:bold; font-size:1rem;">Rp 0</span>

            <div class="qty-control">
                <button class="qty-btn" onclick="updateModalQty(-1)"><i class="fas fa-minus"></i></button>
                <input type="text" id="modalQtyInput" value="1" readonly style="width:60px; text-align:center; border:none; font-size:1.4rem; font-weight:bold; color:#333;">
                <button class="qty-btn" onclick="updateModalQty(1)"><i class="fas fa-plus"></i></button>
            </div>

            <div style="margin-bottom:25px; font-size:1.1rem;">
                Total: <span id="modalSubtotalDisplay" style="font-weight:bold; color:var(--dark-brown);">Rp 0</span>
            </div>

            <button class="btn-pill" onclick="addToCartFromModal()">
                Masukkan Keranjang
            </button>
        </div>
    </div>
</div>

<div id="cartModal" class="modal-overlay">
    <div class="modal-content">
        <div class="cart-header" style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #eee; padding-bottom:15px; margin-bottom:15px;">
            <h2 style="margin:0; font-size:1.5rem; font-family:'Playfair Display',serif; color:var(--dark-brown);">Keranjang Saya</h2>
            <span class="close-modal" onclick="closeCartModal()" style="position:static;">&times;</span>
        </div>

        <div id="cartItemsList" style="max-height: 350px; overflow-y: auto; padding-right:5px;">
        </div>

        <div class="cart-footer">
            <div class="cart-total-row">
                <span>Total Pesanan</span>
                <span id="cartGrandTotal">Rp 0</span>
            </div>
            <button class="btn-checkout-wa" onclick="checkoutToWhatsapp()">
                <i class="fab fa-whatsapp fa-lg"></i> Checkout via WhatsApp
            </button>
        </div>
    </div>
</div>

<script>
    let cart = JSON.parse(localStorage.getItem('barberCart')) || [];
    let tempProduct = {
        name: "",
        price: 0,
        qty: 1
    };
    const sellerPhone = "6281513728023";

    updateCartCount();

    function openProductModal(name, price, imgSrc) {
        tempProduct = {
            name: name,
            price: price,
            qty: 1
        };
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalPrice').innerText = formatRupiah(price);
        document.getElementById('modalQtyInput').value = 1;
        updateModalSubtotal();
        document.getElementById('productModal').style.display = 'flex';
    }

    function closeProductModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    function updateModalQty(change) {
        let newQty = tempProduct.qty + change;
        if (newQty < 1) return;
        tempProduct.qty = newQty;
        document.getElementById('modalQtyInput').value = newQty;
        updateModalSubtotal();
    }

    function updateModalSubtotal() {
        document.getElementById('modalSubtotalDisplay').innerText = formatRupiah(tempProduct.price * tempProduct.qty);
    }

    function addToCartFromModal() {
        let existingItem = cart.find(item => item.name === tempProduct.name);
        if (existingItem) {
            existingItem.qty += tempProduct.qty;
        } else {
            cart.push({
                ...tempProduct
            });
        }
        saveCart();
        closeProductModal();

        const btn = document.querySelector('.floating-cart-btn');
        btn.style.transform = "scale(1.2)";
        setTimeout(() => btn.style.transform = "scale(1)", 200);
    }

    function openCartModal() {
        renderCartList();
        document.getElementById('cartModal').style.display = 'flex';
    }

    function closeCartModal() {
        document.getElementById('cartModal').style.display = 'none';
    }

    function renderCartList() {
        const listContainer = document.getElementById('cartItemsList');
        listContainer.innerHTML = "";
        let grandTotal = 0;

        if (cart.length === 0) {
            listContainer.innerHTML = `
                <div style="text-align:center; padding:50px 0; color:#999;">
                    <i class="fas fa-shopping-basket fa-3x" style="margin-bottom:15px; opacity:0.3;"></i>
                    <p>Keranjang Anda masih kosong.</p>
                </div>`;
            document.getElementById('cartGrandTotal').innerText = formatRupiah(0);
            return;
        }

        cart.forEach((item, index) => {
            let itemTotal = item.price * item.qty;
            grandTotal += itemTotal;

            listContainer.innerHTML += `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <span class="cart-item-title">${item.name}</span>
                        <span class="cart-item-price">${item.qty} x ${formatRupiah(item.price)}</span>
                    </div>
                    <div class="cart-item-actions">
                        <span class="cart-item-subtotal">${formatRupiah(itemTotal)}</span>
                        <button class="btn-remove-item" onclick="removeFromCart(${index})" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        document.getElementById('cartGrandTotal').innerText = formatRupiah(grandTotal);
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        saveCart();
        renderCartList();
    }

    function saveCart() {
        localStorage.setItem('barberCart', JSON.stringify(cart));
        updateCartCount();
    }

    function updateCartCount() {
        let count = cart.reduce((sum, item) => sum + item.qty, 0);
        document.getElementById('cartCountBadge').innerText = count;

        if (count === 0) {
            document.getElementById('cartCountBadge').style.display = 'none';
        } else {
            document.getElementById('cartCountBadge').style.display = 'flex';
        }
    }

    function checkoutToWhatsapp() {
        if (cart.length === 0) {
            alert("Keranjang kosong!");
            return;
        }

        let message = `Halo BarberNow, saya ingin memesan produk berikut:%0A%0A`;
        let grandTotal = 0;

        cart.forEach((item, i) => {
            let subtotal = item.price * item.qty;
            grandTotal += subtotal;
            message += `${i+1}. *${item.name}* (x${item.qty}) - ${formatRupiah(subtotal)}%0A`;
        });

        message += `%0A--------------------------------%0A`;
        message += `💰 *TOTAL BAYAR: ${formatRupiah(grandTotal)}*%0A%0A`;
        message += `Mohon info pembayaran dan pengirimannya. Terima kasih!`;

        window.open(`https://wa.me/${sellerPhone}?text=${message}`, '_blank');
    }

    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('productModal')) closeProductModal();
        if (event.target == document.getElementById('cartModal')) closeCartModal();
    }
</script>

<?= $this->endSection(); ?>