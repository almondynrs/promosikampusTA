<?php

namespace App\Imports;

use App\Models\SubKriteria;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSubKriteria implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $existingData = SubKriteria::where('id', $row[0])->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan operasi update
            $existingData->update([
                'nama_sub' => $row[2],
                'kriteria_id' => $row[1],
                'bobot' => $row[3],
            ]);

            return $existingData;
        } else {
            // Jika data belum ada, lakukan operasi insert
            return new SubKriteria([
                'id' => $row[0],
                'nama_sub' => $row[2],
                'kriteria_id' => $row[1],
                'bobot' => $row[3],
            ]);
        }
    }
}
