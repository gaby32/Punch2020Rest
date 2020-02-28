<?php

namespace model\accessibleModel;


use \model\DataAccess;
use model\IndexTable\EmplacementTable;

class Emplacement extends DataAccess
{

    /**
     * Emplacement constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->_idColumnName = EmplacementTable::COLUMNS['ID'];
        $this->_columns = EmplacementTable::COLUMNS;
    }

}