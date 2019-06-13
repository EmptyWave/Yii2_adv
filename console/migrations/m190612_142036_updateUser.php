<?php

use yii\db\Migration;

/**
 * Class m190612_142036_updateUser
 */
class m190612_142036_updateUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn(\common\models\User::tableName(), 'phone', $this->string(16)->notNull());

      $this->insert(\common\models\User::tableName(), [
        'id' => 1,
        'username' => 'admin',
        'auth_key' => \Yii::$app->security->generateRandomString(),
        'password_hash' => \Yii::$app->security->generatePasswordHash('admin'),
        'email' => 'admin@gmail.com',
        'phone' => '+7(999)999-99-99',
        'status' => 10,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      $this->insert(\common\models\User::tableName(), [
        'id' => 2,
        'username' => 'demo',
        'auth_key' => \Yii::$app->security->generateRandomString(),
        'password_hash' => \Yii::$app->security->generatePasswordHash('demo'),
        'email' => 'demo@gmail.com',
        'phone' => '+7(999)999-99-98',
        'status' => 10,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_142036_updateUser cannot be reverted.\n";

        return false;
    }
    */
}
