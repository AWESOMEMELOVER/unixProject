<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%bulletin_board}}',[
            'id'=> $this->primaryKey(11),
            'dormitory_id'=> $this->integer(11)->notNull(),
            'user_id'=> $this->integer(11)->notNull(),
            'timestamp'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'is_active'=> $this->smallInteger(1)->notNull(),
            'title'=> $this->string(255)->notNull(),
            'description'=> $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('dormitory_id','{{%bulletin_board}}',['dormitory_id'],false);
        $this->createIndex('user_id','{{%bulletin_board}}',['user_id'],false);

        $this->createTable('{{%dormitory}}',[
            'id'=> $this->primaryKey(11),
            'address'=> $this->string(255)->notNull(),
            'longitude'=> $this->string(10)->notNull(),
            'latitude'=> $this->string(10)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%faculty}}',[
            'id'=> $this->primaryKey(11),
            'title'=> $this->string(255)->notNull(),
            'contact_info'=> $this->text()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%history}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->notNull(),
            'timestamp'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'action'=> $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id','{{%history}}',['user_id'],false);

        $this->createTable('{{%news}}',[
            'id'=> $this->primaryKey(11),
            'dormitory_id'=> $this->integer(11)->null()->defaultValue(null),
            'timestamp'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'title'=> $this->string(255)->notNull(),
            'text'=> $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('dormitory_id','{{%news}}',['dormitory_id'],false);

        $this->createTable('{{%notification}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->notNull(),
            'timestamp'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'title'=> $this->string(255)->notNull(),
            'text'=> $this->text()->notNull(),
            'is_readed'=> $this->smallInteger(1)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('user_id','{{%notification}}',['user_id'],false);

        $this->createTable('{{%payment}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->notNull(),
            'is_privat'=> $this->smallInteger(1)->notNull(),
            'payed'=> $this->smallInteger(1)->null()->defaultValue(0),
            'room_request_id'=> $this->integer(11)->notNull(),
            'timestamp'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'paid_before'=> $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ], $tableOptions);

        $this->createIndex('user_id','{{%payment}}',['user_id','room_request_id'],false);
        $this->createIndex('room_request_id','{{%payment}}',['room_request_id'],false);

        $this->createTable('{{%room}}',[
            'id'=> $this->primaryKey(11),
            'dormitory_id'=> $this->integer(11)->notNull(),
            'number'=> $this->string(3)->notNull(),
            'floor'=> $this->integer(11)->notNull(),
            'places'=> $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('dormitory_id','{{%room}}',['dormitory_id'],false);

        $this->createTable('{{%room_request}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->notNull(),
            'privilege'=> $this->smallInteger(1)->notNull()->defaultValue(0),
            'room_id'=> $this->integer(11)->null()->defaultValue(null),
            'docs_received'=> $this->smallInteger(1)->notNull()->defaultValue(0),
            'entry_year'=> $this->date(4)->notNull(),
            'exclusion_year'=> $this->date(4)->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id','{{%room_request}}',['user_id','room_id'],false);
        $this->createIndex('room_id','{{%room_request}}',['room_id'],false);

        $this->createTable('{{%speciality}}',[
            'id'=> $this->primaryKey(11),
            'faculty_id'=> $this->integer(11)->notNull(),
            'title'=> $this->string(255)->notNull(),
            'is_master'=> $this->smallInteger(1)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('faculty_id','{{%speciality}}',['faculty_id'],false);

        $this->createTable('{{%study}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->notNull(),
            'speciality_id'=> $this->integer(11)->notNull(),
            'import_id'=> $this->integer(11)->notNull(),
            'entry_year'=> $this->date(4)->notNull(),
            'exclusion_year'=> $this->date(4)->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id','{{%study}}',['user_id'],false);
        $this->createIndex('speciality_id','{{%study}}',['speciality_id'],false);

        $this->createTable('{{%user}}',[
            'id'=> $this->primaryKey(11),
            'username'=> $this->string(255)->notNull(),
            'auth_key'=> $this->string(32)->notNull(),
            'password_hash'=> $this->string(255)->notNull(),
            'password_reset_token'=> $this->string(255)->null()->defaultValue(null),
            'email'=> $this->string(255)->notNull(),
            'status'=> $this->smallInteger(6)->notNull()->defaultValue(10),
            'is_active'=> $this->smallInteger(1)->defaultValue(0),
            'created_at'=> $this->integer(11)->notNull(),
            'updated_at'=> $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('email','{{%user}}',['email'],true);
        $this->createIndex('password_reset_token','{{%user}}',['password_reset_token'],true);
        $this->addForeignKey(
            'fk_bulletin_board_user_id',
            '{{%bulletin_board}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_bulletin_board_dormitory_id',
            '{{%bulletin_board}}', 'dormitory_id',
            '{{%dormitory}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_history_user_id',
            '{{%history}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_news_dormitory_id',
            '{{%news}}', 'dormitory_id',
            '{{%dormitory}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_notification_user_id',
            '{{%notification}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_payment_user_id',
            '{{%payment}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_payment_room_request_id',
            '{{%payment}}', 'room_request_id',
            '{{%room_request}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_room_dormitory_id',
            '{{%room}}', 'dormitory_id',
            '{{%dormitory}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_room_request_user_id',
            '{{%room_request}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_room_request_room_id',
            '{{%room_request}}', 'room_id',
            '{{%room}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_speciality_faculty_id',
            '{{%speciality}}', 'faculty_id',
            '{{%faculty}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_study_user_id',
            '{{%study}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_study_speciality_id',
            '{{%study}}', 'speciality_id',
            '{{%speciality}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
		$this->dropForeignKey('fk_bulletin_board_user_id', '{{%bulletin_board}}');
		$this->dropForeignKey('fk_bulletin_board_dormitory_id', '{{%bulletin_board}}');
		$this->dropForeignKey('fk_history_user_id', '{{%history}}');
		$this->dropForeignKey('fk_news_dormitory_id', '{{%news}}');
		$this->dropForeignKey('fk_notification_user_id', '{{%notification}}');
		$this->dropForeignKey('fk_payment_user_id', '{{%payment}}');
		$this->dropForeignKey('fk_payment_room_request_id', '{{%payment}}');
		$this->dropForeignKey('fk_room_dormitory_id', '{{%room}}');
		$this->dropForeignKey('fk_room_request_user_id', '{{%room_request}}');
		$this->dropForeignKey('fk_room_request_room_id', '{{%room_request}}');
		$this->dropForeignKey('fk_speciality_faculty_id', '{{%speciality}}');
		$this->dropForeignKey('fk_study_user_id', '{{%study}}');
		$this->dropForeignKey('fk_study_speciality_id', '{{%study}}');
		$this->dropTable('{{%bulletin_board}}');
		$this->dropTable('{{%dormitory}}');
		$this->dropTable('{{%faculty}}');
		$this->dropTable('{{%history}}');
		$this->dropTable('{{%news}}');
		$this->dropTable('{{%notification}}');
		$this->dropTable('{{%payment}}');
		$this->dropTable('{{%room}}');
		$this->dropTable('{{%room_request}}');
		$this->dropTable('{{%speciality}}');
		$this->dropTable('{{%study}}');
		$this->dropTable('{{%user}}');
    }
}
