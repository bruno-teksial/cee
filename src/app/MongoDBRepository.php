<?php

namespace App;

use MongoDB\Collection;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

/**
 * @property Request $request
 * @property Response $response
 */
class MongoDBRepository
{
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function findByKey(array $filters)
    {
        try {
            return $this->collection->findOne($filters);
        }
        catch (InvalidArgumentException $e) {
            // logger
            echo "Unable to find Document :\n";
            echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function create(array $payload)
    {
        try {
            return $this->collection->insertOne($payload);
        }
        catch (InvalidArgumentException $e) {
            // logger
            echo "Unable to add to Table :\n";
            echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function bulk(array $payload = [])
    {
        try {
            return $this->collection->insertMany($payload);
        }
        catch (InvalidArgumentException $e) {
            // logger
            echo "Unable to add to Table :\n";
            echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function delete(array $keys)
    {
        try {
            return $this->collection->deleteOne($keys);
        }
        catch (InvalidArgumentException $e) {
            // logger
            echo "Unable to add to Table :\n";
            echo $e->getMessage() . "\n";
            return null;
        }
    }

}