<?php

namespace model\IndexTable;

class TempsTable
{

    const TABLE_NAME = "temps";

    const COLUMNS =
        ["ID" => "idtemps",
            "FK_EMPLOYER" => "tache",
            "FK_EMPLACEMENT" => "description",
            "ENTRE" => "entre",
            "SORTIE" => "sortie",
            ];

}