<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimony;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the Admin User using your custom Seeder
        $this->call([
            AdminUserSeeder::class,
        ]);

        // 2. Use updateOrCreate to prevent "Email already exists" errors
        User::updateOrCreate(
            ['email' => 'test@example.com'], // The unique identifier
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Seed the Testimony data
        $this->seedTestimonies();
    }

    /**
     * Seed initial content for the Miracles Gallery
     */
    private function seedTestimonies(): void
    {
        $testimonies = [
            [
                'name' => 'Kemi',
                'group' => 'HEALED FROM MULTIPLE MYELOMA',
                'content' => 'In 2019, she was diagnosed with multiple myeloma... Today, she is free, a living testimony of God’s unfailing love.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/new-test_601699fe3ccc7b0007cbc451.mp4',
                'is_approved' => true,
            ],
            [
                'name' => 'Precious',
                'group' => 'From Struggeling Sales To Overflowing Orders',
                'content' => 'After struggling for two months with unsold food... Sister Precious attended the "A Day of Blessing" and she prayed specifically for her business.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/SPMOSHT_539587ca73312e4421140000.mp4',
                'is_approved' => true,
            ],
            [
                'name' => 'Oluwaseun',
                'group' => 'From Bullet Wounds To Bold Steps',
                'content' => 'After sustaining a life-altering gunshot wound to his leg, doctors told Oluwaseun he would never walk again. Defying all medical expectations, he experienced a complete recovery.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/OLUTEST_539587ca73312e4421140000.mp4',
                'is_approved' => true,
            ],
            [
                'name' => 'Esther',
                'group' => 'Healed from Severe Headache and Toothache',
                'content' => 'For over a month, I suffered from severe headaches and unbearable toothaches... Now I’m pain-free. Glory be to God!',
                'video_url' => null,
                'is_approved' => true,
            ],
            [
                'name' => 'Aaron',
                'group' => 'Healed From 10 years Of Chest Pain',
                'content' => 'During ‘A day of blessings’, God healed me from severe chest pains I had endured for over 10 years. I am now completely healed!',
                'video_url' => null,
                'is_approved' => true,
            ],
        ];

        foreach ($testimonies as $data) {
            // Use updateOrCreate on 'content' or 'name' to prevent duplicates
            Testimony::updateOrCreate(
                ['content' => $data['content']],
                $data
            );
        }
    }
}
