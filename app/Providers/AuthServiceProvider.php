<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate; // digunakan untuk membuat gate

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapping policy ke model
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        // Model Product akan menggunakan ProductPolicy
    ];

    /**
     * Register authentication / authorization
     */
    public function boot(): void
    {
        // Mendaftarkan semua policy yang ada di atas
        $this->registerPolicies();

        /**
         * GATE UNTUK CATEGORY
         * Digunakan untuk membatasi akses kategori hanya untuk admin
         */
        Gate::define('manage-category', function ($user) {

            // Mengecek apakah user memiliki role admin
            return $user->role === 'admin';

            // Jika admin → akses diizinkan
            // Jika bukan admin → akses ditolak

        });
    }
}