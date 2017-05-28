<?php
namespace Transformatika\Account\Test;

use PHPUnit\Framework\TestCase;
use Transformatika\Account\Model\AccountReaderModel;

class AccountReaderTest extends TestCase
{
    public function testGetDetail()
    {
        $account = new AccountReaderModel();
        $data = $account->getDetail(uniqid());
        // Return must have records key
        $this->assertArrayHasKey('records', $data);
    }
}
