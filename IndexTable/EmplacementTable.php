<?php

namespace model\IndexTable;

class EmplacementTable
{

    const TABLE_NAME = "emplacement";

    const COLUMNS =
        ["ID" => "idemplacement",
            "FK_CLIENT" => "fk_client",
            "FK_EMPLOYER" => "fk_employer",
            "ADRESSE" => "adresse",
            "NOM" => "nom",
            ];

}