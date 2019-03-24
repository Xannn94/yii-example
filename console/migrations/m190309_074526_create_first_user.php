<?php

use yii\db\Migration;

/**
 * Class m190309_074526_create_first_user
 */
class m190309_074526_create_first_user extends Migration
{
    private $table = '{{%user}}';
    private $userData = [
        'username'             => 'alex_khan',
        'auth_key'             => 'HP187Mvq7Mmm3CTU80dLkGmni_FUH_lR',
        //password_0
        'password_hash'        => '$2y$13$EjaPFBnZOQsHdGuHI.xvhuDp1fHpo8hKRSk6yshqa9c5EG8s3C3lO',
        'password_reset_token' => 'ExzkCOaYc1L8IOBs4wdTGGbgNiG3Wz1I_1402312317',
        'created_at'           => '1402312317',
        'updated_at'           => '1402312317',
        'email'                => 'xannn94@yandex.com',
    ];

    public function up()
    {
        $this->insert($this->table, $this->userData);
    }

    public function down()
    {
        $this->delete($this->table,['=','email',$this->userData['email']]);
    }
}
