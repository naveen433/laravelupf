<?php

namespace App\Repositories\Interfaces;

interface EmiRepositoryInterface
{
    public function checkTableExists(string $tableName);
    public function getTableColumns(string $tableName);
    public function getEmiData(string $tableName);
    public function dropTableIfExists(string $tableName);
    public function createEmiTable(array $columns);
    public function insertEmiRecord(array $data);
}