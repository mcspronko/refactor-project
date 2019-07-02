<?php

use JournalMedia\Sample\Http\Controller\TagRiverController;

class TagTest extends PHPUnit_Framework_TestCase 
{
    public function testTagFetchAPI()
    {
        $tagController = new TagRiverController();
        $tagController->setTag("google");

        $this->assertTrue( is_array($tagController->fetchAPI()) );

        $tagController2 = new TagRiverController();
        $tagController2->setTag("microsoft");

        $this->assertTrue( is_array($tagController2->fetchAPI()) );
    }

    public function testTagFetchFile()
    {
        $tagController = new TagRiverController();
        $tagController->setTag("google");

        $this->assertTrue( is_array($tagController->fetchFile()) );

        $tagController2 = new TagRiverController();
        $tagController2->setTag("microsoft");

        $this->assertTrue( is_array($tagController2->fetchFile()) );
    }
}