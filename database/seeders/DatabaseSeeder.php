<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Listing;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@qajet.kz',
            'university' => 'KBTU',
            'role' => 'admin',
        ]);

        $user1 = User::factory()->create([
            'name' => 'Aibek Nurlan',
            'email' => 'aibek@qajet.kz',
            'university' => 'KBTU',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Dana Askar',
            'email' => 'dana@qajet.kz',
            'university' => 'SDU',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Marat Bekov',
            'email' => 'marat@qajet.kz',
            'university' => 'KBTU',
        ]);

        // Product categories
        $electronics = Category::create(['name' => 'Electronics', 'slug' => 'electronics', 'type' => 'product']);
        $books = Category::create(['name' => 'Books', 'slug' => 'books', 'type' => 'product']);
        $instruments = Category::create(['name' => 'Musical Instruments', 'slug' => 'instruments', 'type' => 'product']);
        $clothing = Category::create(['name' => 'Clothing', 'slug' => 'clothing', 'type' => 'product']);
        $other = Category::create(['name' => 'Other', 'slug' => 'other-product', 'type' => 'product']);

        // Service categories
        $academic = Category::create(['name' => 'Academic Help', 'slug' => 'academic', 'type' => 'service']);
        $design = Category::create(['name' => 'Design', 'slug' => 'design', 'type' => 'service']);
        $programming = Category::create(['name' => 'Programming', 'slug' => 'programming', 'type' => 'service']);
        $tutoring = Category::create(['name' => 'Tutoring', 'slug' => 'tutoring', 'type' => 'service']);

        // Listings (Roommates)
        Listing::create([
            'user_id' => $user1->id,
            'title' => 'Room in 3-bedroom apartment near KBTU',
            'description' => 'Looking for a roommate to share a spacious 3-bedroom apartment. 5 min walk from KBTU. All utilities included. Furnished room with bed, desk, and wardrobe.',
            'price' => 120000,
            'address' => 'Tole Bi 59',
            'city' => 'Almaty',
            'rooms' => 3,
            'roommates_needed' => 1,
            'type' => 'offering_room',
        ]);

        Listing::create([
            'user_id' => $user2->id,
            'title' => 'Looking for a room near SDU',
            'description' => 'Female student looking for a room near SDU campus. Budget up to 100k. Prefer quiet neighbors, non-smokers.',
            'price' => 100000,
            'address' => 'Abay Ave',
            'city' => 'Almaty',
            'rooms' => 1,
            'roommates_needed' => 1,
            'type' => 'looking_for_room',
        ]);

        Listing::create([
            'user_id' => $user3->id,
            'title' => '2 rooms available in new building',
            'description' => 'Brand new apartment, 2 rooms available. Modern kitchen, fast internet, washing machine. 10 min to KBTU by bus.',
            'price' => 95000,
            'address' => 'Nazarbayev Ave 120',
            'city' => 'Almaty',
            'rooms' => 4,
            'roommates_needed' => 2,
            'type' => 'offering_room',
        ]);

        // Products (Marketplace)
        Product::create([
            'user_id' => $user1->id,
            'category_id' => $electronics->id,
            'title' => 'MacBook Air M2 2023',
            'description' => 'Used for 1 year, perfect condition. 8GB RAM, 256GB SSD. Comes with charger and original box.',
            'price' => 450000,
            'condition' => 'like_new',
        ]);

        Product::create([
            'user_id' => $user2->id,
            'category_id' => $instruments->id,
            'title' => 'Yamaha Acoustic Guitar F310',
            'description' => 'Great guitar for beginners. Some minor scratches but plays perfectly. Includes gig bag and picks.',
            'price' => 45000,
            'condition' => 'used',
        ]);

        Product::create([
            'user_id' => $user3->id,
            'category_id' => $books->id,
            'title' => 'Clean Code by Robert Martin',
            'description' => 'Classic programming book. Paperback, good condition. A must-read for every developer.',
            'price' => 5000,
            'condition' => 'used',
        ]);

        Product::create([
            'user_id' => $user1->id,
            'category_id' => $electronics->id,
            'title' => 'Samsung Monitor 27" 144Hz',
            'description' => 'Gaming monitor, 27 inches, 144Hz refresh rate. Selling because I upgraded to ultrawide.',
            'price' => 85000,
            'condition' => 'like_new',
        ]);

        // Services
        Service::create([
            'user_id' => $user2->id,
            'category_id' => $academic->id,
            'title' => 'Presentation Design & Preparation',
            'description' => 'I will create professional PowerPoint/Google Slides presentations for your university projects. Includes design, content structuring, and speaker notes.',
            'price' => 5000,
            'price_type' => 'fixed',
        ]);

        Service::create([
            'user_id' => $user3->id,
            'category_id' => $programming->id,
            'title' => 'Python & Java Tutoring',
            'description' => 'CS student with 3 years of experience. I can help with assignments, projects, and exam preparation in Python, Java, and data structures.',
            'price' => 3000,
            'price_type' => 'hourly',
        ]);

        Service::create([
            'user_id' => $user1->id,
            'category_id' => $design->id,
            'title' => 'Logo & Banner Design',
            'description' => 'Freelance designer offering logo creation, social media banners, and poster design for student organizations and events.',
            'price' => 10000,
            'price_type' => 'negotiable',
        ]);

        // University Community Chats
        $universities = [
            ['name' => 'KBTU', 'full' => 'Kazakh-British Technical University'],
            ['name' => 'SDU', 'full' => 'Suleyman Demirel University'],
            ['name' => 'KazNU', 'full' => 'Al-Farabi Kazakh National University'],
            ['name' => 'KazGASA', 'full' => 'Kazakh Leading Academy of Architecture'],
            ['name' => 'Satbayev University', 'full' => 'Satbayev University'],
            ['name' => 'Abai University', 'full' => 'Abai Kazakh National Pedagogical University'],
            ['name' => 'KIMEP', 'full' => 'KIMEP University'],
            ['name' => 'Narxoz', 'full' => 'Narxoz University'],
            ['name' => 'AITU', 'full' => 'Astana IT University'],
            ['name' => 'ENU', 'full' => 'L.N. Gumilyov Eurasian National University'],
        ];

        foreach ($universities as $uni) {
            Chat::create([
                'name' => $uni['name'],
                'type' => 'group',
                'university' => $uni['full'],
            ]);
        }
    }
}
