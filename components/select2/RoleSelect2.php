<?php


namespace app\components\select2;

use yii\helpers\StringHelper;
use yii\helpers\Html;
use pcrt\widgets\select2\Select2;
use yii\web\JsExpression;


/**
 * Widget per la selezione dei ruoli utente
 *
 * @author Marco Petrini <marco@bhima.eu>
 */
class RoleSelect2 extends \yii\base\Widget {

  /**
   *
   * @var string $name della select
   */
  public $name;

  /**
   *
   * @var string $value della select
   */
  public $value;
  /**
   *
   * @var string $disabilita la select
   */
  public $disabled;
  /**
   *
   * @var string $ Inserisce un valore vuoto
   */
  public $emptyvalue = false;
  /**
   *
   * @var string $ Placeholder
   */
  public $multiple = false;

  public $placeholder = "";

  public $class = "";

  public function run() {

    $roles = \Yii::$app->roleManager::getAllRoles(false);
    $ruoli = [];
    /*foreach($roles as $key => $role){
      $ruoli[] = ['id'=>$key,'text'=>$role];
    }*/

    if (\Yii::$app->user->can('writeAllUsers')) {
      $ruoli = $roles;
    } else {
    
      if (\Yii::$app->user->can('writeTechUser')) {
        $ruoli['technician'] = 'Technician';
      }

      if (\Yii::$app->user->can('writeSupplierUser')) {
        $ruoli['supplier'] = 'Supplier';
      }

    }

    return Select2::widget([
      'name' => $this->name,
      'id' => $this->name,
      'items' => $ruoli,
      'value' => $this->value,
      'options'=>[
        'multiple' => $this->multiple,
        'class' => $this->class
      ],
      'clientOptions' => [
          'maximumInputLength' => 20,
          'disabled' => ($this->disabled) ? 'disabled' : false,
          'minimumResultsForSearch' => -1,
          'placeholder' => ($this->placeholder !== "") ? $this->placeholder : false,
          'escapeMarkup' => new JsExpression("function(markup){
            return markup;
          }")
      ]
    ]);
  }

}
