<?php

namespace model\IndexTable;

class TacheTable
{

    const TABLE_NAME = "tache";

    const COLUMNS =
        ["ID" => "fk_emplacement",
            "TACHE" => "tache",
            "DESCRIPTION" => "description",
            ];

}