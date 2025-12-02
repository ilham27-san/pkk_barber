<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Layanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
        }

        select,
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        button {
            width: 100%;
            background: #007bff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #005fcc;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Form Booking</h2>

        <form method="post" action="/booking/submit">

            <!-- Dropdown layanan -->
            <label for="id_layanan">Pilih Layanan</label>
            <select id="id_layanan" name="id_layanan" required>
                <option value="">-- Pilih Layanan --</option>

                <?php foreach ($layanan as $l): ?>
                    <option value="<?= $l['id']; ?>">
                        <?= esc($l['nama_layanan']); ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jam">Jam</label>
            <input type="time" id="jam" name="jam" required>

            <button type="submit">Kirim Booking</button>
        </form>
    </div>

</body>
</html>
