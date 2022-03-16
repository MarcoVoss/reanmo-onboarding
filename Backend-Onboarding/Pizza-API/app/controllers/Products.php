<?php
    class Products extends Controller {
        public function __construct() {
            $this->productModel = $this->model('Product');
        }

        public function products() {
            $data = $this->productModel->getAll();
            $this->view('JsonView', $this->simplify($data));
        }

        private function simplify($data) {
            $test = [];
            foreach($data as $row) {
                if(isset($test[$row->PId])) {
                    $test[$row->PId]['sizes'][] = $this->generateSizeObj($row);
                } else {
                    $test[$row->PId] = $this->generateProductObj($row);
                }
            }
            return array_values($test);
        }

        private function generateSizeObj($row) {
            return [
                'id' => $row->SId,
                'name' => $row->SName,
                'price' => $row->Price,
            ];
        }

        private function generateProductObj($row) {
            return [
                'id' => $row->PId,
                'name' => $row->PName,
                'category' => $row->CName,
                'image_path' => $row->Path,
                'sizes' => [ $this->generateSizeObj($row)]
            ];
        }
    }