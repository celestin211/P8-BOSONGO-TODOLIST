<?php

namespace App\Tests\Controller;

use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use App\Tests\HelperLoginTrait;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserEditControllerTest extends WebTestCase
{
    use FixturesTrait;
    use HelperLoginTrait;

    /**
     * @var string
     */
    private $route;

    public function setUp()
    {
        $this->route = '/users/2/edit';
        $this->loadFixtures([UserFixtures::class]);
    }

    public function testRedirectToLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', $this->route);
        $this->assertResponseRedirects('/login');
    }

    public function testAccessWithAdmin(): void
    {
        $client = $this->login('admin');

        $client->request('GET', $this->route);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Modifier un utilisateur');
    }

    public function testDeniedAccessWithUser(): void
    {
        $client = $this->login('user');

        $client->request('GET', $this->route);
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testSuccessForm(): void
    {
        $client = $this->login('admin');

        $crawler = $client->request('GET', $this->route);
        $form = $crawler->selectButton('Modifier')->form([
            'user[username]' => 'Username',
            'user[password][first]' => 'password',
            'user[password][second]' => 'password',
            'user[email]' => 'email@email.com',
            'user[roles]' => ['ROLE_USER'],
        ]);
        $client->submit($form);

        $user = self::$container->get(UserRepository::class)->findOneByUsername('Username');
        $this->assertEquals('Username', $user->getUsername());

        $this->assertResponseRedirects('/users');
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert.alert-success');
    }

    public function testFailedForm(): void
    {
        $client = $this->login('admin');

        $crawler = $client->request('GET', $this->route);
        $form = $crawler->selectButton('Modifier')->form([
            'user[username]' => 'aze',
            'user[password][first]' => 'password',
            'user[password][second]' => 'fzefz',
            'user[email]' => 'email@email.com',
            'user[roles]' => ['ROLE_USER'],
        ]);
        $client->submit($form);
        $this->assertSelectorExists('.form-error-message');
    }
}
