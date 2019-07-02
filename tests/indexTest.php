<?php

use JournalMedia\Sample\Http\Controller\PublicationRiverController;

class IndexTest extends PHPUnit_Framework_TestCase 
{
    public function testFetchAPI()
    {
        $indexController = new PublicationRiverController();
        $this->assertTrue( is_array($indexController->fetchAPI()) );
    }

    public function testFetchFile()
    {
        $indexController = new PublicationRiverController();
        $this->assertTrue( is_array($indexController->fetchFile()) );
    }
}