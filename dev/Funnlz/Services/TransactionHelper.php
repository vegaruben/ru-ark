<?php
namespace Funnlz\Services;

use Pimple\Container;


class TransactionHelper{
    /**
     * enable transaction in an application, make sure to call this function in top level service
     * @param Application $app
     * return void
     */
    public static function enableTransaction(Container &$app){
        if(isset($app['use_transaction']) && $app['use_transaction']==TRUE){
            $app['use_transaction_count'] = $app['use_transaction_count'] + 1;
            return;
        }
        $app['use_transaction'] = TRUE;
        $app['db_transaction'] = NULL;
        $app['use_transaction_count'] = 1;
    }
    /**
     * commit the transaction to db
     * @param Application $app
     * return boolean
     */

    public static function commitTransaction(Container &$app){
        if(isset($app['use_transaction']) && $app['use_transaction']==TRUE){
            $app['use_transaction_count'] = $app['use_transaction_count'] - 1;
            if($app['db_transaction']!=NULL && $app['use_transaction_count']<=0){
                $ret = $app['db_transaction']->commit();
                $app['use_transaction'] = FALSE;
                $app['use_transaction_count'] = 0;
                return $ret;
            }

        }
        return FALSE;
    }
}