<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimony;

class TestimonySeeder extends Seeder
{
    public function run()
    {
        // Video Testimonies
        $videos = [
            [
                'name' => 'Kemi',
                'group' => 'HEALED FROM MULTIPLE MYELOMA',
                'content' => 'In 2019, she was diagnosed with multiple myeloma, a rare and aggressive cancer of the bone marrow, with little hope from doctors. But when the woman of God prayed, the power of God healed her completely. Today, she is free, no disease, no symptoms, no fear, a living testimony of God’s unfailing love.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/new-test_601699fe3ccc7b0007cbc451.mp4',
                'is_approved' => true,
            ],
            [
                'name' => 'Precious',
                'group' => 'From Struggeling Sales To Overflowing Orders',
                'content' => 'After struggling for two months with unsold food at her new restaurant, Sister Precious attended the "A Day of Blessing" and she prayed specifically for her business. Following the event, her business saw an immediate turnaround, resulting in her selling out of food every single day for an entire week.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/SPMOSHT_539587ca73312e4421140000.mp4',
                'is_approved' => true,
            ],
            [
                'name' => 'Oluwaseun',
                'group' => 'From Bullet Wounds To Bold Steps',
                'content' => 'After sustaining a life-altering gunshot wound to his leg, doctors told Oluwaseun he would never walk again. However, his story took a miraculous turn after attending "A Day of Blessings" with Pastor Deola Phillips. Defying all medical expectations, he experienced a complete recovery and now stands as a living testimony.',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/OLUTEST_539587ca73312e4421140000.mp4',
                'is_approved' => true,
            ],
        ];

        // Written Testimonies
        $texts = [
            [
                'name' => 'Esther',
                'group' => 'Healed from Severe Headache and Toothache',
                'content' => 'For over a month, I suffered from severe headaches and unbearable toothaches. When our esteemed pastor prayed for us during the program, I received immediate healing. The headache and toothache completely disappeared!',
                'video_url' => null,
                'is_approved' => true,
            ],
            [
                'name' => 'Aaron',
                'group' => 'Healed From 10 years Of Chest Pain',
                'content' => 'During ‘A day of blessings’, God healed me from severe chest pains I had endured for over 10 years. His grace and kindness are truly indescribable. I am now completely healed!',
                'video_url' => null,
                'is_approved' => true,
            ],
        ];

        foreach (array_merge($videos, $texts) as $testimony) {
            Testimony::create($testimony);
        }
    }
}
