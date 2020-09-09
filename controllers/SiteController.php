<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use Codeception\Event\PrintResultEvent;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts = Posts::find()->all();
        return $this->render('home', ['posts' => $posts]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    // Shubham { create controller }
    public function actionCreate()
    {
        $posts = new Posts();
        $formData = Yii::$app->request->post();
        if ($posts->load($formData)) {
            if ($posts->save()) {
                Yii::$app->getSession()->setFlash('message', 'Post Published Successfully');
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('message', 'Having Somthing Error');
            }
        }
        return $this->render('create', ['posts' => $posts]);
    }

    public function actionView($prid)
    {
        $post = Posts::findOne($prid);
        return $this->render('view', ['post' => $post]);
    }

    public function actionUpdate($prid)
    {
        $post = Posts::findOne($prid);
        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            Yii::$app->getSession()->setFlash('message', 'Post Updated Successfully');
            return $this->redirect(['index', 'prid' => $post->prid]);
        } else {
            return $this->render('update', ['post' => $post]);
        }
    }

    public function actionDelete($prid)
    {
        $post = Posts::findOne($prid)->delete();
        if ($post) {
            Yii::$app->getSession()->setFlash('message', 'Post Deleted Successfully');
            return $this->redirect(['index']);
        }
    }
}
