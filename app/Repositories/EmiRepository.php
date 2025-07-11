<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\EmiRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EmiRepository implements EmiRepositoryInterface
{
    public function checkTableExists(string $tableName)
    {
        return DB::select("SHOW TABLES LIKE '$tableName'");
    }

    public function getTableColumns(string $tableName)
    {
        return DB::select("SHOW COLUMNS FROM $tableName");
    }

    public function getEmiData(string $tableName)
    {
        return DB::table($tableName)->get();
    }

    public function dropTableIfExists(string $tableName)
    {
        DB::statement("DROP TABLE IF EXISTS $tableName");
    }

    public function createEmiTable(array $columns)
    {
        $create = "CREATE TABLE emi_details (clientid INT";
        foreach ($columns as $col) {
            $create .= ", `$col` DECIMAL(10,2) DEFAULT 0.00";
        }
        $create .= ")";
        
        DB::statement($create);
    }

    public function insertEmiRecord(array $data)
    {
        $colStr = implode(",", $data['columns']);
        $valStr = implode(",", array_map(fn($v) => is_numeric($v) ? $v : "'$v'", $data['values']));
        
        DB::statement("INSERT INTO emi_details ($colStr) VALUES ($valStr)");
    }
}