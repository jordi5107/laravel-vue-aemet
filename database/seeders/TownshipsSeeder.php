<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Township;
use Illuminate\Support\Facades\DB;

class TownshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('database/seeders/data/diccionario24.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: {$csvFile}");
            return;
        }

        DB::table('townships')->truncate();

        $handle = fopen($csvFile, 'r');

        fgetcsv($handle);

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            static $firstRowAfterHeader = true;
            if ($firstRowAfterHeader) {
                $firstRowAfterHeader = false;
                continue;
            }

            $townshipCode = isset($data[1]) && isset($data[2]) ? $data[1] . $data[2] : null;
            $townshipName = isset($data[4]) ? $data[4] : null;
            
            if ($townshipCode && $townshipName) {
            Township::create([
                'code' => $townshipCode,
                'name' => $townshipName,
                // Add other fields as needed based on your model
            ]);
            }
        }

        fclose($handle);

        $this->command->info('Townships imported successfully!');
    }
}
