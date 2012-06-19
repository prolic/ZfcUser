<?php
return array(
    'zfcuser' => array(
        'user_entity_class' => 'ZfcUser\Entity\User',
        'enable_registration'       => true,
        //NOTE: Please override the setting below via your zfcuser.global.php file
        //      Uncommenting the line below will break any overrides in later config files
        //      due to the way config file merging works with array values
        'auth_identity_fields'      => array( 'emailAddress', 'username' ),
        'enable_username'           => false,
        'enable_display_name'       => false,
        'require_activation'        => false,
        'login_after_registration'  => true,
        'use_registration_form_captcha' => true,
        'password_salt'   => '546f4e71-1d9f-4c86-9270-e0ee64ef86e5',
        'password_cost' => 14,
        'user_manager_options' => array(
            'table_name' => 'user',
            'primary_key' => 'id',
            'class_name' => 'ZfcUser\Entity\User',
            'map' => array(
                'id' => array(
                    'name' => 'user_id',
                    'type' => 'integer',
                ),
                'username' => array(
                    'name' => 'username',
                    'type' => 'string'
                ),
                'emailAddress' => array(
                    'name' => 'email',
                    'type' => 'string'
                ),
                'displayName' => array(
                    'name' => 'display_name',
                    'type' => 'string'
                ),
                'password' => array(
                    'name' => 'password',
                    'type' => 'string'
                ),
                'lastLogin' => array(
                    'name' => 'last_login',
                    'type' => 'datetime'
                ),
                'lastIp' => array(
                    'name' => 'last_ip',
                    'type' => 'string'
                ),
                'registerTime' => array(
                    'name' => 'register_time',
                    'type' => 'datetime'
                ),
                'registerIp' => array(
                    'name' => 'register_ip',
                    'type' => 'string'
                ),
                'active' => array(
                    'name' => 'active',
                    'type' => 'bool'
                ),
                'enabled' => array(
                    'name' => 'enabled',
                    'type' => 'bool'
                )
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'zfcuser' => __DIR__ . '/../view',
        ),
        'helper_map' => array(
            'Zend\Form\View\HelperLoader',
            'zfcUserIdentity'        => 'ZfcUser\View\Helper\ZfcUserIdentity',
            'zfcUserLoginWidget'     => 'ZfcUser\View\Helper\ZfcUserLoginWidget',
        ),
    ),

    'controller' => array(
        'classes' => array(
            'zfcuser' => 'ZfcUser\Controller\UserController',
        ),
        'map' => array(
            'zfcuserauthentication' => 'ZfcUser\Controller\Plugin\ZfcUserAuthentication',
        ),
    ),

    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        'controller' => 'zfcuser',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'authenticate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authenticate',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'authenticate',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'register',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
