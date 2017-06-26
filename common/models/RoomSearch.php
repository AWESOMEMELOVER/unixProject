<?php

namespace common\models; 

use Yii; 
use yii\base\Model; 
use yii\data\ActiveDataProvider; 
use common\models\Room; 

/** 
 * backend\models\RoomRequestSearch represents the model behind the search form about `common\models\Room`.
 */ 
 class RoomSearch extends Room 
{ 
    /** 
     * @inheritdoc 
     */ 
    public function rules() 
    { 
        return [ 
            [['id', 'dormitory_id', 'floor', 'places', 'living'], 'integer'],
            [['number'], 'safe'], 
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
        $query = RoomRequestSearch::find(); 

        $dataProvider = new ActiveDataProvider([ 
            'query' => $query, 
        ]); 
		$all = 0;
		if (isset($params['all']) && $params['all']) {
			unset($params['all']);
			$all = 1;
		}

        $this->load($params); 

        if (!$this->validate()) { 
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1'); 
            return $dataProvider; 
        } 

        $query->andFilterWhere([
            'id' => $this->id,
            'dormitory_id' => $this->dormitory_id,
            'floor' => $this->floor,
            'places' => $this->places,
            'living' => $this->living,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);
		
		if ($all) $query->andfilterWhere(['room_id' => null]);

        return $dataProvider; 
    } 
} 