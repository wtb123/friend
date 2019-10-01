<?php

namespace common\models;

use Yii;
use common\models\FriendList;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property int $friend_id
 *
 * @property User $user
 * @property User $friend
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'friend_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['friend_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['friend_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'friend_id' => '用户名',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriend()
    {
        return $this->hasOne(User::className(), ['id' => 'friend_id']);
    }

    public function getApplicationCount()
    {
        return Application::find()->where(['user_id'=>Yii::$app->user->identity->id])->count();
    }

    public function addFriend()
    {
        $addFriendModel=new FriendList();
        $addFriendModel->user_id=$this->user_id;
        $addFriendModel->friend_id=$this->friend_id;
        if($addFriendModel->save())
        {
            if($this->delete()); //如果已经添加到好友列表，则申请表清空该条记录
            return true;
        }
        return false;
    }
}
