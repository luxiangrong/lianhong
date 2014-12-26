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
        } else {
            $allProductTypes = $dictMod->where(array('pid'=>0, 'dictType'=>'product'))->select();
            $currentDict = $allProductTypes[0];
        }

        $children = $dictMod->array_multi_array($dictMod->children($currentDict['id']));
        $where['type'] = array('in', array_merge(array($currentDict['id']),array_keys($children)));

        if(count($children) == 0) {
            $childrenDicts = $dictMod->where(array('pid'=> $currentDict['pid']))->select();
        } else {
            $childrenDicts = $dictMod->where(array('pid'=> $currentDict['id']))->select();
        }

        $products = $productMod->where($where)->select();

        $dictChain = $this->getDictChain($currentDict['id']);

        $dictChainIds = array();
        foreach($dictChain as $dict) {
            $dictChainIds[] = $dict['id'];
        }

        $this->assign('dictChainIds', $dictChainIds);
        $this->assign('dictChain', $dictChain);
        $this->assign('dictChainCount', count($dictChain));
        $this->assign('leafDicts', $childrenDicts);
        $this->assign('products', $products);
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