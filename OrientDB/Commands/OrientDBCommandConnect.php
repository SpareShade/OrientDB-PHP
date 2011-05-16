<?php

/**
 * @author Anton Terekhov <anton@netmonsters.ru>
 * @copyright Copyright Anton Terekhov, NetMonsters LLC, 2011
 * @license https://github.com/AntonTerekhov/OrientDB-PHP/blob/master/LICENSE
 * @link https://github.com/AntonTerekhov/OrientDB-PHP
 * @package OrientDB-PHP
 */

/**
 * connect() command for OrientDB-PHP
 *
 * @author Anton Terekhov <anton@netmonsters.ru>
 * @package OrientDB-PHP
 * @subpackage Command
 */
class OrientDBCommandConnect extends OrientDBCommandAbstract
{

    /**
     * SessionID of current connection
     * @var int
     */
    public $sessionID;

    public function __construct($parent)
    {
        parent::__construct($parent);
        $this->opType = OrientDBCommandAbstract::CONNECT;
    }

    public function prepare()
    {
        parent::prepare();
        if (count($this->attribs) != 2) {
            throw new OrientDBWrongParamsException('This command requires login and password');
        }
        // Add login
        $this->addString($this->attribs[0]);
        // Add password
        $this->addString($this->attribs[1]);
    }

    /**
     * (non-PHPdoc)
     * @see OrientDBCommandAbstract::parse()
     * @return bool
     */
    protected function parse()
    {
        $this->debugCommand('sessionID');
        $this->sessionID = $this->readInt();
        return true;
    }
}