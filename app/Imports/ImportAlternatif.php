<?php

namespace App\Imports;

use App\Models\Alternatif;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAlternatif implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $existingData = Alternatif::where('id', $row[0])->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan operasi update
            $existingData->update([
                'nama_alternatif' => $row[2],
                'sub_kriteria_id' => $row[1],
                'bobot' => $row[3],
            ]);

            return $existingData;
        } else {
            // Jika data belum ada, lakukan operasi insert
            return new Alternatif([
                'id' => $row[0],
                'nama_alternatif' => $row[2],
                'sub_kriteria_id' => $row[1],
                'bobot' => $row[3],
            ]);
        }
    }
}
