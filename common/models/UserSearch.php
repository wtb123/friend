<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\models\FriendList;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'phone_number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
          //  $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere([ 'phone_number'=>$this->phone_number]);

        return $dataProvider;
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     * 该函数用来提供 搜索好友列表
     */
    public function searchFriendList($params)
    {
        $queryFriendList=(new \yii\db\query())
            ->select(['user_id','friend_id'])
            ->from('friend_list')
            ->where(['or','user_id=:user_id','friend_id=:friend_id'])
            ->addParams([':user_id'=>Yii::$app->user->identity->id,
                ':friend_id'=>Yii::$app->user->identity->id])
            ->all();
        $queryArray=ArrayHelper::map($queryFriendList,'user_id','friend_id');
        $queryArray1=array_keys($queryArray);
        $queryArray2=array_values($queryArray);
        $queryArray=array_merge($queryArray1,$queryArray2);

        $query = User::find()->where(['id'=>$queryArray]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //  $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere([ 'phone_number'=>$this->phone_number]);

        return $dataProvider;
    }
}
