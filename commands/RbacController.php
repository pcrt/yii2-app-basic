<?php


namespace app\commands;

use yii\console\Controller;
use app\models\User;
use yii\base\UserException;
use app\helpers\enums\Role;

/**
 * Description of RbacController
 *
 * @author Marco Petrini <info@protocollicreativi.it>
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        /*$auth = \Yii::$app->authManager;

        //creazione ruoli

        $admin = $auth->getRole(Role::ADMIN);
        $technician = $auth->getRole(Role::TECHNICIAN);
        $supplier = $auth->getRole(Role::SUPPLIER);
        $buyer = $auth->getRole(Role::BUYER);
        $supervisor = $auth->getRole(Role::SUPERVISOR);

        //ruolo Technician
        if ($technician === null) {
            $technician = $auth->createRole(Role::TECHNICIAN);
            $technician->description = Role::getLabel(Role::TECHNICIAN);
            $auth->add($technician);
        }

        //ruolo Supplier
        if ($supplier === null) {
            $supplier = $auth->createRole(Role::SUPPLIER);
            $supplier->description = Role::getLabel(Role::SUPPLIER);
            $auth->add($supplier);
        }

        //ruolo Buyer
        if ($buyer === null) {
            $buyer = $auth->createRole(Role::BUYER);
            $buyer->description = Role::getLabel(Role::BUYER);
            $auth->add($buyer);
        }

        //ruolo admin
        if ($admin === null) {
            $admin = $auth->createRole(Role::ADMIN);
            $admin->description = Role::getLabel(Role::ADMIN);
            $auth->add($admin);
        }

        //ruolo supervisor
        if ($supervisor === null) {
            $supervisor = $auth->createRole(Role::SUPERVISOR);
            $supervisor->description = Role::getLabel(Role::SUPERVISOR);
            $auth->add($supervisor);
        }

        //controllo che non esista già l'utente amministratore predefinito
        if (!User::find()->where(['=', 'email', 'info@protocollicreativi.it'])->one()) {

            //crea l'utente admin di default
            $user = new User();
            $user->email = 'info@protocollicreativi.it';
            $user->name = 'Protocolli';
            $user->surname = 'Creativi';
            $user->username = 'protocolli';
            $pass = $user->generateRandomPassword(10);
            $user->password = $pass;
            $user->status = 1;
            $user->created_at = time();
            $user->auth_key = '0';



            if (!$user->save()) {
                throw new \UserException('Errore nella creazione dell\'utente amministratore');
            }
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole(Role::ADMIN);
            $auth->assign($authorRole, $user->id);

            echo "############################################################\n";
            echo "Amministratore correttamente creato! Ecco le credenziali:\n";
            echo "email: $user->email\n";
            echo "password: $pass\n";
            echo "username: $user->username\n";
            echo "############################################################\n";
        }*/
    }

    public function actionAddPermissions()
    {

        /*//Create all permission and assign it to role

        $auth = \Yii::$app->authManager;

        // delete all permission

        $auth->removeAllPermissions();

        //readCategories

        $readCategories = $auth->createPermission('readCategories');
        $readCategories->description = 'Can read categories';
        $auth->add($readCategories);

        //writeCategories

        $writeCategories = $auth->createPermission('writeCategories');
        $writeCategories->description = 'Can write categories';
        $auth->add($writeCategories);

        //readSuppliers

        $readSuppliers = $auth->createPermission('readSuppliers');
        $readSuppliers->description = 'Can read suppliers';
        $auth->add($readSuppliers);

        //writeSuppliers

        $writeSuppliers = $auth->createPermission('writeSuppliers');
        $writeSuppliers->description = 'Can write suppliers';
        $auth->add($writeSuppliers);

        //readProducts

        $readProducts = $auth->createPermission('readProducts');
        $readProducts->description = 'Can read products';
        $auth->add($readProducts);

        //writeProducts

        $writeProducts = $auth->createPermission('writeProducts');
        $writeProducts->description = 'Can write products';
        $auth->add($writeProducts);

        //readUsers

        $readUsers = $auth->createPermission('readUsers');
        $readUsers->description = 'Can read users';
        $auth->add($readUsers);

        //writeAllUsers

        $writeAllUsers = $auth->createPermission('writeAllUsers');
        $writeAllUsers->description = 'Can write users';
        $auth->add($writeAllUsers);

        //writeTechUser

        $writeTechUser = $auth->createPermission('writeTechUser');
        $writeTechUser->description = 'Can write users';
        $auth->add($writeTechUser);

        //writeSupplierUser

        $writeSupplierUser = $auth->createPermission('writeSupplierUser');
        $writeSupplierUser->description = 'Can write users';
        $auth->add($writeSupplierUser);

        //readYourRfp

        $readYourRfp = $auth->createPermission('readYourRfp');
        $readYourRfp->description = 'Can read your rfp';
        $auth->add($readYourRfp);

        //readAllRfp

        $readAllRfp = $auth->createPermission('readAllRfp');
        $readAllRfp->description = 'Can read all rfp';
        $auth->add($readAllRfp);

        //writeYourRfp

        $writeYourRfp = $auth->createPermission('writeYourRfp');
        $writeYourRfp->description = 'Can write your rfp';
        $auth->add($writeYourRfp);

        //writeAllRfp

        $writeAllRfp = $auth->createPermission('writeAllRfp');
        $writeAllRfp->description = 'Can write all rfp';
        $auth->add($writeAllRfp);


        //readYourRfq

        $readYourRfq = $auth->createPermission('readYourRfq');
        $readYourRfq->description = 'Can read your rfq';
        $auth->add($readYourRfq);

        //readAllRfq

        $readAllRfq = $auth->createPermission('readAllRfq');
        $readAllRfq->description = 'Can read all rfq';
        $auth->add($readAllRfq);

        //writeYourRfq

        $writeYourRfq = $auth->createPermission('writeYourRfq');
        $writeYourRfq->description = 'Can write your rfq';
        $auth->add($writeYourRfq);

        //writeAllRfq

        $writeAllRfq = $auth->createPermission('writeAllRfq');
        $writeAllRfq->description = 'Can write all rfq';
        $auth->add($writeAllRfq);

        //readAllRfqSupplier

        $readAllRfqSupplier = $auth->createPermission('readAllRfqSupplier');
        $readAllRfqSupplier->description = 'Can read all rfq supplier view';
        $auth->add($readAllRfqSupplier);

        //writeAllRfqSupplier

        $writeAllRfqSupplier = $auth->createPermission('writeAllRfqSupplier');
        $writeAllRfqSupplier->description = 'Can write all rfq supplier view';
        $auth->add($writeAllRfqSupplier);

        // Dashboard Permission

        $showAdminDashboard = $auth->createPermission('showAdminDashboard');
        $showAdminDashboard->description = 'Can show admin dashboard';
        $auth->add($showAdminDashboard);

        $showTechnicianDashboard = $auth->createPermission('showTechnicianDashboard');
        $showTechnicianDashboard->description = 'Can show technician dashboard';
        $auth->add($showTechnicianDashboard);

        $showSupplierDashboard = $auth->createPermission('showSupplierDashboard');
        $showSupplierDashboard->description = 'Can show supplier dashboard';
        $auth->add($showSupplierDashboard);

        $showBuyerDashboard = $auth->createPermission('showBuyerDashboard');
        $showBuyerDashboard->description = 'Can show buyer dashboard';
        $auth->add($showBuyerDashboard);

        $showSupervisorDashboard = $auth->createPermission('showSupervisorDashboard');
        $showSupervisorDashboard->description = 'Can show supervisor dashboard';
        $auth->add($showSupervisorDashboard);

        $admin = $auth->getRole(Role::ADMIN);
        $technician = $auth->getRole(Role::TECHNICIAN);
        $supplier = $auth->getRole(Role::SUPPLIER);
        $buyer = $auth->getRole(ROLE::BUYER);
        $supervisor = $auth->getRole(ROLE::SUPERVISOR);

        //assigment buyer

        $auth->addChild($buyer, $readProducts);
        $auth->addChild($buyer, $writeProducts);
        $auth->addChild($buyer, $readSuppliers);
        $auth->addChild($buyer, $writeSuppliers);
        $auth->addChild($buyer, $readUsers);
        $auth->addChild($buyer, $readAllRfp);
        $auth->addChild($buyer, $writeYourRfp);
        $auth->addChild($buyer, $readAllRfq);
        $auth->addChild($buyer, $writeYourRfq);
        $auth->addChild($buyer, $showBuyerDashboard);

        //assigment technician

        $auth->addChild($technician, $readCategories);
        $auth->addChild($technician, $readProducts);
        $auth->addChild($technician, $readYourRfp);
        $auth->addChild($technician, $writeYourRfp);
        $auth->addChild($technician, $showTechnicianDashboard);

        //assigment admin

        $auth->addChild($admin, $readProducts);
        $auth->addChild($admin, $writeProducts);
        $auth->addChild($admin, $readSuppliers);
        $auth->addChild($admin, $writeSuppliers);
        $auth->addChild($admin, $readCategories);
        $auth->addChild($admin, $writeCategories);
        $auth->addChild($admin, $readUsers);
        $auth->addChild($admin, $writeAllUsers);
        $auth->addChild($admin, $readAllRfp);
        $auth->addChild($admin, $writeAllRfp);
        $auth->addChild($admin, $readAllRfq);
        $auth->addChild($admin, $writeAllRfq);
        $auth->addChild($admin, $showAdminDashboard);

        $auth->addChild($supplier, $readAllRfqSupplier);
        $auth->addChild($supplier, $writeAllRfqSupplier);
        $auth->addChild($supplier, $showSupplierDashboard);

        //assigment supervisor

        $auth->addChild($supervisor, $readProducts);
        $auth->addChild($supervisor, $writeProducts);
        $auth->addChild($supervisor, $readSuppliers);
        $auth->addChild($supervisor, $writeSuppliers);
        $auth->addChild($supervisor, $readUsers);
        $auth->addChild($supervisor, $writeTechUser);
        $auth->addChild($supervisor, $writeSupplierUser);
        $auth->addChild($supervisor, $readAllRfp);
        $auth->addChild($supervisor, $writeAllRfp);
        $auth->addChild($supervisor, $readAllRfq);
        $auth->addChild($supervisor, $writeAllRfq);
        $auth->addChild($supervisor, $showSupervisorDashboard);*/
    }
}
