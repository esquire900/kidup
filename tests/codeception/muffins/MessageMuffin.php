<?php
namespace codecept\muffins;

use Faker\Factory as Faker;

class MessageMuffin extends \message\models\message\Message
{

    public function definitions()
    {
        $faker = Faker::create();
        return [
            'conversation_id' => 'factory|'.ConversationMuffin::class,
            'message' => $faker->text(200),
            'sender_user_id' => 'factory|'.UserMuffin::class,
            'receiver_user_id' => 'factory|'.UserMuffin::class,
            'created_at' => $faker->dateTimeBetween('-20 days', '-5 days')->getTimestamp(),
            'updated_at' => $faker->dateTimeBetween('-5 days', '-2 days')->getTimestamp(),
        ];
    }

}
