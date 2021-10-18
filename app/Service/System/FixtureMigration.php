<?php
/**
 * FixtureMigration.php
 */


namespace App\Service\System;


use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;
use League\Csv\Statement;

class FixtureMigration
{
    public static function insert(): string
    {
        $config = [
            [
                'key' => 'products',
                'path' => 'resources/system/db_data/fixtures/products.csv',
                'model' => Product::class
            ],
            [
                'key' => 'users',
                'path' => 'resources/system/db_data/fixtures/users.csv',
                'model' => User::class
            ],
            [
                'key' => 'purchases',
                'path' => 'resources/system/db_data/fixtures/purchased.csv',
                'model' => Purchase::class
            ],
        ];

        $inserted = [];

        foreach ($config as $csvConfig) {

            $csv = Reader::createFromPath($csvConfig['path'], 'r');
            $stmt = Statement::create();
            $csv->setHeaderOffset(0);

            $records = $stmt->process($csv);

            /** @var Model $model */

            $count = 0;

            foreach ($records as $record) {

                $model = new $csvConfig['model'];

                foreach ($record as $key => $value) {
                    $model->setAttribute($key, $value);
                }
                $model->save();

                ++$count;
            }

            $inserted[] = $csvConfig['key'] . ': ' .  $count;
        }

        if (count($inserted) === 0) {
            $resultFeedback = 'FixtureMigration: Nothing was inserted';
        } else {
            $resultFeedback = 'FixtureMigration inserted csvs: ' . implode(', ', $inserted);
        }

        return  $resultFeedback;
    }
}