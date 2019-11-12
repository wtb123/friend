<?php

namespace common\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FriendList;

/**
 * FriendListSearch represents the model behind the search form of `common\models\FriendList`.
 */
class FriendListSearch extends FriendList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'friend_id'], 'integer'],
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
       $query=FriendList::find()
           ->where(['or','user_id=:user_id','friend_id=:friend_id'])
           ->addParams([':user_id'=>Yii::$app->user->identity->id,
                        ':friend_id'=>Yii::$app->user->identity->id]);
       //var_dump($query->createCommand()->getRawSql());
       //exit(0);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'friend_id' => $this->friend_id,
        ]);

        return $dataProvider;
    }
}
