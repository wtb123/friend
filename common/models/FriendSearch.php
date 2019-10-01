<?php

namespace common\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Friend;
use common\models\FriendList;
use yii\helpers\ArrayHelper;

/**
 * FriendSearch represents the model behind the search form of `common\models\Friend`.
 */
class FriendSearch extends Friend
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'create_time'], 'integer'],
            [['content', 'picture_url'], 'safe'],
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
        $queryFriendList=(new \yii\db\query())
            ->select(['user_id','friend_id'])
            ->from('friend_list')
            ->where(['or','user_id=:user_id','friend_id=:friend_id'])
            ->addParams([':user_id'=>Yii::$app->user->identity->id,
                         ':friend_id'=>Yii::$app->user->identity->id])
           ->all();
        //var_dump($queryFriendList->createCommand()->getRawSql());
        //exit(0);
        $queryArray=ArrayHelper::map($queryFriendList,'user_id','friend_id');
        $queryArray1=array_keys($queryArray);
        $queryArray2=array_values($queryArray);
        $queryArray=array_merge($queryArray1,$queryArray2);
       /* echo "<pre>";
        print_r($queryArray1);
        print_r($queryArray2);
        print_r($queryArray);
        exit(0);*/

       //这里有待优化，应该有更简单的方法处理要提取的数组，而且此处$queryArray有冗余
        $query = Friend::find()->where(['user_id'=>$queryArray]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'picture_url', $this->picture_url]);

        return $dataProvider;
    }

    public function searchMyPublish($params)
    {
        $query = Friend::find()->where(['user_id'=>Yii::$app->user->identity->id]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'picture_url', $this->picture_url]);

        return $dataProvider;
    }
}
