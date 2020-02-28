<?php

namespace model\accessibleModel;

use \model\DataAccess;
use \model\indexTable\ClientTable;


class Client extends DataAccess
{

    /**
     * Client constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->_idColumnName = ClientTable::COLUMNS['ID'];
        $this->_nameColumnName = ClientTable::COLUMNS['NOM'];
        $this->_columns = ClientTable::COLUMNS;
    }

}