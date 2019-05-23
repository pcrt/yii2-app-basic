<?php

namespace app\components;

use app\models\User;

/**
 * Classe con metodi statici legati ai ruoli dell'utente
 *
 * @author Marco Petrini <marco@bhima.eu>
 */
class RoleManager {
  
  /**
   * Restituisce i ruoli presenti nella tabella auth_item
   * 
   * @param boolean $only_keys se false restituisce un array 'nome_ruolo' => 'descrizione' 
   * @return array
   */
  public static function getAllRoles($only_keys = false) {
    $connection = \Yii::$app->getDb();
    $command = $connection->createCommand('SELECT name, description FROM auth_item WHERE type = 1');
    $items = $command->queryAll();

    $roles = \yii\helpers\ArrayHelper::map($items, 'name', 'description');

    foreach($roles as $key => $role) {
      $roles[$key] = \Yii::t('app', $role);
    }

    if ($only_keys) {
      return array_keys($roles);
    } else {
      return $roles;
    }
  }
  
  /**
   * Restituisce tutti gli utenti attivi con ruolo selezionato
   * 
   * @return array
   */
  public static function getUsers($role) {
    $users = User::find()->innerJoin('auth_assignment', 'user_id = User.id')
            ->andWhere(['item_name' => $role])
            ->asArray()->all();
    return \yii\helpers\ArrayHelper::map($users, 'id', 'email');
  }

  /**
   * Ritorna la descrizione del ruolo (campo auth_item.description)
   * 
   * @param string $role il nome del roulo (auth_item.name)
   * @return string la descrizione del ruolo
   */
  public static function getRoleDescription($role) {
    $roles = self::getAllRoles();
    if (!\yii\helpers\ArrayHelper::keyExists($role, $roles)) {
      return 'Nessun Ruolo';
    }
    return $roles[$role];
  }
}
