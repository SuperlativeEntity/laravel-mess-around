<?php namespace App\Helpers;

// used by DataSourceResult helper

use PDO, PDOException;

class MySQLDatabaseHelper implements IDatabaseHelper
{
    public function getDataSourceResult()
    {
        return new DataSourceResult($this->connectionString(),env('DB_USERNAME'),env('DB_PASSWORD'));
    }

    public function rawDatabaseConnection($connectionString)
    {
        $databaseConnection = null;

        try
        {
            $databaseConnection = new PDO($connectionString, env('DB_USERNAME'), env('DB_PASSWORD'),[PDO::ATTR_TIMEOUT => "5"]);
            $databaseConnection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
        }

        return $databaseConnection;
    }

    private function connectionString()
    {
        $default    = env('DB_CONNECTION', 'mysql');
        $host       = env('DB_HOST');
        $database   = env('DB_DATABASE');
        $port       = env('DB_PORT');

        return "{$default}:host={$host};dbname={$database};port={$port};charset=utf8";
    }

    private function connectionStringNoDatabase()
    {
        $default    = env('DB_CONNECTION', 'mysql');
        $host       = env('DB_HOST');
        $port       = env('DB_PORT');

        return "{$default}:host={$host};port={$port};charset=utf8";
    }

    public function createDatabase($name)
    {
        $connection = $this->rawDatabaseConnection($this->connectionStringNoDatabase());

        if (is_object($connection))
        {
            try
            {
                $createDatabase = $connection->prepare("CREATE DATABASE {$name}");
                $createDatabase->execute([]);

                echo 'Database Successfully Created';
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                \Log::error('Failed to Create Database',['error'=>$e->getMessage(),'name'=>$name]);
            }
        }
    }
}