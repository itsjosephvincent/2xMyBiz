<?php

namespace Database\Seeders;

use App\Models\AuditQuestion;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => '<p>Do you have an engaging and professional Facebook Cover photo?<br><span class="red-text">Size 851x315 pixels</span></p>'
            ],
            [
                'question' => '<p>Do you have a tagline or any demonstrated benefits on your cover photo?</p>'
            ],
            [
                'question' => '<p>Does your cover photo have a description with it (when you click on it) with a link to your website?</p>'
            ],
            [
                'question' => '<p>Do you have an interesting Profile photo that is clear and easy to see?<br><span class="red-text">Size 180x180 pixels</span></p>'
            ],
            [
                'question' => '<p>Is your Facebook About Short Description (the one that appears on your Facebook Timeline) clear and interesting?<br>Does it containt your web address?</p>'
            ],
            [
                'question' => '<p>Is your entire About section filled with the benefits of your business and good keywords?</p>'
            ],
            [
                'question' => '<p>Do you have Facebook Apps Installed?</p>'
            ],
            [
                'question' => '<p>Do you have a Facebook App installed that will collect e-mails of potential clients?<br>A lead generation tool?</p>'
            ],
            [
                'question' => '<p>If you have Facebook Apps installed do you have custom App covers to go along with the branding of your Page?</p>'
            ],
            [
                'question' => '<p>What is the current Facebook engagement of your Page (People Talking About This divided by total Fans)?<br>Is it over 2%?</p>'
            ],
            [
                'question' => '<p>Is your website easy to find on your Facebook Page?<br>Either in your short description or prominently featured in your About Page several times?</p>'
            ],
            [
                'question' => '<p>Are you posting at least once a day during the week?</p>'
            ],
            [
                'question' => '<p>Are people liking or commenting on your posts?</p>'
            ],
            [
                'question' => '<p>Are you asking questions in your posts to try and get engagement?</p>'
            ],
            [
                'question' => '<p>Are you varying your posts between Text, Photos, and Links?</p>'
            ],
            [
                'question' => '<p>Do you have unanswered posts or spam on your Timeline?</p>'
            ],
            [
                'question' => '<p>Are you sharing tips in your niche?<br>Are your posts benefiting your audiences?</p>'
            ],
            [
                'question' => '<p>Are you also sending traffic to your website several times a week?</p>'
            ],
            [
                'question' => '<p>Are you using your personal profile to post about your business?</p>'
            ],
            [
                'question' => '<p>Do you have your personal profile linked properly to your Facebook Page in your Work section?</p>'
            ],
            [
                'question' => '<p>Does your Page have a custom URL?</p>'
            ],
            [
                'question' => '<p>Are you regularly spending money on Facebook ads? At least once a month?</p>'
            ],
            [
                'question' => '<p>Do you have a link to your Facebook Page prominently located on your website?</p>'
            ],
        ];

        foreach ($questions as $question) {
            AuditQuestion::create([
                'question' => $question['question'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
