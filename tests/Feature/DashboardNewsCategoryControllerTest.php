<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardNewsCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        // Buat pengguna dummy
        $user = User::factory()->create();

        // Autentikasi pengguna
        $this->actingAs($user);

        // Buat kategori dengan tipe 'news'
        Category::create(['title' => 'News Category 1', 'slug' => 'news-category-1', 'type' => 'news']);
        Category::create(['title' => 'News Category 2', 'slug' => 'news-category-2', 'type' => 'news']);
        Category::create(['title' => 'News Category 3', 'slug' => 'news-category-3', 'type' => 'news']);

        // Panggil rute index
        $response = $this->get(route('newsCategories.index'));

        // Asser bahwa respons berhasil
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.news-categories.index');
        $response->assertViewHas('news_categories');
    }
}
