<?php

namespace App\Imports;

use App\Models\Mailing;
use Maatwebsite\Excel\Concerns\ToModel;

class MailingImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mailing([
            'nome' => $row[0],
            'cpf' => $row[1],
            'matricula' => $row[2],
            'orgao' => $row[3]
        ]);
    }
}
