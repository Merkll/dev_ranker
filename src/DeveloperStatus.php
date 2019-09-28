<?php

namespace Merkll\DeveloperStatus;

require_once 'vendor/autoload.php';

class DeveloperStatus
{
    private $username;
    private static $messages = [
        "junior" => "Damn It!!! Please make the world better, Oh Ye Prodigal Junior Developer",
        "associate" => "Keep Up The Good Work, I crown you Associate Developer",
        "senior" => "Yeah, I crown you Senior Developer. Thanks for making the world a better place",
        "default" => "I guess you are not a developer"
    ];

    public function __construct($username){
        $this->username = $username;
    }

    public function getStatus() {
        $profile = $this->getUserProfile();

        return $this->getUserDevRankFromProfile($profile);
    }

    private function getUserDevRankFromProfile($profile) {
        $numberOfRepos = $profile->public_repos;
        $message = "default";

        switch ($numberOfRepos) {
            case ($numberOfRepos >= 5 && $numberOfRepos <= 10):
                $message = "junior";
                break;
            case ($numberOfRepos >= 11 && $numberOfRepos <= 20):
                $message = "assoiate";
                break;
            case ($numberOfRepos >= 21):
                $message = "senior";
                break;
        };

        return self::$messages[$message];
    }

    private function getUserProfile() {
        $url = "https://api.github.com/users/$this->username";
        $curl = new \Curl\Curl();

        return json_decode($curl->get($url)->response);
    }
}
