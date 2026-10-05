<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicCatalogTest extends TestCase
{
    public function test_homepage_shows_read_only_craft_previews(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Contoh kerajinan')
            ->assertSee('Gelang Manik')
            ->assertSee('Hiasan Dinding Handmade')
            ->assertSee('Bucket Bunga Kertas')
            ->assertSee('Gantungan Kunci Manik')
            ->assertSee('Gantungan Kunci Rajut')
            ->assertSee('images/products/gelang-manik.png')
            ->assertSee('images/products/hiasan-dinding.jpg')
            ->assertSee('images/products/bucket-bunga-kertas.jpg')
            ->assertSee('images/products/gantungan-kunci-manik.png')
            ->assertSee('images/products/gantungan-kunci-rajut.png')
            ->assertDontSee('Tas Anyaman')
            ->assertSee('Fitur pembelian belum tersedia.')
            ->assertSee(route('login'))
            ->assertSee(route('register'))
            ->assertDontSee('Beli sekarang')
            ->assertDontSee('Tambah ke keranjang');
    }

    public function test_homepage_does_not_expose_purchase_routes(): void
    {
        $this->get('/cart')->assertNotFound();
        $this->get('/checkout')->assertNotFound();
    }
}
