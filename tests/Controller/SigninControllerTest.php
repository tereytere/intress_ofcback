<?php

namespace App\Test\Controller;

use App\Entity\Signin;
use App\Repository\SigninRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SigninControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SigninRepository $repository;
    private string $path = '/signin/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Signin::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Signin index');

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
            'signin[holidays]' => 'Testing',
            'signin[workshops]' => 'Testing',
            'signin[user]' => 'Testing',
            'signin[timeStart]' => 'Testing',
            'signin[timeStop]' => 'Testing',
            'signin[timeFinish]' => 'Testing',
            'signin[hourCount]' => 'Testing',
        ]);

        self::assertResponseRedirects('/signin/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Signin();
        $fixture->setHolidays('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setUser('My Title');
        $fixture->setTimeStart('My Title');
        $fixture->setTimeStop('My Title');
        $fixture->setTimeFinish('My Title');
        $fixture->setHourCount('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Signin');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Signin();
        $fixture->setHolidays('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setUser('My Title');
        $fixture->setTimeStart('My Title');
        $fixture->setTimeStop('My Title');
        $fixture->setTimeFinish('My Title');
        $fixture->setHourCount('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'signin[holidays]' => 'Something New',
            'signin[workshops]' => 'Something New',
            'signin[user]' => 'Something New',
            'signin[timeStart]' => 'Something New',
            'signin[timeStop]' => 'Something New',
            'signin[timeFinish]' => 'Something New',
            'signin[hourCount]' => 'Something New',
        ]);

        self::assertResponseRedirects('/signin/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getHolidays());
        self::assertSame('Something New', $fixture[0]->getWorkshops());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getTimeStart());
        self::assertSame('Something New', $fixture[0]->getTimeStop());
        self::assertSame('Something New', $fixture[0]->getTimeFinish());
        self::assertSame('Something New', $fixture[0]->getHourCount());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Signin();
        $fixture->setHolidays('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setUser('My Title');
        $fixture->setTimeStart('My Title');
        $fixture->setTimeStop('My Title');
        $fixture->setTimeFinish('My Title');
        $fixture->setHourCount('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/signin/');
    }
}
