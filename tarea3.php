<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Tarea3 extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'tarea3';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Rafa Rodríguez';
        $this->need_instance = 1;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Tarea 3');
        $this->description = $this->l('Aquí desarrollaremos la Tarea 3');

        $this->confirmUninstall = $this->l('');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('TAREA3_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install()  &&
            $this->registerHook('displayNav1') &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()
    {
        Configuration::deleteByName('TAREA3_LIVE_MODE');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    public function getContent()
    {   
        return $this->display(__FILE__, 'configure.tpl');
    }

    public function hookDisplayNav1()
    {
        $api_key = 'askForMySelf';

        $this->context->smarty->assign('api_key', $api_key);

        return $this->display(__FILE__, 'displayNav1.tpl');
    }
    
}