<?php

use yii\db\Migration;

class m171028_085446_create_admin extends Migration
{
    const TABLE = '{{%admin}}';

    public function up()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->defaultValue(''),
            'auth_key' => $this->string(32)->notNull()->defaultValue(''),
            'password' => $this->string(255)->notNull()->defaultValue(''),
            'access_token' => $this->string(100)->notNull()->defaultValue(''),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
