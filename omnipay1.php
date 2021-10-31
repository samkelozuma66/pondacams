<?php

    use Omnipay\PayPal;
    
    echo "test";
    class OmnipayTest 
    {
        public function tearDown(): void
        {
            Omnipay::setFactory(null);
    
            parent::tearDown();
        }
    
        public function testGetFactory()
        {
            Omnipay::setFactory(null);
    
            $factory = Omnipay::getFactory();
            $this->assertInstanceOf('Omnipay\Common\GatewayFactory', $factory);
        }
    
    
        /**
         * Verify a new Client instance can be instantiated
         */
        public function testNewClient()
        {
            $client = new Client();
    
            $this->assertInstanceOf('Omnipay\Common\Http\Client', $client);
        }
    }
    $test = new OmnipayTest;
    $test->tearDown();

?>