<?php
namespace API\Account\Test;

use PHPUnit\Framework\TestCase;
use API\Account\Model\AccountModel;

class AccountModelTest extends TestCase
{
    public function testGetAccountDetailById()
    {
        $account = new AccountModel();
        $data = $account->getAccountById(uniqid());
        $this->assertArrayHasKey('records', $data);
    }

    public function testGetAccountDetailByEmail()
    {
        $account = new AccountModel();
        $data = $account->getAccountById(uniqid());
        $this->assertArrayHasKey('records', $data);
    }

    public function testChangePassword()
    {
        $account = new AccountModel();
        $data = $account->changePassword(uniqid(), array());
        $this->assertArrayHasKey('records', $data);
    }

    public function testChangeProfile()
    {
        $account = new AccountModel();
        $data = $account->changeProfile(uniqid(), array());
        $this->assertArrayHasKey('records', $data);
    }
}
