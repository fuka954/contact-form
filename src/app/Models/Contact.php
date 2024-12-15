<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $filters)
    {
        if (!empty($filters['seach-text'])) {
            $query->where(function($q) use ($filters) {
                $q->where('first_name', 'like', '%' . $filters['seach-text'] . '%')
                ->orWhere('last_name', 'like', '%' . $filters['seach-text'] . '%')
                ->orWhere('email', 'like', '%' . $filters['seach-text'] . '%');
            });
        }
        if (!empty($filters['gender']) && $filters['gender'] != '') {
            $query->where('gender', $filters['gender']);
        }
        if (!empty($filters['inquiry_type'])) {
            $query->where('category_id', $filters['inquiry_type']);
        }
        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        return $query;
    }





}
