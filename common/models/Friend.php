<?php

namespace common\models;

use Yii;
use common\models\Comment;
use yii\web\UploadedFile;
use common\models\FriendSearch;


/**
 * This is the model class for table "friend".
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property string $picture_url
 * @property int $create_time
 *
 * @property Comment[] $comments
 * @property User $user
 */
class Friend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    public static function tableName()
    {
        return 'friend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'create_time'], 'integer'],
            [['content', 'picture_url'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['imageFile'],'file','skipOnEmpty'=>false,'extensions'=>'png,jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户名',
            'content' => '内容',
            'picture_url' => '照片',
            'create_time' => '发布时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {

       $queryResult=(new FriendSearch())->getFriendList();
       $comments=Comment::find()->where(['AND',['user_id'=>$queryResult],['friendcir_id'=>$this->id]])->all();
       return $comments;
       //return $this->hasMany(Comment::className(), ['friendcir_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param bool $insert
     * @return bool|void
     * 重写beforeSave(）函数，自动保存时间、用户
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->create_time=time();
            $this->user_id=Yii::$app->user->identity->id;
            return true;
        }
        else
            return false;
    }

    /**
     * @return bool
     * 保存上传的图片和$content中的文字内容
     */
    public function upload()
    {
     if($this->validate())
     {
         if(($dir=$this->getDir())===false) return false;
         $saveName=date('YmdHis').'_'.rand(0,99).'.'.$this->imageFile->extension;
         $this->picture_url=$dir.$saveName;
         $this->save('false');
         $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/'.$dir.$saveName);
        // print_r(Yii::getAlias('@frontend').'/web'.$dir.$saveName);
        // exit(0);
         return true;
     }

    }

    /**
     * @return bool|string
     * 获取上传的文件夹
     */
    public function getDir()
    {
        $dir='upload/'.date('Ym').'/';
        if(!file_exists(Yii::getAlias('@frontend').'/web/'.$dir))
        {
            if(mkdir(Yii::getAlias('@frontend').'/web/'.$dir,0777,true))

                return false;
        }

        return $dir;
    }

    /*
     * 给每篇朋友圈view生成一个链接，_listitem子视图中会有调用
     */
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            [
                'friend/detail',
                'id'=>$this->id,
            ]
        );
    }

    /**
     * @return mixed
     * 获取每条朋友圈的评论条数，在friend/_listitem.php子视图中有用到
     */
    public function getCommentCount()
    {
        return Comment::find()->where(['friendcir_id'=>$this->id])->count();
    }

    /**
     * 删除朋友圈记录之前需要删除该条朋友圈的评论
     */
    public function beforeDelete()
    {
       parent::beforeDelete();
       //这么写会报错，待研究
       // $Comments=Comment::find()->where(['friendcir_id=:friendcir_id'],[':friendcir_id'=>$this->id])->all();
        Comment::deleteAll('friendcir_id=:friendcir_id',[':friendcir_id'=>$this->id]);
        return true;

    }
}
