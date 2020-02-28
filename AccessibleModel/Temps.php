<?php

namespace model\accessibleModel;


use \model\DataAccess;
use model\IndexTable\TempsTable;

class Temps extends DataAccess
{

    /**
     * Emplacement constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->_idColumnName = TempsTable::COLUMNS['ID'];
        $this->_columns = TempsTable::COLUMNS;
    }

}