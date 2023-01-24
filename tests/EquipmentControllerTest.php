<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EquipmentControllerTest extends WebTestCase
{
    public function testEquipmentSearchAll(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/api/v1/equipments');

        // Validate a successful response and some content
        //$this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
       
    }
    public function testEquipmentSearchByName(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/api/v1/equipments/test');

        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
       
    }
    public function testEquipmentEquipmentCreate(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $client->xmlHttpRequest('POST', '/api/v1/equipments', ['name' => 'test name','category'=>'test category',"number"=>'1233','description'=>'test description']);

        //$this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
       
    }

    public function testEquipmentEquipmentUpdate(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $client->xmlHttpRequest('PATCH', '/api/v1/equipments/4/update', ['name' => 'tester name','category'=>'tester category',"number"=>'1233676','description'=>'tester description']);

        // Validate a successful response and some content
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
       
    }

    public function testEquipmentEquipmentDelete(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $client->xmlHttpRequest('DELETE', '/api/v1/equipments/5/delete');

        // Validate a successful response and some content
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
       
    }
}
?>
