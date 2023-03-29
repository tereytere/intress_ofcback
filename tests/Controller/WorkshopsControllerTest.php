<?php

namespace App\Test\Controller;

use App\Entity\Workshops;
use App\Repository\WorkshopsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkshopsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private WorkshopsRepository $repository;
    private string $path = '/workshops/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Workshops::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Workshop index');

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
            'workshop[name]' => 'Testing',
            'workshop[schedule]' => 'Testing',
            'workshop[personal]' => 'Testing',
            'workshop[signins]' => 'Testing',
        ]);

        self::assertResponseRedirects('/workshops/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Workshops();
        $fixture->setName('My Title');
        $fixture->setSchedule('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Workshop');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Workshops();
        $fixture->setName('My Title');
        $fixture->setSchedule('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'workshop[name]' => 'Something New',
            'workshop[schedule]' => 'Something New',
            'workshop[personal]' => 'Something New',
            'workshop[signins]' => 'Something New',
        ]);

        self::assertResponseRedirects('/workshops/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getSchedule());
        self::assertSame('Something New', $fixture[0]->getPersonal());
        self::assertSame('Something New', $fixture[0]->getSignins());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Workshops();
        $fixture->setName('My Title');
        $fixture->setSchedule('My Title');
        $fixture->setPersonal('My Title');
        $fixture->setSignins('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/workshops/');
    }
}
