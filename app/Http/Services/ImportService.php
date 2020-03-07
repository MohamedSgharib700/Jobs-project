<?php

namespace App\Http\Services;

use App\Constants\UserTypes;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportService implements ToModel, WithStartRow
{
    public $table;
    public $columns;

    public function __construct($table, $columns)
    {
        $this->table = $table;
        $this->columns = $columns;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if ($this->table == 'App\Models\User') {
            $emails = $this->table::pluck('email')->all();
        }
        $data = []; $i = 0;
        foreach ($this->columns as $key=>$value) {
            $data[$value] = $row[$i];
            $i++;
        }
        if ($this->table == 'App\Models\User' && isset($data['password'])) {
            $data['password'] = \Hash::make($data['password']);
            $data['type'] = UserTypes::SEEKER;
        }

        if(!empty($data)) {
            if ($this->table == 'App\Models\User') {
                if (in_array($data['email'], $emails)) {
                    $data = [];
                }
            }
            if(!empty($data)) {
                return new $this->table($data);
            }
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
