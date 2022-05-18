<?php

declare(strict_types=1);

namespace App\Tests\UseCase;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ConnectionException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use function assert;

abstract class UseCaseTestCase extends WebTestCase
{
    protected Connection $dbal;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        self::bootKernel();
        $this->dbal = self::getFromContainer(Connection::class);
        $this->dbal->beginTransaction();
        //parent::setUp();
    }

    /**
     * @throws ConnectionException
     */
    protected function tearDown(): void
    {
        $this->dbal->rollBack();
        parent::tearDown();
    }

    /**
     * @param class-string $class
     *
     * @return object
     *
     * @noinspection PhpMixedReturnTypeCanBeReducedInspection
     */
    protected static function getFromContainer(string $class): mixed
    {
        $object = self::getContainer()->get($class);
        assert($object instanceof $class);

        return $object;
    }

    public function assertRequestNotFound(string $method, string $uri): void
    {
        $this->client->request($method, $uri, [], [], [], '{}');
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    public function assertSuccessRequest(string $method, string $uri): void
    {
        $this->client->request($method, $uri, [], [], [], '{}');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
