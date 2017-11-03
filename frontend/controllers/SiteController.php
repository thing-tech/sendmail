<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\controllers\FrontendController;
use frontend\models\TestSendMail;
use Stripe\Stripe;

/**
 * Site controller
 */
class SiteController extends FrontendController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//        \Yii::$app->mailer->setTransport([
//            'class'      => 'Swift_SmtpTransport',
//            'host'       => 'smtp.gmail.com',
//            'username'   => 'minaworksvn@gmail.com',
//            'password'   => 'minaworksvn17',
//            'port'       => '587',
//            'encryption' => 'tls'
//        ]);
//        $user = User::findOne(9);
//        $cam = Campaign::findOne(['user_id' => $user->id]);
//        $template = $cam->template;
//        $template = str_replace("[name]", 'Vinh', $template);
//        $template = str_replace("[email]", 'huynhtuvinh87@gmail.com', $template);
//        \Yii::$app->mailer->compose('send', ['data' => $template])
//                ->setFrom([$cam->from_email => $cam->from_name])
//                ->setSubject($cam->subject)
//                ->setTo('giicmsvn@gmail.com')
//                ->send();
//        Stripe::setApiKey('sk_test_SxZK5Ize0ShMsJ3fJYX9vaMw');
//        $charge = \Stripe\Charge::create(array('amount' => 2000, 'currency' => 'usd', 'source' => 'rk_test_XWyFfnZeXzqtqhaio4D08AlB'));
//        var_dump($charge); exit;
//        echo $charge;
        return $this->render('index');
    }

    public function actionStripe()
    {
        \Stripe\Stripe::setApiKey("sk_test_SxZK5Ize0ShMsJ3fJYX9vaMw");
//        $stripe_token = \Stripe\Token::create(array(
//                    "card" => array(
//                        "number"    => "4242424242424242",
//                        "exp_month" => "01",
//                        "exp_year"  => "19",
//                        "cvc"       => "698"
//                    )
//        ));
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create(array(
                    "amount"      => 1000,
                    "currency"    => "usd",
                    "description" => "Example charge",
                    "source"      => $token,
        ));
    }

    public function actionSendmail()
    {
        $model = new TestSendMail();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else
        {
            return $this->render('sendmail', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        } else
        {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail(Yii::$app->params['adminEmail']))
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else
        {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
//                if (Yii::$app->getUser()->login($user))
//                {
//                    
//                }
                $data = [
                    'subject' => 'Dang ky tai khoan',
                    'to'      => $user->email,
                    'user'    => $user
                ];
                $this->sendemail('register', $data, 'support');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else
            {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
