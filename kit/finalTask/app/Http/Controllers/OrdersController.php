<?php

namespace App\Http\Controllers;

class OrdersController extends Controller {

    private $_retailCrmClient;
    protected $response;

    public function __construct() {
        $this->_retailCrmClient = new \RetailCrm\ApiClient(
            '',
            '',
            \RetailCrm\ApiClient::V4
        );
    }

    public function processOrder($id) {
        $data = $this->getOrderData($id);
        if (empty($data)) {
            return 'Order data is empty';
        }
        $customerId = $this->createCustomer($data);
//        var_dump($customerId);
        $newOrder   = $this->createOrder($data, $customerId);
    }

    public function getOrderData($id) {
        $data = file_get_contents("http://kit-consulting-dev.ru/test/orders/get?".$id);
        return json_decode($data, true)['result'] ?? [];
    }

    public function createCustomer($data, $site = null) {
        $customer = [
            'firstName'  => $data['first_name'],
            'patronymic' => $data['middle_name'],
            'lastName'   => $data['last_name'],
            'email'      => $data['email'],
            'address'    => [
                'index'    => '666679',
                'region'   => 'Irkutskaya obl.',
                'city'     => "Ust'-Ilimsk",
                'street'   => 'Druzhbi Narodov',
                'building' => '4',
                'flat'     => '4'
            ],
        ];

        if (!count($customer)) {
            throw new \InvalidArgumentException(
                'Parameter `customer` must contains a data'
            );
        }
        /**
         *
         */
        $newCustomer = $this->_retailCrmClient->request->customersCreate($customer);
        $customerId = $newCustomer->getResponse();
        return $customerId['id'];
    }

    public function createOrder($data, $customerId) {
        try {
            $this->response = $this->_retailCrmClient->request->ordersCreate([
                'externalId' => $data['id'],
                'firstName'  => $data['first_name'],
                'lastName'   => $data['last_name'],
                'items'      => $data['items'],
                'customer'   => [
                    'id' => $customerId,
                ],
                'delivery'   => [
                    'code' => 'russian-post',
                ],
            ]);
        } catch (\RetailCrm\Exception\CurlException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        if ($this->response->isSuccessful() && 201 === $this->response->getStatusCode()) {
            echo 'Order successfully created. Order ID into retailCRM = ' . $this->response->id;
        } else {
            echo sprintf(
                "Error: [HTTP-code %s] %s",
                $this->response->getStatusCode(),
                $this->response->getResponseBody()
            );
        }
    }
}
