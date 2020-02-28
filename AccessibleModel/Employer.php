<?php

namespace model\accessibleModel;


use \model\DataAccess;
use model\IndexTable\EmployerTable;

class Employer extends DataAccess
{

    /**
     * Emplacement constructor.
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->_idColumnName = EmployerTable::COLUMNS['ID'];
        $this->_nameColumnName = EmployerTable::COLUMNS['NOM'];
        $this->_columns = EmployerTable::COLUMNS;
    }

}