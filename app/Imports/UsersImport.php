<?php

namespace App\Imports;

use App\Models\User;
use LengthException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class UsersImport implements ToModel, WithValidation
{
    use Importable;
    public function rules(): array
    {
        return [
            '1' => 'unique:users,document'
        ];

    }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'El documento ya está en uso.'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        //var_dump($row);
        return new User([
            'name'     => $row[0], //a
            'document'    => $row[1], //b
            'phone'    => $row[2], //c
            'email'    => $row[3], //d
            'password' => bcrypt(substr($row[1], -4)), //e
            'rol_id'    => 2, //f
        ]);
    }
}
