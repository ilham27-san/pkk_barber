<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <section class="products-section">
        <h2 class="section-title">All Our Products</h2>

        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $p) : ?>
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <img src="<?= base_url('img/products/' . $p['gambar']) ?>" alt="<?= $p['nama_produk'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="product-info">
                            <h3><?= $p['nama_produk'] ?></h3>
                            <span class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
                            <p class="product-desc"><?= $p['deskripsi'] ?></p>
                            
                            <button class="btn-pill" onclick="openProductModal('<?= addslashes($p['nama_produk']) ?>', <?= $p['harga'] ?>, '<?= base_url('img/products/' . $p['gambar']) ?>')">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #999;">
                    <i class="fas fa-box-open fa-4x" style="margin-bottom: 15px; opacity: 0.3;"></i>
                    <p>Belum ada produk yang tersedia saat ini.</p>
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
        <span class="close-modal" onclick="closeProductModal()" style="color:#333; top:15px; right:20px;">&times;</span>
        <div class="modal-body">
            <h2 style="font-family:'Playfair Display',serif; color:var(--dark-brown);">Atur Jumlah</h2>
            <hr style="margin:15px 0; border:0; border-top:1px solid #eee;">
            
            <h4 id="modalName" style="color:var(--dark-brown); margin-bottom:5px;">Nama Produk</h4>
            <span id="modalPrice" style="color:var(--primary-red); font-weight:bold;">Rp 0</span>

            <div class="qty-control" style="justify-content:center; margin:25px 0;">
                <button class="qty-btn" onclick="updateModalQty(-1)">-</button>
                <input type="text" id="modalQtyInput" value="1" readonly style="width:60px; text-align:center; border:none; font-size:1.2rem; font-weight:bold;">
                <button class="qty-btn" onclick="updateModalQty(1)">+</button>
            </div>

            <div style="margin-bottom:20px;">
                Subtotal: <span id="modalSubtotalDisplay" style="font-weight:bold; color:var(--primary-red);">Rp 0</span>
            </div>

            <button class="btn-pill" style="background:var(--dark-brown); color:#fff; border:none; width:100%;" onclick="addToCartFromModal()">
                Masukkan Keranjang
            </button>
        </div>
    </div>
</div>

<div id="cartModal" class="modal-overlay">
    <div class="modal-content">
        <div class="cart-header">
            <h2>Keranjang Saya</h2>
            <span class="close-modal" onclick="closeCartModal()">&times;</span>
        </div>

        <div id="cartItemsList">
            </div>

        <div class="cart-footer">
            <div class="cart-total-row">
                <span>Total</span>
                <span id="cartGrandTotal">Rp 0</span>
            </div>
            <button class="btn-checkout-wa" onclick="checkoutToWhatsapp()">
                <i class="fab fa-whatsapp fa-lg"></i> Checkout via WhatsApp
            </button>
        </div>
    </div>
</div>

<script>
    // Logic Javascript tetap sama namun sekarang menerima data dinamis dari loop PHP di atas
    let cart = JSON.parse(localStorage.getItem('barberCart')) || [];
    let tempProduct = { name: "", price: 0, qty: 1 };
    const sellerPhone = "6281513728023"; 

    updateCartCount();

    function openProductModal(name, price, imgSrc) {
        tempProduct = { name: name, price: price, qty: 1 };
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
            cart.push({ ...tempProduct });
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
                <div style="text-align:center; padding:40px 0; color:#999;">
                    <i class="fas fa-shopping-basket fa-3x" style="margin-bottom:15px; opacity:0.3;"></i>
                    <p>Keranjang Anda kosong.</p>
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
        
        cart = []; 
        saveCart();
        renderCartList();
        closeCartModal();
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