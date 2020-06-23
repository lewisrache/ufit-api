<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
class WorkoutAppBaseTestCase extends TestCase
{
    protected static $database;
    protected static $dbPath = '/tmp/testdb.db';
    public static function setUpDB(): void
    {
        self::$database = new \PDO('sqlite:'.self::$dbPath);
        self::$database->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        $schema = "CREATE TABLE users(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name
                );";
        self::$database->prepare($schema)->execute();
        $schema = "CREATE TABLE exercises(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name
                );";
        self::$database->prepare($schema)->execute();
        $schema = "CREATE TABLE programs(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER,
                    name,
                    FOREIGN KEY(user_id) REFERENCES users(id)
                );";
        self::$database->prepare($schema)->execute();
    }

    public static function setUpBeforeClass(): void
    {
        self::setUpDB();
    }
    public static function tearDownAfterClass(): void
    {
        unlink(self::$dbPath);
    }
}
