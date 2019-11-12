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
use common\models\Comment;
use common\models\User;

/**
 * FriendController implements the CRUD actions for Friend model.
 */
class FriendController extends Controller
{
    public $added=0;   //0代表没有新回复
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
        /*$mail= Yii::$app->mailer->compose();
        $mail->setFrom('1332101458@qq.com');
        $mail->setTo('1332101459@qq.com');
        $mail->setSubject("邮件测试");
        $mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("<br>问我我我我我");    //发布可以带html标签的文本
        if($mail->send())
            echo "success";
        else
            echo "failse";
        die();*/
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

    public function actionDetail($id)
    {
        //step1.准备数据
        $model=$this->findModel($id);     //当前朋友圈
        $userMe=User::findOne(Yii::$app->user->id);  //当前用户的资料
        $commentModel=new Comment();                //新建一个评论类，发表评论时候用到
        $commentModel->user_id=$userMe->id;
        //step2.当评论提交，处理评论
        if($commentModel->load(Yii::$app->request->post()))
        {
            $commentModel->friendcir_id=$id;  //写明是哪一条朋友圈
            if($commentModel->save())
            {
                $this->added=1;
            }
        }

        //step3.传数据给视图渲染
        return $this->render('detail',[
            'model'=>$model,
            'commentModel'=>$commentModel,
            'added'=>$this->added,
        ]);
    }
}
