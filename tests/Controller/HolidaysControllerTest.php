<?php

namespace App\Test\Controller;

use App\Entity\Holidays;
use App\Repository\HolidaysRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HolidaysControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private HolidaysRepository $repository;
    private string $path = '/holidays/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Holidays::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Holiday index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'holiday[date]' => 'Testing',
            'holiday[personal]' => 'Testing',
            'holiday[signins]' => 'Testing',
        ]);

        self::assertResponseRedirects('/holidays/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Holidays();
        $fixture->setDate('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Holiday');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Holidays();
        $fixture->setDate('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'holiday[date]' => 'Something New',
            'holiday[personal]' => 'Something New',
            'holiday[signins]' => 'Something New',
        ]);

        self::assertResponseRedirects('/holidays/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getPersonal());
        self::assertSame('Something New', $fixture[0]->getSignins());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Holidays();
        $fixture->setDate('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/holidays/');
    }
}
