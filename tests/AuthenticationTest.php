<?php

declare(strict_types=1);

/**
 * This file is part of the Horizons package.
 *
 * (c) Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests;

final class AuthenticationTest extends AbstractTestCase
{
    public function testAdminResource()
    {
        $response = $this->createClientWithCredentials()->request('GET', '/api');
        $this->assertResponseIsSuccessful();
    }

    public function testLoginAsUser()
    {
        $token = $this->getToken([
            'username' => 'test_user',
            'password' => '$3cr3t',
        ]);

        $response = $this->createClientWithCredentials($token)->request('GET', '/api');
        $this->assertJsonContains(['hydra:description' => 'Access Denied.']);
        $this->assertResponseStatusCodeSame(403);
    }
}
