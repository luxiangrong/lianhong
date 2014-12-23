<?php
/**
 * Created by PhpStorm.
 * User: LuXiangrong
 * Date: 2014/12/23
 * Time: 18:27
 */

class ProductAction extends BaseAction{

    public function _initialize() {
        parent:: _initialize();

        $dictMod = D('Dict');
        $where['pid'] = 0;
        $where['dictType'] = 'product';
        $dictL1 = $dictMod->where($where)->select();
        foreach($dictL1 as &$dict) {
            $where['pid'] = $dict['id'];
            $dict['children'] = $dictMod->where($where)->select();
        }
        $this->assign('navDict', $dictL1);
    }

    public function lists() {
        $dictMod = D('Dict');
        $productMod = D('Product');



        if(isset($_REQUEST['cid'])) {
            $currentDict = $dictMod->find($_REQUEST['cid']);

            $currentDict['parent'] = $dictMod->find($currentDict['pid']);
            $currentDict['children'] = $dictMod->where(array('pid'=>$currentDict['id']))->select();

        } else {
            $currentDict = array(
                'parent' => null,
                'children' => $dictMod->where(array('pid'=>0, 'dictType'=>'product'))->select()
            );
        }



        foreach($currentDict['children'] as &$childDict) {
            $children = $dictMod->array_multi_array($dictMod->children($childDict['id']));




            $where['type'] = array('in', array_merge(array($childDict['id']),array_keys($children)));
            $childDict['products'] = $productMod->where($where)->select();
        }
        $this->assign('currentDict', $currentDict);
        $this->display();
    }

    public function view() {
        $pid = $_REQUEST['pid'];
        $productMod = D('Product');

        $product = $productMod->relation(true)->find($pid);
        $dictChain = $this->getDictChain($product['type']);
        $this->assign('product', $product);
        $this->assign('dictChain', $dictChain);
        $this->assign('dictChainCount', count($dictChain));


        $this->display();
    }

    private function getDictChain($typeId, &$chain=array(), $reverse=true) {
        $dictMod = D('Dict');
        $dict = $dictMod->find($typeId);
        array_push($chain, $dict);
        if($dict['pid'] == 0) {
            if($reverse) {
                return array_reverse($chain);
            } else {
                return $chain;
            }
        } else {
            return $this->getDictChain($dict['pid'], $chain);
        }
    }


}