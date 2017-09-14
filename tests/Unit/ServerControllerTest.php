<?php

namespace Tests\Unit\Authentication;

use App\Ram;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Server;

class ServerControllerTest extends TestCase
{

    use DatabaseMigrations;

    protected $user;

    protected $server;

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->server = factory(Server::class)->create();
    }

    public function testUserCanCreateServer()
    {
        $serverDetails = [
            'asset_id' => 123,
            'name' => 'Dell',
            'brand' => 'R210'
        ];

        $this->user->servers()->create($serverDetails);
        $this->assertDatabaseHas('servers', $serverDetails);
    }

    public function testUserCanCreateServerWithRam()
    {
        $serverRams = [
            [
                'size' => 3,
                'type' => 'DDR1'
            ],
            [
                'size' => 4,
                'type' => 'DDR1'
            ],
        ];

        $this->server->rams()->createMany($serverRams);

        $this->assertDatabaseHas('rams', $serverRams[0]);
    }

    public function testUserCanUpdateServer()
    {
        $updateDetails = [
            'name' => 'Dell'
        ];
        $this->server->update($updateDetails);

        $this->assertEquals('Dell', $this->server->name);
    }

    public function testUserCanReadServer()
    {
        $this->user->servers()->save($this->server);
        $userServers = $this->user->load(['servers']);
        $this->assertTrue(is_array($userServers->toArray()));
    }

    public function testUserCanRemoveServer()
    {
        $serverDetails = [
            'asset_id' => 123,
            'name' => 'Dell',
            'brand' => 'R210'
        ];

        $server = $this->user
            ->servers()
            ->create($serverDetails);

        Server::where('id', $server->id)->delete();

        $this->assertNull(Server::find($server->id));
    }
}
