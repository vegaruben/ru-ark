<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 07/11/17
 * Time: 8:26
 */
use Funnlz\Services\ServiceException;
use Funnlz\Entities\DataTablesPaging;
use Funnlz\Entities\Product as ProductEntity;
use Funnlz\Entities\Media;

class Products extends RegisteredUserController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->data['v'] = 'products/index';
        $this->data['meta_title'] = 'Products';
        $this->data['meta_desc'] = 'Products';
        $this->data['slug'] = 'products';
        $this->data['jsfiles'] = array('product.js');

        $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Products');
        $this->load->view('template_registered',  $this->data);
    }
    protected function guidv4()
    {
        $data = random_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    private function uploadProductImage(){
        //var_dump($this->container['config']);exit();
        $this->load->helper(array('form', 'url'));

        $config = $this->container['config']['ProductImageUpload'];

        //create dir based on userid
        $user_dir = $config['upload_path'].'/'.$this->get_user_id().'/products';
        if(!file_exists($user_dir)){
            if(!mkdir($user_dir,0777, true)){
                return ['status'=>'error', 'messages'=> 'Can not create user directory: '.$user_dir];
            }
        }
        //save image to that dir
        $config['upload_path'] = $user_dir;

        $this->load->library('upload', $config);
        $fieldName = isset($_FILES['file']) ? 'file' : 'userfile';

        if ( ! $this->upload->do_upload($fieldName)) {
            $error = array('error' => $this->upload->display_errors());
            return ['status'=>'error', 'messages'=> $this->upload->display_errors(). $config['upload_path']];
        }
        else {
            $data = $this->upload->data();
            $raw_name = $data['raw_name'];
            $ext = $data['file_ext'];
            $new_name = sprintf('%s_%s%s', $raw_name, $this->guidv4(), $ext);
            rename($data['full_path'], $data['file_path'].$new_name);
            $data['new_name'] = $new_name;
            return ['status'=>'success', 'messages'=> $data];
        }
    }
    public function entry($id = 0){
        $this->load->helper('currency');

        $product = new ProductEntity();

        if($this->isPost()){
            $product->bind($_POST);
            $product->id = $id==0 ? NULL : $id;
            $product->ownerId = $this->get_user_id();

            if($product->validate()) {
                $svc = $this->container['productService'];
                try{
                    //upload image
                    if (empty($_FILES['userfile']['name'])) {

                    }else{
                        $ret= $this->uploadProductImage();
                        if($ret['status']=='error'){
                            $this->session->set_flashdata('error', 'Failed to upload product image: '.$ret['messages']);
                        }else {
                            $product->picture = $ret['messages']['new_name'];
                        }
                    }

                    $ret = $svc->save($product);
                    if($ret){
                        $this->session->set_flashdata('success','Product saved');
                        return redirect('/products/','refresh');
                    }else{
                        $this->session->set_flashdata('error', 'Failed to save product');
                    }

                }catch(ServiceException $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }else{
                $this->session->set_flashdata('error', $product->error_messages());
            }
            $this->data['product'] = $product;
        }else{
            if($id!==0){
                $svc = $this->container['productService'];
                $product = $svc->findByIdAndOwner($id, $this->get_user_id());
                if($product==NULL){
                    $this->session->set_flashdata('success','Product not found');
                    return redirect('/products/','refresh');
                }
            }
        }

        if($id==0){
            $this->data['meta_title'] = 'Add Product';
            $this->data['meta_desc'] = 'Add Product';
            $this->data['slug'] = 'products';
            $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Add Product');
        }else{
            $this->data['meta_title'] = 'Edit Product';
            $this->data['meta_desc'] = 'Edit Product';
            $this->data['slug'] = 'products';
            $this->data['menu'] = array('url' => $this->data['slug'] , 'display' => 'Edit Product');
        }
        $this->data['v'] = 'products/entry';
        $this->data['jsfiles'] = array('dropzone.js','product.js');
        $this->data['product'] = $product;
        $this->load->view('template_registered',  $this->data);
    }

    public function delete(){
        $product = new ProductEntity();

        $product->bind($_POST);
        $product->ownerId = $this->get_user_id();
        $svc = $this->container['productService'];
        try{
            $ret = $svc->delete($product);
            if($ret){
                echo 'Product deleted';
            }else{
                echo 'Failed to delete product';
            }
        }catch(ServiceException $e){
            echo $e->getMessage();
        }
    }

    /*ajax*/
    public function search_products(){
        $form = new DataTablesPaging();
        $cols = array('SKU','name','description', 'urlToBuy','id');
        $form->setValidColumns($cols);

        $form->bind($_POST);
        if(!$form->validate()){
            echo 'error bind paging'.$form->error_messages();
        }else{

            $this->load->helper('datatables');

            $svc = $this->container['productService'];
            $result = $svc->search($this->get_user_id(), $form);
            //echo json_encode($result);
            datatables_json($result,$cols);
        }
    }
    public function upload_product_image(){
       echo json_encode($this->uploadProductImage());
    }
}