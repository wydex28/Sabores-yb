<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function icons()
    {
        $icons = [
            'Comida y Bebidas' => [
                'fas fa-hamburger', 'fas fa-pizza-slice', 'fas fa-hotdog', 'fas fa-taco', 'fas fa-sandwich',
                'fas fa-cheese', 'fas fa-egg', 'fas fa-bacon', 'fas fa-bone', 'fas fa-drumstick-bite',
                'fas fa-ice-cream', 'fas fa-cookie', 'fas fa-candy-cane', 'fas fa-donut', 'fas fa-bread-slice',
                'fas fa-apple-alt', 'fas fa-carrot', 'fas fa-pepper-hot', 'fas fa-seedling', 'fas fa-bowl-food',
                'fas fa-utensils', 'fas fa-mug-hot', 'fas fa-coffee', 'fas fa-glass-water', 'fas fa-glass-cheers',
                'fas fa-wine-glass', 'fas fa-beer-mug-empty', 'fas fa-cocktail'
            ],
            'Comercio y Tienda' => [
                'fas fa-shopping-cart', 'fas fa-shopping-basket', 'fas fa-store', 'fas fa-shop', 'fas fa-bag-shopping',
                'fas fa-tag', 'fas fa-tags', 'fas fa-ticket-alt', 'fas fa-credit-card', 'fas fa-wallet',
                'fas fa-money-bill-wave', 'fas fa-cash-register', 'fas fa-truck', 'fas fa-truck-fast', 'fas fa-box',
                'fas fa-boxes-stacked', 'fas fa-gift'
            ],
            'Interfaz y Navegación' => [
                'fas fa-home', 'fas fa-user', 'fas fa-users', 'fas fa-cog', 'fas fa-cogs',
                'fas fa-search', 'fas fa-bell', 'fas fa-envelope', 'fas fa-calendar-alt', 'fas fa-star',
                'fas fa-heart', 'fas fa-thumbs-up', 'fas fa-check-circle', 'fas fa-exclamation-triangle',
                'fas fa-info-circle', 'fas fa-question-circle', 'fas fa-trash-alt', 'fas fa-edit',
                'fas fa-plus', 'fas fa-minus', 'fas fa-arrow-right', 'fas fa-arrow-left', 'fas fa-chevron-right',
                'fas fa-chevron-left', 'fas fa-bars', 'fas fa-times', 'fas fa-eye', 'fas fa-eye-slash'
            ],
            'Ubicación y Tiempo' => [
                'fas fa-map-marker-alt', 'fas fa-location-dot', 'fas fa-compass', 'fas fa-globe', 'fas fa-clock',
                'fas fa-hourglass-half', 'fas fa-stopwatch'
            ],
            'Herramientas y Otros' => [
                'fas fa-hammer', 'fas fa-wrench', 'fas fa-screwdriver-wrench', 'fas fa-palette', 'fas fa-brush',
                'fas fa-camera', 'fas fa-video', 'fas fa-microphone', 'fas fa-mobile-alt', 'fas fa-laptop'
            ]
        ];

        return view('admin.library.icons', compact('icons'));
    }
}
