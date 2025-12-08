<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php 
$avg_rating = $avg_rating ?? 0;
$sort = $sort ?? 'newest';
$reviews = $reviews ?? [];
?>

<link rel="stylesheet" href="<?= base_url('assets/css/review-ui.css') ?>">

<div class="review-page container">

  <!-- TOP BAR -->
  <div class="review-top">
    <div class="avg-box">
      <div class="avg-value"><?= esc($avg_rating) ?></div>
      <div class="avg-label">Rating rata-rata</div>
    </div>

    <div class="review-actions">
      <form method="get" class="sort-form">
        <select name="sort" onchange="this.form.submit()">
          <option value="newest" <?= ($sort=='newest')?'selected':'' ?>>Terbaru</option>
          <option value="rating_high" <?= ($sort=='rating_high')?'selected':'' ?>>Rating Tertinggi</option>
          <option value="rating_low" <?= ($sort=='rating_low')?'selected':'' ?>>Rating Terendah</option>
          <option value="oldest" <?= ($sort=='oldest')?'selected':'' ?>>Terlama</option>
        </select>
      </form>
    </div>
  </div>

  <hr>

  <h3>Tulis Review</h3>

  <!-- ALERT -->
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert error"><?= esc(session()->getFlashdata('error')) ?></div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert success"><?= esc(session()->getFlashdata('success')) ?></div>
  <?php endif; ?>

  <!-- FORM REVIEW -->
  <?php if (session()->get('logged_in')): ?>
    <form action="<?= base_url('about/review/add') ?>" method="post" class="review-form">

      <label>Pilih Rating</label>
      <div class="stars-input">
        <?php for ($i=1;$i<=5;$i++): ?>
          <span class="star" data-value="<?= $i ?>">☆</span>
        <?php endfor; ?>
      </div>
      <input type="hidden" name="rating" id="ratingInput" required>

      <label>Komentar</label>
      <textarea name="komentar" rows="4" required><?= old('komentar') ?></textarea>

      <div class="form-actions">
        <button type="submit" class="btn-primary">Kirim Review</button>
      </div>

    </form>

  <?php else: ?>
    <p>Silakan <a href="<?= base_url('auth/login') ?>">login</a> untuk menulis review.</p>
  <?php endif; ?>

  <hr>

  <h3>Semua Review</h3>

  <!-- LIST REVIEW -->
  <?php if (!empty($reviews)): ?>
    <?php foreach ($reviews as $r): ?>

      <article class="review-card">

        <div class="avatar">
          <img src="<?= base_url('uploads/default.png') ?>" alt="avatar">
        </div>

        <div class="body">

          <!-- META -->
          <div class="meta">
            <strong><?= esc($r['username']) ?></strong>
            <time><?= esc(date('d M Y H:i', strtotime($r['created_at']))) ?></time>
          </div>

          <!-- STAR -->
          <div class="rating">
            <?php for ($i=1;$i<=5;$i++): ?>
              <span class="<?= $i <= $r['rating'] ? 'star-on' : 'star-off' ?>">★</span>
            <?php endfor; ?>
          </div>

          <!-- KOMENTAR -->
          <p class="komentar"><?= esc($r['komentar']) ?></p>

          <!-- ACTIONS -->
          <div class="card-actions">
            <?php if (session()->get('username') === $r['username']): ?>
              <a class="link-edit" href="<?= base_url('about/review/edit/'.$r['id']) ?>">Edit</a>
              <a class="link-delete" href="<?= base_url('about/review/delete/'.$r['id']) ?>"
                 onclick="return confirm('Hapus review?')">
                Hapus
              </a>
            <?php endif; ?>
          </div>

        </div>
      </article>

    <?php endforeach; ?>

    <!-- PAGINATION -->
    <div class="pager">
      <?= isset($pager) ? $pager->links() : '' ?>
    </div>

  <?php else: ?>
    <p>Belum ada review.</p>
  <?php endif; ?>

</div>

<!-- SCRIPT RATING -->
<script>
  document.querySelectorAll('.stars-input .star').forEach(star => {
    star.addEventListener('mouseenter', function(){
      highlight(this.dataset.value);
    });

    star.addEventListener('click', function(){
      document.getElementById('ratingInput').value = this.dataset.value;
      highlight(this.dataset.value);
    });

    star.addEventListener('mouseleave', function(){
      const current = document.getElementById('ratingInput').value || 0;
      highlight(current);
    });
  });

  function highlight(n){
    document.querySelectorAll('.stars-input .star').forEach(s => {
      s.textContent = (s.dataset.value <= n) ? '★' : '☆';
    });
  }
</script>

<?= $this->endSection() ?>
