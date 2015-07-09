<?php
namespace App\Data;

use PDO as BasePDO;

class PDO extends BasePDO
{
    protected $_config = array();

    protected $_connected = false;

    public function __construct($dsn, $user = null, $pass = null, $options = null) {
        //Save connection details for later
        $this->_config = array(
            'dsn' => $dsn,
            'user' => $user,
            'pass' => $pass,
            'options' => $options
        );
    }

    public function checkConnection() {
        if (!$this->_connected) {
            extract($this->_config);
            parent::__construct($dsn, $user, $pass, $options);
            $this->_connected = true;
        }
    }

    public function query($query) {
        $this->checkConnection();
        return parent::query($query);
    }

    public function exec($query) {
        $this->checkConnection();
        return parent::exec($query);
    }

    public function prepare($statement, $options = []) {
        $this->checkConnection();
        return parent::prepare($statement, $options);
    }

}