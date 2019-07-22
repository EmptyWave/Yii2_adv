<?php

use yii\db\Migration;

/**
 *
 */
class m190618_144630_add_create_columns_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'create_time', $this->dateTime());
        $this->addColumn('task', 'update_time', $this->dateTime());
        $this->addColumn('task_comments', 'create_time', $this->dateTime());
        $this->addColumn('task_comments', 'update_time', $this->dateTime());
        $this->addColumn('task_attachments', 'create_time', $this->dateTime());
        $this->addColumn('task_attachments', 'update_time', $this->dateTime());
        $this->addColumn('users', 'create_time', $this->dateTime());
        $this->addColumn('users', 'update_time', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'create_time');
        $this->dropColumn('task', 'update_time');
        $this->dropColumn('task_comments', 'create_time');
        $this->dropColumn('task_comments', 'update_time');
        $this->dropColumn('task_attachments', 'create_time');
        $this->dropColumn('task_attachments', 'update_time');
        $this->dropColumn('users', 'create_time');
        $this->dropColumn('users', 'update_time');
    }
}
