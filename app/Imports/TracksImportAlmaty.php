<?php

namespace App\Imports;

use App\Models\TrackList;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;

class TracksImportAlmaty implements ToModel, SkipsOnError
{

    use Importable;
    private $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }
    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return TrackList::updateOrCreate(
            ['track_code' => $row[0]],
            [
                'to_almaty' => $this->date,
                'status' => 'Получено на складе в Алматы',
                'reg_almaty' => 1,
                'updated_at' => now(),
            ]
        );
    }
}
