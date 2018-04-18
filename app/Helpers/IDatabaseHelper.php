<?php namespace App\Helpers;

interface IDatabaseHelper
{
    public function getDataSourceResult();
    public function rawDatabaseConnection($connectionString);
    public function createDatabase($name);
}