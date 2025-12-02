<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
  <h2>Edit Review</h2>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert error"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form action="<?= base_url('about/review/update/'.$review['id']) ?>" method="post" class="review-form">
    <label>Rating</label>
    <select name="rating" required>
      <?php for ($i=1;$i<=5;$i++): ?>
        <option value="<?= $i ?>" <?= ($review['rating']==$i)?'selected':'' ?>><?= $i ?> ★</option>
      <?php endfor; ?>
    </select>

    <label>Komentar</label>
    <textarea name="komentar" rows="4" required><?= esc($review['komentar']) ?></textarea>

    <div class="form-actions">
      <button type="submit" class="btn-primary">Update</button>
      <a href="<?= base_url('about/review') ?>" class="btn-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
