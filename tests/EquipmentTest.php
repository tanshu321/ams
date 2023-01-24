<?php
namespace App\Tests\Entity;

use App\Entity\Equipment;
use PHPUnit\Framework\TestCase;

class EquipmentTest extends TestCase
{
    public function testSettingEquipmentName()
    {
        $equipment = new Equipment();
        $name = 'iPhone';

        $equipment->setName($name);

        $this->assertEquals($name, $equipment->getName());
    }

    public function testSettingEquipmentCategory()
    {
        $equipment = new Equipment();
        $category = 'telephone';

        $equipment->setCategory($category);

        $this->assertEquals($category, $equipment->getCategory());
    }

    public function testSettingEquipmentNumber()
    {
        $equipment = new Equipment();
        $number = '124356';

        $equipment->setNumber($number);

        $this->assertEquals($number, $equipment->getNumber());
    }

    public function testSettingEquipmentDescription()
    {
        $equipment = new Equipment();
        $des = 'This is test';

        $equipment->setDescription($des);

        $this->assertEquals($des, $equipment->getDescription());
    }

    
}
