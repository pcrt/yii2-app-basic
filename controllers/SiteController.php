<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

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
                'rules' => [
                  [
                    'allow' => true,
                    'actions' => ['login', 'request-password', 'new-password']
                  ],
                  [
                    'allow' => true,
                    'roles' => ['@']
                  ],
                ]
            ]
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
        $id = Yii::$app->user->id;
        $redirect = "";
        if (array_key_exists("supplier", \Yii::$app->authManager->getRolesByUser($id)) === true) {
            $redirect = 'rfqs-suppliers';
        } elseif (array_key_exists("admin", \Yii::$app->authManager->getRolesByUser($id)) === true) {
            $redirect = 'user';
        } elseif (array_key_exists("technician", \Yii::$app->authManager->getRolesByUser($id)) === true) {
            $redirect = 'rfp-items';
        } else {
            $redirect = 'suppliers';
        }
        return $this->redirect($redirect);
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
    
    public function actionDocs()
    {
        return $this->render('docs');
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

    public function actionChangeLang($local)
    {
        $user_id = Yii::$app->user->identity->id;

        $user = User::findOne($user_id);
        $user->language = $local;
        $user->password = '';
        $user->save();

        return $this->goBack();
    }

    public function actionRequestPassword($default = false)
    {
        $recover = Yii::$app->request->post('recover');
        if ($recover) {
            if (self::sendResetMail($recover)) {
                return $this->redirect(['login', 'success' => Yii::t('app', 'An email has been sent to you with the instructions to reset your password')]);
            } else {
                return $this->redirect(['login', 'error' => Yii::t('app', 'Error during email sending')]);
            }
        }

        return $this->render('request-password', [
            'default' => $default,
        ]);
    }

    protected function sendResetMail($recover)
    {
        $user = User::find()->andWhere(['or', ['email' => $recover], ['username' => $recover]])->one();

        $user->generatePasswordResetToken();
        $user->password = '';
        $user->save();

        $id = $user->id;

        if ($id) {
            $user = User::findOne($id);

            $email = $user->email;
            $token = $user->password_reset_token;

            //change language
            Yii::$app->language = $user->language;

            Yii::$app->consoleRunner->run('mail/send-mail "' . $email . '" "' . Yii::t('app', 'Password recover') . '" "' . Yii::t('app', 'Open the link to reset your password') . '" "site/new-password?id=' . $id . '&token=' . $token . '"');

            return true;
        } else {
            return false;
        }
    }

    public function actionNewPassword($id = false, $token = false)
    {
        if ($id) {
            $user = User::findOne($id);
        }

        if (isset($user) && $token && $token == $user->password_reset_token) {
            $password = Yii::$app->request->post('password');
            $password_repeat = Yii::$app->request->post('password-repeat');

            if ($password && $password_repeat) {
                if ($password == $password_repeat) {
                    $user->password = $password;
                    $user->save();

                    return $this->redirect(['login', 'success' => Yii::t('app', 'Password changed successfully!')]);
                } else {
                    return $this->render('new-password', [
                        'error' => Yii::t('app', 'Passwords doesn\'t match'),
                    ]);
                }
            } else {
                return $this->render('new-password', [
                    //'default' => $default,
                ]);
            }
        }

        return $this->redirect(['login', 'error' => Yii::t('app', 'Reset password link expired')]);
    }
}
