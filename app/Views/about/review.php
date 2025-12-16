<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
    .review-wrapper-font { font-family: 'Montserrat', sans-serif; color: #333; }

    /* CONTAINER UTAMA */
    .review-container-wide {
        max-width: 1280px;
        width: 100%;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* HEADER */
    .page-header { text-align: center; margin-bottom: 40px; }
    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem; color: var(--dark-brown, #5C2C27);
        font-weight: 700; margin: 0 0 10px 0;
    }
    .page-subtitle { color: #777; font-size: 1.1rem; }

    /* --- LAYOUT FLOAT SYSTEM --- */
    .review-hybrid-layout::after {
        content: ""; display: table; clear: both;
    }

    /* === SIDEBAR KIRI (FLOAT) === */
    .review-sidebar-float {
        float: left;
        width: 380px;
        margin-right: 40px;
        margin-bottom: 40px;
        
        background: #ffffff;
        border-radius: 20px;
        padding: 35px 30px; 
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0,0,0,0.02);

        /* [KUNCI 1] Tinggi fix 600px (Kira-kira setara 3 kartu review) */
        height: 609px; 
        
        /* Agar isi sidebar menyebar ke bawah (tidak bolong) */
        display: flex;
        flex-direction: column;
    }

    /* Summary Section */
    .rating-summary-box { text-align: center; padding-bottom: 20px; border-bottom: 1px dashed #eee; margin-bottom: 20px; }
    .big-rating { font-family: 'Playfair Display', serif; font-size: 3.5rem; font-weight: 700; color: #3e2b26; line-height: 1; margin-bottom: 5px; }
    .stars-display { color: #cba155; font-size: 1.2rem; margin-bottom: 5px; }
    .total-reviews { color: #888; font-size: 0.85rem; font-weight: 500; }

    /* Form Area (Flex Grow) */
    .write-review-area { 
        flex-grow: 1; /* Area ini akan mengambil sisa ruang kosong */
        display: flex; 
        flex-direction: column; 
    }
    .write-review-area h4 { font-family: 'Playfair Display', serif; font-size: 1.2rem; color: #3e2b26; margin-bottom: 15px; text-align: center; }
    
    .star-rating-input { display: flex; flex-direction: row-reverse; justify-content: center; gap: 8px; margin-bottom: 15px; }
    .star-rating-input input { display: none; }
    .star-rating-input label { font-size: 1.8rem; color: #ddd; cursor: pointer; transition: color 0.2s; }
    .star-rating-input label:hover, .star-rating-input label:hover ~ label, .star-rating-input input:checked ~ label { color: #cba155; }

    /* [KUNCI 2] Form juga harus flex agar textarea bisa ditarik */
    .review-form-flex {
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Mengisi ruang sisa di sidebar */
    }

    .form-group-review { 
        flex-grow: 1; /* Ini membuat div pembungkus textarea memanjang */
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    /* [KUNCI 3] Textarea memanjang otomatis */
    .input-review-text { 
        width: 100%; 
        padding: 15px; 
        border: 2px solid #eee; 
        border-radius: 12px; 
        font-family: 'Montserrat', sans-serif; 
        resize: none; /* User gabisa resize manual biar ga rusak layout */
        font-size: 0.95rem;
        
        flex-grow: 1; /* Textarea akan memanjang sampai bawah */
        height: 100%;
    }
    .input-review-text:focus { outline: none; border-color: #cba155; background: #fffbf5; }

    .btn-submit-review { 
        width: 100%; background-color: #3e2b26; color: #fff; border: none; 
        padding: 14px; border-radius: 50px; font-weight: 700; cursor: pointer; 
        transition: all 0.3s; margin-top: auto; /* Pastikan tombol di paling bawah */
    }
    .btn-submit-review:hover { background-color: #a52b2b; }

    .mini-alert { padding: 10px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 15px; text-align: center; }
    .alert-err { background: #ffebeb; color: #c0392b; }
    .alert-suc { background: #eafaf1; color: #27ae60; }

    /* === FEED KANAN === */
    .filter-bar-flow { margin-bottom: 20px; padding: 5px 0; display: flex; justify-content: flex-end; align-items: center; }
    .filter-select { padding: 8px 15px; border-radius: 20px; border: 1px solid #ddd; font-family: 'Montserrat', sans-serif; color: #333; cursor: pointer; background: #fff; }

    .review-card-item {
        background: #ffffff;
        border-radius: 15px;
        padding: 20px; /* Padding sedikit dikecilkan biar muat 3 pas */
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid #f9f9f9;
        transition: transform 0.2s;
        margin-bottom: 25px; 
        overflow: hidden; 
        /* Tinggi min kartu */
        min-height: 160px; 
    }
    .review-card-item:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.06); }
    
    .card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
    .user-profile { display: flex; gap: 12px; align-items: center; }
    .avatar-img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #f0f0f0; }
    .user-names h5 { margin: 0; font-size: 1rem; color: #3e2b26; font-weight: 700; }
    .time-stamp { font-size: 0.75rem; color: #999; }
    .card-rating-static { color: #cba155; font-size: 0.85rem; letter-spacing: 2px; }
    .review-msg { color: #555; line-height: 1.5; font-size: 0.9rem; }
    .card-actions { margin-top: 10px; text-align: right; border-top: 1px solid #f5f5f5; padding-top: 8px; }
    .link-del { color: #e74c3c; font-size: 0.8rem; text-decoration: none; font-weight: 600; }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .review-sidebar-float { float: none; width: 100%; margin-right: 0; height: auto; min-height: auto; }
        .input-review-text { height: 150px; resize: vertical; } /* Balik normal di HP */
    }
</style>

<div class="review-wrapper-font">
    <div class="review-container-wide">
        
        <div class="page-header">
            <h2 class="page-title">Apa Kata Mereka?</h2>
            <p class="page-subtitle">Suara jujur dari pelanggan BarberNow.</p>
        </div>

        <div class="review-hybrid-layout">
            
            <aside class="review-sidebar-float">
                <div class="rating-summary-box">
                    <div class="big-rating"><?= number_format($avg_rating ?? 0, 1) ?></div>
                    <div class="stars-display">
                        <?php 
                        $avg = $avg_rating ?? 0;
                        for($i=1; $i<=5; $i++) {
                            echo ($i <= round($avg)) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star" style="color:#ddd;"></i>';
                        }
                        ?>
                    </div>
                    <div class="total-reviews">Total <strong><?= count($reviews ?? []) ?></strong> ulasan</div>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mini-alert alert-err">⚠️ <?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mini-alert alert-suc">✅ <?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <div class="write-review-area">
                    <?php if (session()->get('logged_in')): ?>
                        <h4>Tulis Ulasan Anda</h4>
                        <form action="<?= base_url('about/review/add') ?>" method="post" class="review-form-flex">
                            <?= csrf_field() ?>
                            
                            <div class="star-rating-input">
                                <input type="radio" id="st5" name="rating" value="5" required><label for="st5" title="Sempurna"><i class="fas fa-star"></i></label>
                                <input type="radio" id="st4" name="rating" value="4"><label for="st4" title="Bagus"><i class="fas fa-star"></i></label>
                                <input type="radio" id="st3" name="rating" value="3"><label for="st3" title="Cukup"><i class="fas fa-star"></i></label>
                                <input type="radio" id="st2" name="rating" value="2"><label for="st2" title="Kurang"><i class="fas fa-star"></i></label>
                                <input type="radio" id="st1" name="rating" value="1"><label for="st1" title="Buruk"><i class="fas fa-star"></i></label>
                            </div>

                            <div class="form-group-review">
                                <textarea name="komentar" class="input-review-text" placeholder="Ceritakan pengalaman Anda di sini..." required></textarea>
                            </div>

                            <button type="submit" class="btn-submit-review">Kirim Ulasan</button>
                        </form>
                    <?php else: ?>
                        <div style="flex-grow: 1; display:flex; flex-direction:column; justify-content:center; align-items:center; color: #777;">
                            <i class="fas fa-lock" style="font-size: 3rem; margin-bottom: 20px; color:#eee;"></i>
                            <p>Silakan <a href="<?= base_url('auth/login') ?>" style="color: #3e2b26; font-weight:bold;">Login</a> untuk menulis ulasan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>

            <div class="filter-bar-flow">
                 <form action="" method="get">
                    <select name="sort" class="filter-select" onchange="this.form.submit()">
                        <option value="newest" <?= ($sort ?? '') == 'newest' ? 'selected' : '' ?>>✨ Paling Baru</option>
                        <option value="oldest" <?= ($sort ?? '') == 'oldest' ? 'selected' : '' ?>>📅 Paling Lama</option>
                        <option value="rating_high" <?= ($sort ?? '') == 'rating_high' ? 'selected' : '' ?>>⭐ Rating Tinggi</option>
                        <option value="rating_low" <?= ($sort ?? '') == 'rating_low' ? 'selected' : '' ?>>👎 Rating Rendah</option>
                    </select>
                </form>
            </div>

            <div class="review-cards-flow">
                <?php if (empty($reviews)): ?>
                    <div style="text-align: center; padding: 50px; background: #fff; border-radius: 15px; border:1px solid #f0f0f0; color:#999;">
                        <p>Belum ada ulasan.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($reviews as $row): ?>
                        <div class="review-card-item">
                            <div class="card-top">
                                <div class="user-profile">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['username']) ?>&background=random&color=fff&size=128" alt="User" class="avatar-img">
                                    <div class="user-names">
                                        <h5><?= !empty($row['username']) ? esc($row['username']) : 'User Terhapus' ?></h5>
                                        <span class="time-stamp"><?= date('d F Y', strtotime($row['created_at'])) ?></span>
                                    </div>
                                </div>
                                <div class="card-rating-static">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?= $i <= $row['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            
                            <div class="review-msg">
                                <?= nl2br(esc($row['komentar'])) ?>
                            </div>

                            <?php if (session()->get('logged_in') && (session()->get('id') == $row['user_id'] || session()->get('role') == 'admin')): ?>
                                <div class="card-actions">
                                    <a href="<?= base_url('about/review/delete/' . $row['id']) ?>" class="link-del" onclick="return confirm('Hapus ulasan ini?')">Hapus</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (isset($pager)): ?>
                    <div style="margin-top: 30px; display:flex; justify-content:center;">
                        <?= $pager->links() ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>