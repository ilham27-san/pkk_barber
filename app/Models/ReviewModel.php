<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'rating', 'komentar'];
    protected $useTimestamps    = true;

    public function getReviews($sort = 'newest')
    {
        // Ubah join biasa menjadi 'left'
        // Artinya: "Ambil Review, kalau data user-nya ada, bawa sekalian. Kalau gak ada, biarin NULL, jangan dibuang review-nya."

        $builder = $this->select('reviews.*, users.username, users.foto')
            ->join('users', 'users.id = reviews.user_id', 'left'); // <--- TAMBAHKAN 'left'

        // Logika Sortir (Tetap sama)
        if ($sort == 'rating_high') $builder->orderBy('reviews.rating', 'DESC');
        else if ($sort == 'rating_low') $builder->orderBy('reviews.rating', 'ASC');
        else if ($sort == 'oldest') $builder->orderBy('reviews.created_at', 'ASC');
        else $builder->orderBy('reviews.created_at', 'DESC');

        return $builder->findAll();
    }

    public function getAvgRating()
    {
        return $this->selectAvg('rating')->get()->getRow()->rating ?? 0;
    }
}
