<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
  /* Container Utama */
  .review-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  /* Header Section */
  .review-header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 20px;
  }

  .rating-summary h2 {
    margin: 0;
    font-size: 2.5rem;
    color: #2c3e50;
  }

  .rating-summary span {
    color: #7f8c8d;
    font-size: 0.9rem;
  }

  .star-gold {
    color: #f1c40f;
  }

  .star-gray {
    color: #bdc3c7;
  }

  /* Filter Form */
  .filter-group select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
  }

  /* Form Input Review */
  .review-form-card {
    background: #ffffff;
    border: 1px solid #e1e4e8;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
  }

  .review-form-card h3 {
    margin-top: 0;
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .radio-group {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
  }

  .radio-option {
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
  }

  textarea.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
    font-family: inherit;
    box-sizing: border-box;
  }

  .btn-submit {
    background-color: #2c3e50;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    margin-top: 15px;
    transition: background 0.3s;
  }

  .btn-submit:hover {
    background-color: #34495e;
  }

  /* Alert Boxes */
  .alert {
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-weight: 500;
  }

  .alert-error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
  }

  .alert-success {
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
  }

  /* Review Cards (List) */
  .review-list {
    display: grid;
    gap: 20px;
  }

  .review-card {
    background: white;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 20px;
    transition: transform 0.2s;
  }

  .review-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  }

  .card-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .avatar-circle {
    width: 45px;
    height: 45px;
    background-color: #e2e8f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .avatar-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .user-details h4 {
    margin: 0;
    font-size: 1rem;
    color: #2d3748;
  }

  .user-details span {
    font-size: 0.8rem;
    color: #a0aec0;
  }

  .review-body {
    color: #4a5568;
    line-height: 1.6;
  }

  .btn-delete {
    color: #e53e3e;
    font-size: 0.85rem;
    text-decoration: none;
    border: 1px solid #e53e3e;
    padding: 4px 10px;
    border-radius: 4px;
    transition: all 0.2s;
  }

  .btn-delete:hover {
    background: #e53e3e;
    color: white;
  }

  .empty-state {
    text-align: center;
    padding: 40px;
    color: #a0aec0;
  }
</style>


<div class="review-container">

  <div class="review-header-section">
    <div class="rating-summary">
      <h2><?= number_format($avg_rating ?? 0, 1) ?> <span style="font-size: 1.5rem; color:#f1c40f;">★</span></h2>
      <span>Dari total <?= count($reviews ?? []) ?> ulasan</span>
    </div>

    <div class="filter-group">
      <form action="" method="get">
        <label for="sort" style="margin-right: 10px; font-weight: 600;">Urutkan:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
          <option value="newest" <?= ($sort ?? '') == 'newest' ? 'selected' : '' ?>>Paling Baru</option>
          <option value="oldest" <?= ($sort ?? '') == 'oldest' ? 'selected' : '' ?>>Paling Lama</option>
          <option value="rating_high" <?= ($sort ?? '') == 'rating_high' ? 'selected' : '' ?>>Bintang 5 - 1</option>
          <option value="rating_low" <?= ($sort ?? '') == 'rating_low' ? 'selected' : '' ?>>Bintang 1 - 5</option>
        </select>
      </form>
    </div>
  </div>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error">⚠️ <?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>


  <?php if (session()->get('logged_in')): ?>
    <div class="review-form-card">
      <h3>Tulis Pengalaman Anda</h3>
      <form action="<?= base_url('about/review/add') ?>" method="post">
        <?= csrf_field() ?>

        <div style="margin-bottom: 15px;">
          <label style="display:block; margin-bottom:8px; font-weight:600;">Berikan Rating:</label>
          <div class="radio-group">
            <label class="radio-option"><input type="radio" name="rating" value="5" required> ⭐ 5 (Sempurna)</label>
            <label class="radio-option"><input type="radio" name="rating" value="4"> ⭐ 4 (Bagus)</label>
            <label class="radio-option"><input type="radio" name="rating" value="3"> ⭐ 3 (Cukup)</label>
            <label class="radio-option"><input type="radio" name="rating" value="2"> ⭐ 2 (Kurang)</label>
            <label class="radio-option"><input type="radio" name="rating" value="1"> ⭐ 1 (Buruk)</label>
          </div>
        </div>

        <div style="margin-bottom: 15px;">
          <label style="display:block; margin-bottom:8px; font-weight:600;">Komentar:</label>
          <textarea name="komentar" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda..." required><?= old('komentar') ?></textarea>
        </div>

        <button type="submit" class="btn-submit">Kirim Ulasan</button>
      </form>
    </div>
  <?php else: ?>
    <div class="alert" style="background: #eef2f6; text-align: center;">
      Ingin menulis ulasan? Silakan <a href="<?= base_url('auth/login') ?>" style="color: #2c3e50; font-weight: bold;">Login di sini</a>.
    </div>
  <?php endif; ?>


  <h3 style="margin-bottom: 20px; border-left: 5px solid #2c3e50; padding-left: 15px;">Ulasan Terbaru</h3>

  <div class="review-list">
    <?php if (empty($reviews)): ?>
      <div class="empty-state">
        <p>Belum ada ulasan saat ini. Jadilah yang pertama memberikan review!</p>
      </div>
    <?php else: ?>
      <?php foreach ($reviews as $row): ?>
        <article class="review-card">
          <div class="card-top">
            <div class="user-info">
              <div class="avatar-circle">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['username']) ?>&background=random&color=fff" alt="Avatar">
              </div>
              <div class="user-details">
                <h4><?= !empty($row['username']) ? esc($row['username']) : '<em>User Terhapus</em>' ?></h4>
                <span><?= date('d M Y, H:i', strtotime($row['created_at'])) ?> WIB</span>
              </div>
            </div>

            <div class="stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="<?= $i <= $row['rating'] ? 'star-gold' : 'star-gray' ?>">★</span>
              <?php endfor; ?>
            </div>
          </div>

          <div class="review-body">
            <p><?= nl2br(esc($row['komentar'])) ?></p>
          </div>

          <?php
          // Cek Logika Akses
          $isLogin = session()->get('logged_in');
          $isOwner = session()->get('id') == $row['user_id'];
          $isAdmin = session()->get('role') == 'admin'; // Pastikan session role diset saat login
          ?>

          <?php if ($isLogin && ($isOwner || $isAdmin)): ?>
            <div style="margin-top: 15px; text-align: right;">
              <a href="<?= base_url('about/review/delete/' . $row['id']) ?>"
                class="btn-delete"
                onclick="return confirm('Yakin ingin menghapus ulasan ini secara permanen?')">
                Hapus Ulasan
              </a>
            </div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <?php if (isset($pager)): ?>
    <div style="margin-top: 30px;">
      <?= $pager->links() ?>
    </div>
  <?php endif; ?>

</div>

<?= $this->endSection() ?>