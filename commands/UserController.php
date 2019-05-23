<?php


namespace app\commands;

use yii\console\Controller;
use app\models\User;
use yii\helpers\Console;

/**
 * Description of RbacController
 *
 * @author Marco Petrini <info@protocollicreativi.it>
 */
class UserController extends Controller
{
    /**
    * Updates user's password to given.
    *
    * @param string $search Email or username
    * @param string $password New password
    */

    public function actionPassword($search, $password)
    {
        $user = User::find()->where(['username'=>$search])->one();
        if ($user === null) {
            $this->stdout('User is not found' . "\n", Console::FG_RED);
        } else {
            $user->password = $password;
            if ($user->save()) {
                $this->stdout('Password has been changed' . "\n", Console::FG_GREEN);
            } else {
                $this->stdout('Error occurred while changing password' . "\n", Console::FG_RED);
            }
        }
    }
}
