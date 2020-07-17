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
        $schema = "CREATE TABLE workouts(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    program_id INTEGER,
                    date TEXT DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY(program_id) REFERENCES programs(id)
                );";
        self::$database->prepare($schema)->execute();
        $schema = "CREATE TABLE components(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    workout_id INTEGER,
                    exercise_id INTEGER,
                    FOREIGN KEY(workout_id) REFERENCES workouts(id),
                    FOREIGN KEY(exercise_id) REFERENCES exercises(id)
                );";
        self::$database->prepare($schema)->execute();
        $schema = "CREATE TABLE component_sets(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    component_id INTEGER,
                    weight FLOAT,
                    reps INTEGER,
                    FOREIGN KEY(component_id) REFERENCES components(id)
                );";
        self::$database->prepare($schema)->execute();
        $schema = "CREATE TABLE program_exercises(
                    program_id INTEGER,
                    exercise_id INTEGER,
                    FOREIGN KEY(program_id) REFERENCES programs(id),
                    FOREIGN KEY(exercise_id) REFERENCES exercises(id)
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
