<?php declare(strict_types=1);
namespace App\Tests\Storage;

use PHPUnit\Framework\TestCase;
use App\Storage\Exercise;
final class ExerciseTest extends TestCase
{
    private static $database;
    private static $dbPath = '/tmp/testdb.db';
    public static function setUpBeforeClass(): void
    {
        self::$database = new \PDO('sqlite:'.self::$dbPath);
        self::$database->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        $schema = "CREATE TABLE exercises(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name
                );";
        self::$database->prepare($schema)->execute();
    }
    public static function tearDownAfterClass(): void
    {
        unlink(self::$dbPath);
    }

    public function testCreateNewExerciseAndInsert(): void
    {
        $exercise = \App\Business\Exercise::fromString("dbtest");
        $id = Exercise::insert($exercise);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }

    public function testGetExerciseFromStorage(): void
    {
        $name = "dbtest";
        $expectedExercise = \App\Business\Exercise::fromString($name);
        $id = Exercise::insert($exercise);
        $actualExercise = Exercise::fetchById($id);
        $this->assertInstanceOf(
            \App\Business\Exercise::class,
            $actualExercise
        );
        $this->assertEquals($name, $actualExercise->getName());
    }
}
