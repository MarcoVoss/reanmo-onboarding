<?php
    class Orders extends Controller {
        public function __construct() {
            $this->orderModel = $this->model('Order');
            $this->cartModel = $this->model('ShoppingCart');
        }

        public function orders() {
            $data = $this->orderModel->getPastOrders($_SESSION['user_id']);
            $this->view('JsonView', $this->simplify($data));
        }

        public function order() {
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data['user_id'] = $_SESSION['user_id'];

            if(!$this->verifyOrder($data) or ($this->verifyOrder($data) and $this->cartModel->getOne($data)))
                ExceptionHelper::badRequestException();

            return $this->cartModel->create($data);
        }

        private function verifyOrder($data) {
            return isset($data) and isset($data['user_id']) and isset($data['product_id']) and isset($data['size_id']) and isset($data['amount']);
        }

        private function simplify($data) {
            $oders = [];
            foreach($data as $row) {
                if(isset($oders[$row->OId])) {
                    $oders[$row->OId]['products'][] = $this->generateProductObj($row);
                } else {
                    $oders[$row->PId] = $this->generateOrderObj($row);
                }
            }
            return array_values($oders);
        }

        private function generateProductObj($row) {
            return [
                'product_id' => $row->PId,
                'product_name' => $row->PName,
                'size_id' => $row->SId,
                'size_name' => $row->SName,
                'amount' => $row->Amount
            ];
        }

        private function generateOrderObj($row) {
            return [
                'id' => $row->OId,
                'date' => $row->Date,
                'price' => $row->Price,
                'products' => [$this->generateProductObj($row)]
            ];
        }
    }