<?php

namespace app\models;

use Yii;
use pcrt\behavior\Filterable;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\web\IdentityInterface;
use yii\db\Expression;
use app\helpers\enums\UserStatus;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property int $id_erp
 * @property string $name
 * @property string $surname
 * @property string $username
 * @property string $password
 * @property int $role
 * @property int $status
 * @property int $id_company
 * @property int $id_workspace
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Reply[] $replies
 * @property Suppliers[] $suppliers
 * @property Ticket[] $tickets
 * @property Workspace $workspace
 * @property Suppliers $company
 */
class User extends \yii\db\ActiveRecord  implements IdentityInterface
{
    public function behaviors()
    {
      return [
        // anonymous behavior, add method getFilter(name=false), setFilter(name,value)
        [
          'class' => Filterable::className(),
          'tablename' => 'User'
        ]

      ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','email'],'required'],
            [['password'],'required','on' => ['new']],
            [['role', 'status', 'id_company', 'id_workspace', 'privacy_check', 'tutorial_check'], 'integer'],
            [['last_login','created_at', 'updated_at'], 'safe'],
            [['email'],'unique','message' => \Yii::t('app', 'This email address has already been taken')],
            [['email'], 'email'],
            [['name', 'surname', 'username', 'password', 'email', 'id_erp'], 'string', 'max' => 255],
            [['id_workspace'], 'exist', 'skipOnError' => true, 'targetClass' => Workspace::className(), 'targetAttribute' => ['id_workspace' => 'id']],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
    * Verifica se l'entità può essere rimossa dal database senza rompere i vincoli di 
    * integrità, ritorna true se possibile
    * 
    */
    public function canDeleted(){
        if ($this->id_company !== null)
          return false;
        
        return true;
    }
    

    /**
    * Salva la data di creazione, la password criptata e genera la auth_key
    * se è un nuovo record, altrimenti salva la data di modifica
    * 
    * @param boolean $insert se è un nuovo record
    * @return boolean
    */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $this->auth_key = \Yii::$app->security->generateRandomString();
            } else {
                if (!empty($this->password)) {
                    //aggiorno la password se è stata modificata
                    $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
                    $this->removePasswordResetToken();
                } else {
                    $this->password = $this->getOldAttribute('password');
                }
                
                // Check if user is supplier and if not remove Company Link
                $roles = \Yii::$app->authManager->getRolesByUser($this->id);
                $is_supplier = false;
                foreach($roles as $role){
                  if($role->name === "supplier"){
                    $is_supplier = true;
                  }
                }
                if(!$is_supplier){
                  $this->id_company = null;  
                }
            }
            return true;
        }
        return false;
    }
    
    /**
    * Genera una password randomica per l'inizializazione dell'utente admin
    * nell rbac/init
    * 
    * @param integer $length la lunghezza della password
    * @return string la password generata
    */
    public function generateRandomPassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*#[](){}/%&$£!?^§@-_<>';
        $charLength = strlen($characters);
        $randomPass = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPass .= $characters[rand(0, $charLength - 1)];
        }
        return utf8_encode($randomPass);
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_erp' => Yii::t('app', 'Id Erp'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'id_company' => Yii::t('app', 'Suppliers'),
            'id_workspace' => Yii::t('app', 'Id Workspace'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkspace()
    {
        return $this->hasOne(Workspace::className(), ['id' => 'id_workspace']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Suppliers::className(), ['id' => 'id_company']);
    }

     /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
        /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['auth_key' => $token, 'status' => UserStatus::ENABLED()]);
    }
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => UserStatus::ENABLED()]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function setLastLogin(){
      $this->last_login = new Expression('NOW()');
      $this->password = "";
      return $this->save();
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        return Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function canDelete(){
       
    }
}
