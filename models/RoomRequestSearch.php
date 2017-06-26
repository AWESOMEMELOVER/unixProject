<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RoomRequest;

/**
 * app\models\RoomRequestSearch represents the model behind the search form about `common\models\RoomRequest`.
 */
 class RoomRequestSearch extends RoomRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'privilege', 'room_id', 'docs_received'], 'integer'],
            [['entry_year', 'exclusion_year'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = RoomRequest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'privilege' => $this->privilege,
            'room_id' => $this->room_id,
            'docs_received' => $this->docs_received,
            'entry_year' => $this->entry_year,
            'exclusion_year' => $this->exclusion_year,
        ]);

        return $dataProvider;
    }
}
