<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m180308_131047_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_tag', [
            'id'            => $this->primaryKey(),
            'article_id'    => $this->integer(),
            'tag_id'        => $this->integer()
        ]);

        //    creates index for  column 'article_id'

        $this->createIndex(
            'tag-article-article_id',
            'article_tag',
            'article_id'
        );
        //   add foreign key for table'article_tag'
        $this->addForeignKey(
            'tag-article-article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        //    creates index for  column 'tag_id'

        $this->createIndex(
            'idx-tag_id',
            'article_tag',
            'tag_id'
        );
        //   add foreign key for table'article_tag'
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_tag');
    }
}
