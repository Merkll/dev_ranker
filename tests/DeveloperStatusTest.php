<?php

namespace Merkll\DeveloperStatus;

use \PHPUnit\Framework\TestCase;
use \Curl\Curl;
use Merkll\DeveloperStatus\DeveloperStatus;


class DeveloperStatusTest extends TestCase
{
    private static $messages = [
        "junior" => "Damn It!!! Please make the world better, Oh Ye Prodigal Junior Developer",
        "associate" => "Keep Up The Good Work, I crown you Associate Developer",
        "senior" => "Yeah, I crown you Senior Developer. Thanks for making the world a better place",
        "default" => "I guess you are not a developer"
    ];

    public function invokeMethod(&$object, $methodName, array $parameters = array()) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testGetUserProfileTest() {
        $devStatus = new DeveloperStatus("name");

        $profile = $this->invokeMethod($devStatus, 'getUserProfile');

        $this->assertIsObject($profile);
        $this->assertObjectHasAttribute('public_repos', $profile);
    }

    public function testGetUserDevRankFromProfile() {
        $devStatus = new DeveloperStatus("name");
        $profile = (Object) ["public_repos" => 30];

        $status = $this->invokeMethod($devStatus, 'getUserDevRankFromProfile', [$profile]);

        $this->assertEquals($status, self::$messages["senior"]);
    }

    public function testGetStatus() {
        $devStatus = new DeveloperStatus("name");

        $status = $devStatus->getStatus();

        $this->assertEquals($status, self::$messages["junior"]);
    }
}

