<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table      = 'reviews';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'rating',
        'komentar',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $returnType = 'array';

    // Ambil semua review dengan data user
    public function getReviewsWithUser($sort = 'newest')
{
    $builder = $this->select('reviews.*, users.username')
        ->join('users', 'users.id = reviews.user_id', 'left');

    // Sort
    switch ($sort) {
        case 'rating_high':
            $builder->orderBy('reviews.rating', 'DESC');
            break;

        case 'rating_low':
            $builder->orderBy('reviews.rating', 'ASC');
            break;

        case 'oldest':
            $builder->orderBy('reviews.created_at', 'ASC');
            break;

        default:
            $builder->orderBy('reviews.created_at', 'DESC'); // newest
    }

    return $builder->findAll();
}


    // Ambil review berdasarkan user
    public function getReviewByUser($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }
}
