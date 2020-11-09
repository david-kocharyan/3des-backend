<?php

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq = array(
            [
                'id' => 1,
                'question' => 'What type of picture can fit in the frame?',
                'answer' => 'The frame is made for Instax mini picture, but can also fit all other mini printer pictures.',
            ],
            [
                'id' => 2,
                'question' => 'Can I hang the frame on a wall ?	',
                'answer' => 'All our frames have a magnet on the back perfect to help your memories stick around.',
            ],
            [
                'id' => 3,
                'question' => 'Can we further customize the look of the frame?',
                'answer' => 'Yes, contact us through our website and one of our designers will reach out.',
            ],
            [
                'id' => 4,
                'question' => 'What is the frame made of?',
                'answer' => 'We love our planet, it’s the only one we have! So we use Environmentally friendly biodegradable and recyclable material to make our frames for your timeless moments.',
            ],
            [
                'id' => 5,
                'question' => 'How can I use the frame If I don’t have an instant photo camera?',
                'answer' => 'Being creative is the best, so if you don’t have the camera or a mini photo printer, take a regular photo, and then crop it following the measurements of the frame and slide it in. And if you have a special event, we offer our camera rental services with films, just contact us for more details.',
            ],
            [
                'id' => 6,
                'question' => 'Can I provide my own logo or artwork to go on my frame?',
                'answer' => 'Yes you can, contact us and one of our designers will assist you.',
            ],
            [
                'id' => 7,
                'question' => 'Do you ship internationally ?',
                'answer' => 'Yes we do although extra shipping and customs charges may apply.',
            ]
        );
        Faq::insert($faq);
    }
}
