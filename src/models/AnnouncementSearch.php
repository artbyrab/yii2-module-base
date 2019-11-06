<?php

namespace artbyrab\Yii2ModuleBase\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use artbyrab\Yii2ModuleBase\models\Announcement;

/**
 * AnnouncementSearch represents the model behind the search form of
 * `artbyrab\Yii2ModuleBase\Announcement`.
 */
class AnnouncementSearch extends Announcement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'message', 'created_datetime', 'updated_datetime'], 'safe'],
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
        $query = Yii::createObject(Announcement::class)::find();

        // add conditions that should always apply here

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
            'created_datetime' => $this->created_datetime,
            'updated_datetime' => $this->updated_datetime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
