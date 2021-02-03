<?php

namespace App;

use App\MongoDBRepository;
use App\SchemaValidator;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;


/**
 * @property Request $request
 * @property Response $response
 */
class CeeController extends Controller
{
    /**
     * Add new Cee
     */
    public function bulk()
    {
        $payload = json_decode($this->request->getRawBody(), true);
        if (json_last_error() !== JSON_ERROR_NONE) throw new \Exception("JSON Invalid", 1);

        $result = (new MongoDBRepository($this->di->get('mongoDB')))
                        ->bulk($payload);

        if (null == $result) {
            return $this->response->setStatusCode(422, 'Unprocessable Entity')->send();
        }

        return $this->response->setStatusCode(201, 'Created')->setJsonContent($result->getInsertedCount())->send();
    }

    /**
     * Add new Cee
     */
    public function add()
    {
        $payload = json_decode($this->request->getRawBody(), true);
        if (json_last_error() !== JSON_ERROR_NONE) throw new \Exception("JSON Invalid", 1);

        // DTD
        $jsonSchemaObject = json_decode(file_get_contents(dirname(__DIR__) . '/dtd/cee.dtd'));

        // Validator
        $validator = new SchemaValidator($jsonSchemaObject);
        $errors = $validator->validate(json_decode($this->request->getRawBody()))->getErrors();
        
        if (!empty($errors)) {
            return $this->response->setStatusCode(422, 'Unprocessable Entity')->setJsonContent($errors)->send();
        }

        $document = (new MongoDBRepository($this->di->get('mongoDB')))
                        ->create($payload);

        if (null == $document) {
            return $this->response->setStatusCode(422, 'Unprocessable Entity')->send();
        }

        return $this->response->setStatusCode(201, 'Created')->setJsonContent($document->getInsertedId())->send();
    }

    /**
     * Get a Cee
     */
    public function view(string $version, string $name)
    {
        $document = (new MongoDBRepository($this->di->get('mongoDB')))
                        ->findByKey(['version' => $version, 'name' => $name]);

        if (null == $document) {
            return $this->response->setStatusCode(404, 'Not Found')->send();
        }

        return $this->response->setStatusCode(200, 'OK')->setJsonContent($document)->send();
    }

    /**
     * Delete a Cee
     */
    public function delete(string $version, string $name)
    {
        $document = (new MongoDBRepository($this->di->get('mongoDB')))
                        ->delete(['version' => $version, 'name' => $name]);

        return $this->response->setStatusCode(204, 'Resource Deleted')->setJsonContent($document->getDeletedCount())->send();
    }

    /**
     * Cumac
     */
    public function cumac(string $version, string $name)
    {
        $payload = json_decode($this->request->getRawBody(), true);
        if (json_last_error() !== JSON_ERROR_NONE) throw new \Exception("JSON Invalid", 1);

        $document = (new MongoDBRepository($this->di->get('mongoDB')))
                        ->findByKey(['version' => $version, 'name' => $name]);

        if (null == $document) {
            return $this->response->setStatusCode(404, 'Not Found')->send();
        }

        // Call resolver
        $result = (new Resolver($document, $payload))->resolve();

        // Array errors
        if ( is_array($result))
        {
            return $this->response->setStatusCode(400, 'Bad Request')->setJsonContent($result)->send();    
        }
        
        return $this->response->setStatusCode(200, 'OK')->setJsonContent(["cumac" => $result])->send();
    }

}