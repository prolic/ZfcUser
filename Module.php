<?php

namespace ZfcUser;

use Zend\ModuleManager\ModuleManager,
    Zend\EventManager\StaticEventManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements 
    AutoloaderProviderInterface, 
    ConfigProviderInterface, 
    ServiceProviderInterface
{


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfiguration()
    {
        return array(
            'invokables' => array(
                'ZfcUser\Authentication\Adapter\Db' => 'ZfcUser\Authentication\Adapter\Db',
                'ZfcUser\Authentication\Storage\Db' => 'ZfcUser\Authentication\Storage\Db',
                'ZfcUser\Form\Login'                => 'ZfcUser\Form\Login',
                'zfcUserAuthentication'             => 'ZfcUser\Controller\Plugin\ZfcUserAuthentication',
            ),
            'factories' => array(

                'zfcuser_user_controller_options' => function ($sm) {
                    return $sm->get('zfcuser_module_options');
                },

                'zfcuser_user_service_options' => function ($sm) {
                    return $sm->get('zfcuser_module_options');
                },

                'zfcuser_registeroptions' => function ($sm) {
                    return $sm->get('zfcuser_module_options');
                },

                'zfcuser_module_options' => function ($sm) {
                    $config = $sm->get('Configuration');
                    $zfcUserConfig = $config['zfcuser'];
                    return new \ZfcUser\Option\ModuleOptions($zfcUserConfig);
                },

                'zfcuser_authentication_options' => function ($sm) {
                    $config = $sm->get('Configuration');
                    $zfcUserConfig = $config['zfcuser'];
                    return new \ZfcUser\Option\ModuleOptions($zfcUserConfig);
                },

                'zfcuser_user_service' => function($sm) {
                    $service = new \ZfcUser\Service\UserService();
                    $service->setServiceLocator($sm);
                    return $service;
                },

                'zfcuser_user_manager' => function ($sm) {
                    $manager = new \ZfcUser\Persistence\UserManager();
                    $manager->setTableGateway($sm->get(''));
                },

                'zfcuser_user_tablegateway' => function ($sm) {
                    $adapter = $sm->get('zfcuser_zend_db_adapter');
                    $tableGateway = new \Zend\Db\TableGateway\TableGateway('user', $adapter);
                    return $tableGateway;
                },

                'ZfcUser\View\Helper\ZfcUserIdentity' => function ($sm) {
                    $viewHelper = new View\Helper\ZfcUserIdentity;
                    $viewHelper->setAuthService($sm->get('zfcuser_auth_service'));
                    return $viewHelper;
                },
                'ZfcUser\View\Helper\ZfcUserLoginWidget' => function ($sm) {
                    $viewHelper = new View\Helper\ZfcUserLoginWidget;
                    $viewHelper->setLoginForm($sm->get('zfcuser_login_form'));
                    return $viewHelper;
                },

                'zfcuser_auth_service' => function ($sm) {
                    return new \Zend\Authentication\AuthenticationService(
                        $sm->get('ZfcUser\Authentication\Storage\Db'),
                        $sm->get('ZfcUser\Authentication\Adapter\AdapterChain')
                    );
                },

                'ZfcUser\Authentication\Adapter\AdapterChain' => function ($sm) {
                    $chain = new Authentication\Adapter\AdapterChain;
                    $adapter = $sm->get('ZfcUser\Authentication\Adapter\Db');
                    $chain->events()->attach('authenticate', array($adapter, 'authenticate'));
                    return $chain;
                },

                'zfcuser_login_form' => function($sm) {
                    $form = new \ZfcUser\Form\Login();
                    // TODO set hydrator and input filter?
                    return $form;
                },

                'zfcuser_register_form' => function ($sm) {
                    $form = new \ZfcUser\Form\Register($sm->get('zfcuser_module_options'));
                    //$form->setCaptchaElement($sm->get('zfcuser_captcha_element'));
                    $form->setInputFilter($sm->get('ZfcUser\Form\RegisterFilter'));
                    $form->setHydrator($sm->get('zfcuser_user_hydrator'));
                    return $form;
                },

                'zfcuser_user_hydrator' => function ($sm) {
                    $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
                    return $hydrator;
                },

                'zfcuser_uemail_validator' => function($sm) {
                    $manager = $sm->get('zfcuser_user_manager');
                    return new \ZfcUser\Validator\NoRecordExists(array(
                        'userManager' => $manager,
                        'key'        => 'email'
                    ));
                },

                'zfcuser_uusername_validator' => function($sm) {
                    $manager = $sm->get('zfcuser_user_manager');
                    return new \ZfcUser\Validator\NoRecordExists(array(
                        'userManager' => $manager,
                        'key'        => 'username'
                    ));
                },

                'ZfcUser\Form\RegisterFilter' => function($sm) {
                    return new \Zend\InputFilter\InputFilter();

                    return new \ZfcUser\Form\RegisterFilter(
                        $sm->get('zfcuser_uemail_validator'),
                        $sm->get('zfcuser_uusername_validator'),
                        $sm->get('zfcuser_module_options')
                    );
                },
            ),
        );
    }

}
