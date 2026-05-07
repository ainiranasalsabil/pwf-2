<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function update(User $user, Product $product): bool
    {
        // admin boleh semua
        // user hanya boleh edit miliknya sendiri
        return $user->role === 'admin' || $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        // sama seperti update
        return $user->role === 'admin' || $user->id === $product->user_id;
    }
}