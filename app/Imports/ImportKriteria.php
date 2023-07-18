<?php

namespace App\Imports;

use App\Models\Kriteria;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportKriteria implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $existingData = Kriteria::where('id', $row[0])->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan operasi update
            $existingData->update([
                'nama_kriteria' => $row[1],
                'bobot' => $row[2],
            ]);

            return $existingData;
        } else {
            // Jika data belum ada, lakukan operasi insert
            return new Kriteria([
                'id' => $row[0],
                'nama_kriteria' => $row[1],
                'bobot' => $row[2],
            ]);
        }
    }
}
