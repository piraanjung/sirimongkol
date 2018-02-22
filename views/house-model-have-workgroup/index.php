<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseModelHaveWorkgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผูกแบบบ้านกับกลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="house-model-have-workgroup-index">
    <div class="box box-success">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('ผูกแบบบ้านกับกลุ่มงาน', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'responsive'=>true,
            'hover'=>true,
            'pjax'=>true,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
                // 'beforeGrid'=>'My fancy content before.',
                // 'afterGrid'=>'My fancy content after.',
            ],


            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'houseModel.hm_name',
                'workGroup.wg_name',
                'cost_control',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>