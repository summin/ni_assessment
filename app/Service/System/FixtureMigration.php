<?php
/**
 * FixtureMigration.php
 *
 * @author Aleksandr Leontjev <a.leontjev@pyrexx.com>
 * @copyright 2021 Pyrexx GmbH
 */


namespace App\Service\System;


use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
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

        foreach ($config as $csvConfig) {
            $csv = Reader::createFromPath($csvConfig['path'], 'r');
            $stmt = Statement::create();
            $csv->setHeaderOffset(0);

            $records = $stmt->process($csv);


            $str = '';

            foreach ($records as $record) {

                $model = new $csvConfig['model'];

                foreach ($record as $key => $value) {
                    $model->setAttribute($key, $value);
                }
                $model->save();

            }
        }

        return 'FixtureMigration insertion: success';
    }
}