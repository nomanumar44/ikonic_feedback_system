<?php

namespace App\Services;

use Exception;

class WhatsAppDynamicMessageService
{
    public function for_hafiz_sendWhatsAppMessage($customer_mobile_number,$customer_name,$item_name,$old_price,$new_price)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', "https://graph.facebook.com/v15.0/108458698763063/messages", [
                'headers' => [
                    "Authorization" => "Bearer EAATaXc2nDAsBAC2ZBWkDTVkeag0gQyKfSlM2lcgPLXkrHfaOlUEO2a0nSPgZCuZBw8wIARY0G549gZAfkWBcj8MtPjY9ma3OPzhaY4s03DXZCQhI4OJlmv2w7TeicMDcX9bnIISPSOcz8kw5JL4n0zkm7TjVAXuPplroPOtdpaalqNeisSsLq",
                    "Content-Type" => "application/json",
                ],
                'form_params' => [
                    "messaging_product" => "whatsapp",
                    "to" => $customer_mobile_number,
                    "type" => "template",
                    "template" => [
                        "name" => "bulk_message",
                        "language" => [
                            "code" => "en_US",
                        ],
                        "components" => [
                            [
                                "type" => "header",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $customer_name,
                                    ],
                                ],

                            ],
                            [
                                "type" => "body",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $item_name,
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $old_price,
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $new_price,
                                    ],
                                ],

                            ],
                        ],
                    ],
                ],
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }

    }

    public function for_shafqat_sendWhatsAppMessage($customer_mobile_number,$customer_name,$item_name,$old_price,$new_price)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', "https://graph.facebook.com/v15.0/105054145779321/messages", [
                'headers' => [
                    "Authorization" => "Bearer EAATaXc2nDAsBAC2ZBWkDTVkeag0gQyKfSlM2lcgPLXkrHfaOlUEO2a0nSPgZCuZBw8wIARY0G549gZAfkWBcj8MtPjY9ma3OPzhaY4s03DXZCQhI4OJlmv2w7TeicMDcX9bnIISPSOcz8kw5JL4n0zkm7TjVAXuPplroPOtdpaalqNeisSsLq",
                    "Content-Type" => "application/json",
                ],
                'form_params' => [
                    "messaging_product" => "whatsapp",
                    "to" => $customer_mobile_number,
                    "type" => "template",
                    "template" => [
                        "name" => "bulk_message",
                        "language" => [
                            "code" => "en_US",
                        ],
                        "components" => [
                            [
                                "type" => "header",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $customer_name,
                                    ],
                                ],

                            ],
                            [
                                "type" => "body",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $item_name,
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $old_price,
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $new_price,
                                    ],
                                ],

                            ],
                        ],
                    ],
                ],
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }

    }

}
