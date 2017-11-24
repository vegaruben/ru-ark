<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 15:38
 */

namespace Funnlz\Services;


use Pimple\Container;

use Funnlz\Entities\Paging;
use Funnlz\Entities\PagingResult;
use Funnlz\Entities\Product;

use Funnlz\Mappers\UserMapper;
use Funnlz\Mappers\ProductMapper;


class ProductService
{
    private $app;
    private $mapper = NULL;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->getMapper();
    }

    protected function getMapper()
    {
        if ($this->mapper == NULL) {
            $this->mapper = new ProductMapper($this->app['pdo_adapter']);
        }
        return $this->mapper;
    }
    public function save(Product $product){
        //validate
        if(!empty($product->id)){
            $existing = $this->findByIdAndOwner($product->id, $product->ownerId);
            if($existing==NULL){
                throw  new ServiceException('Product not found');
            }
            //if this is new file then delete prev image on the server
            if(!empty($product->picture)){
                $config = $this->app['config']['ProductImageUpload'];

                if(!empty($existing->picture) && ($product->picture != $existing->picture)){
                    $exPic = $config['upload_path'].'/'.$existing->ownerId.'/products/'.$existing->picture;
                    if(file_exists($exPic)){
                        unlink($exPic);
                    }
                }

            }else{
                $product->picture = $existing->picture;
            }

        }
        return $this->mapper->save($product);
    }
    public function findByIdAndOwner($id, $ownerId){
        return $this->mapper->findByIdAndOwner($id, $ownerId);
    }

    public function delete(Product $product){
        $existing = $this->findByIdAndOwner($product->id, $product->ownerId);
        if($existing==NULL){
            throw  new ServiceException('Product not found');
        }
        return $this->mapper->delete($product->id);
    }

    public function getRecentProducts($ownerId){
        $paging = new Paging();
        $paging->setPageSize(5);
        $paging->setSort('createdDate','desc');

        return $this->mapper->search($ownerId, $paging);
    }
    /**
     * search product of this user
     * @param $ownerId
     * @param Paging pagination
     * @return NULL or list of products in PagingResult
     */
    public function search($ownerId, Paging $paging){
        return $this->mapper->search($ownerId, $paging);
    }


}