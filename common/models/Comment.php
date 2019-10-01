<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Comment".
 *
 * @property int $id
 * @property int $friendcir_id
 * @property int $content
 * @property int $create_time
 * @property int $user_id
 *
 * @property Friend $friendcir
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['friendcir_id', 'content', 'create_time', 'user_id'], 'integer'],
            [['friendcir_id'], 'exist', 'skipOnError' => true, 'targetClass' => Friend::className(), 'targetAttribute' => ['friendcir_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'friendcir_id' => 'Friendcir ID',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriendcir()
    {
        return $this->hasOne(Friend::className(), ['id' => 'friendcir_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
