<?php

namespace model\accessibleModel;


use \model\DataAccess;
use model\IndexTable\TacheTable;

class Tache extends DataAccess
{

    /**
     * Emplacement constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->_idColumnName = TacheTable::COLUMNS['ID'];
        $this->_columns = TacheTable::COLUMNS;
    }

}