<?php

namespace FretePersonal\Frenet\Controller\Cotacao;

use Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Context;


class Result extends \Magento\Framework\App\Action\Action {
    const XML_PATH_API_TOKEN = 'frenet_api/api/api_token';

    public function generateQuotation($sellercep, $recipientcep, $recipientcountry, $shipmentinvoicevalue, $weight, $length, $height, $width, $quantity) {
        //$api_token = $this->helper('FretePersonal\Frenet\Helper\Data')->getConfig(self::XML_PATH_API_TOKEN);
        $api_token = $this->_objectManager->create('FretePersonal\Frenet\Helper\Data')->getConfig(self::XML_PATH_API_TOKEN);

        $arrForm['SellerCEP'] = $sellercep;
        $arrForm['RecipientCEP'] = $recipientcep;
        $arrForm['ShipmentInvoiceValue'] = $shipmentinvoicevalue;
        $arrForm['RecipientCountry'] = $recipientcountry;
        $arrForm['ShippingItemArray'] = array(
            'Weight' => $weight,
            'Length' => $length,
            'Height' => $height,
            'Width' => $width,
            'Quantity' => $quantity,
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api.frenet.com.br/shipping/quote");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrForm));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "token:$api_token",
        ));

        $response = curl_exec($ch);

        if (FALSE === $response) {
            echo "Curl ERROR: ";
            echo curl_error($ch);
            echo "\r\nCurl error no: ";
            echo curl_errno($ch);
            echo "\r\n";
        }

        curl_close($ch);
        return $response;
    }

    public function execute() {
        $post = $this->getRequest()->getPost();

        if ($post) {
            $sellercep = $post['sellercep'];
            $recipientcep = $post['recipientcep'];
            $recipientcountry = $post['recipientcountry'];
            $shipmentinvoicevalue = $post['shipmentinvoicevalue'];
            $weight = $post['weight'];
            $length = $post['length'];
            $height = $post['height'];
            $width = $post['width'];
            $quantity = $post['quantity'];

            $quotation = $this->generateQuotation($sellercep, $recipientcep, $recipientcountry, $shipmentinvoicevalue, $weight, $length, $height, $width, $quantity);

            // Display the succes form validation message
            $this->messageManager->addSuccessMessage("$quotation");

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/frenetfrontend/cotacao/form');

            return $resultRedirect;
        }

    }

}