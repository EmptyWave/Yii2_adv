<?php

namespace frontend\models\filters;

use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TasksFilter represents the model behind the search form of `app\models\tables\Task`.
 */
class TasksFilter extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['name', 'description', 'deadline', 'modified'], 'safe'],
            [['created',], 'default', 'value' => null]
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
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->created == 0) unset($this->created);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
            //'creator_id' => $this->creator_id,
            'responsible_id' => $this->responsible_id,
            //'deadline' => $this->deadline,
            //'status_id' => $this->status_id,
            'created' => $this->created,
            //'modified' => $this->modified,
        ]);

        if ($this->created)
            $query->orFilterWhere(['REGEXP', 'created', $this->created]);

        $query->andFilterWhere(['like', 'responsible_id', $this->responsible_id]);
        $dependency = new DbDependency();
        $dependency->sql = 'SELECT MAX(modified) FROM task';

        Yii::$app->db->cache(function () use ($dataProvider) {

            $dataProvider->prepare();

        }, 300, $dependency);


        return $dataProvider;
    }
}
