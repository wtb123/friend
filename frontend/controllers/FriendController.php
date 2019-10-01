<?php

namespace frontend\controllers;

use Yii;
use common\models\Friend;
use common\models\FriendSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FriendController implements the CRUD actions for Friend model.
 */
class FriendController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Friend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel=new FriendSearch();
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel,
        ]);
    }
    public function actionMyPublish()
    {
        $searchModel=new FriendSearch();
        $dataProvider=$searchModel->searchMyPublish(Yii::$app->request->queryParams);
        return $this->render('my-publish', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel,
        ]);

       /* return $this->redirect('?r=friend/index', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel,
        ]);*/
       //待解决，如何利用$this->redirect()转跳到index.php视图，不必使用和index.php
        //内容相同的my-publish.php视图模板
    }
    /**
     * Displays a single Friend model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Friend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Friend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        $model=new Friend();
        if($model->load(Yii::$app->request->post()))
        {
            $model->imageFile=UploadedFile::getInstance($model,'imageFile');
            if($model->upload())
            {
                return $this->render('view',['model'=>$model]);
            }
            else
            {
                //弹出报错信息
                echo "Hello World!这一条报错信息";
            }
        }
        else
        {
            return $this->render('upload',['model'=>$model]);
        }
    }

    /**
     * Updates an existing Friend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Friend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Friend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Friend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Friend::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
