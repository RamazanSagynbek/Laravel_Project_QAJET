<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_is_displayed(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));
        $response->assertOk();
    }

    public function test_guest_cannot_create_product(): void
    {
        $response = $this->get(route('products.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_create_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->product()->create();

        $response = $this->actingAs($user)->post(route('products.store'), [
            'title' => 'MacBook',
            'description' => 'M2 chip',
            'price' => 500000,
            'condition' => 'new',
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['title' => 'MacBook']);
    }

    public function test_user_can_update_own_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('products.update', $product), [
            'title' => 'Updated MacBook',
            'description' => $product->description,
            'price' => $product->price,
            'condition' => $product->condition,
            'category_id' => $product->category_id,
        ]);

        $response->assertRedirect(route('products.show', $product));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'title' => 'Updated MacBook']);
    }

    public function test_user_cannot_update_others_product(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $other->id]);

        $response = $this->actingAs($user)->get(route('products.edit', $product));
        $response->assertForbidden();
    }

    public function test_admin_can_delete_any_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.products.delete', $product));
        $response->assertRedirect();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_product_filter_by_condition_works(): void
    {
        Product::factory()->create(['condition' => 'new', 'status' => 'active']);
        Product::factory()->create(['condition' => 'used', 'status' => 'active']);

        $response = $this->get(route('products.index', ['condition' => 'new']));
        $response->assertOk();
    }
}
