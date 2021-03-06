<?php

class AddressableTest extends AddressableBuilder{

	function setUp() {
		parent::setUp();

	}

	function tearDown() {


		parent::tearDown();
	}

	function testAddressableWrite() {

		$silverStripe = new AddressableTestDataObject();
		$silverStripe->Address = '101-103 Courtenay Place';
		$silverStripe->City = 'Wellington';
		$silverStripe->ZIP = '6011';
		$silverStripe->Country = 'NZ';
		$silverStripe->write();
		$silverStripeID = $silverStripe->ID;

		$this->assertTrue($silverStripeID > 0);

		$dynamic = new AddressableTestDataObject();
		$dynamic->Address = '1526 South 12th Street';
		$dynamic->City = 'Sheboygan';
		$dynamic->State = 'WI';
		$dynamic->ZIP = '53081';
		$dynamic->Country = 'US';
		$dynamic->write();
		$dynamicID = $dynamic->ID;

		$this->assertTrue($dynamicID > 0);

		$addressable = AddressableTestDataObject::get()->byID($silverStripeID);
		$addressable2 = AddressableTestDataObject::get()->byID($dynamicID);


		$this->assertTrue($addressable->Address == '101-103 Courtenay Place');
		$this->assertTrue($addressable->City == 'Wellington');
		$this->assertTrue($addressable->ZIP == '6011');
		$this->assertTrue($addressable->Country == 'NZ');

		$this->assertTrue($addressable2->Address == '1526 South 12th Street');
		$this->assertTrue($addressable2->City == 'Sheboygan');
		$this->assertTrue($addressable2->State == 'WI');
		$this->assertTrue($addressable2->ZIP == '53081');
		$this->assertTrue($addressable2->Country == 'US');

	}

}
