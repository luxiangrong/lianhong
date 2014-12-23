<?php
/**
 * Created by PhpStorm.
 * User: LuXiangrong
 * Date: 2014/12/22
 * Time: 18:22
 */

class ProductAction extends CommonAction {

    public function index() {
        $dictMod = D('Dict');

        $dicts = $this->getDictsAsTree();
        $this->assign('dicts',$dicts);

        $productMod = D('Product');
        import('@.ORG.Util.Page');//引入分页类
        $count = $productMod->where()->count();//计算总记录数
        $Page = new Page($count,25); //实例化分页类，每页显示数
        $show = $Page->show();

        $where = array();
        if(isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
            $childrenDicts = $dictMod->array_multi_array($dictMod->children($type));
            $where['type'] = array('in', array_merge(array($type), array_keys($childrenDicts)));

            $this->assign('type',$type);
        }
        if(isset($_REQUEST['pname'])) {
            $where['name'] = array('like', '%'.$_REQUEST['pname'].'%');
        }

        $list = $productMod->join(' n left join __DICT__ d on d.id=n.type')->field('n.*,d.dictName as typeName')->where($where)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    public function edit() {
        $productMod = D('Product');
        $productAttributeMod = D('ProductAttribute');
        if($this->isPost()) {
            $data = $productMod->create();

            $delAttrIds = $_POST['delAttrs'];

            if(!empty($delAttrIds)) {
                $condition['id'] = array('in', $delAttrIds);
                $productAttributeMod->where($condition)->delete();
            }

            $productAttrs = array();
            $attrNames = $_POST['attrName'];
            $attrValues = $_POST['attrValue'];
            foreach($attrNames as $key => $attrName) {
                $productAttrs[$key] = array(
                    'updateTime' => time()
                );
                if(is_array($attrName)) {
                    $productAttrs[$key]['attrName'] = $attrName[0];
                    $productAttrs[$key]['id'] = $key;
                } else {
                    $productAttrs[$key]['attrName'] = $attrName;
                    $productAttrs[$key]['createTime'] = time();
                }
            }
            foreach($attrValues as $key => $attrValue) {
                if(is_array($attrValue)) {
                    $productAttrs[$key]['attrValue'] = $attrValue[0];
                } else {
                    $productAttrs[$key]['attrValue'] = $attrValue;
                }
            }



            $data['attributes'] = $productAttrs;

//            print '<pre>';
//            print_r($data);
//            print '<pre>';
//            die();

            if($data !== false){
                if($data['id']){
                    $data['updateTime'] = time();
                    $productMod->relation(true)->save($data);
                }else{
                    $data['createTime'] = time();
                    $data['updateTime'] = time();
                    $productMod->relation(true)->add($data);
                }
                $this->assign('jumpUrl',U('Product/index'));
                $this->success('保存成功');
            }else{
                $this->error($productMod->getError());
            }
        }

        $dicts = $this->getDictsAsTree();
        $this->assign('dicts',$dicts);

        $id = $_REQUEST['id'];//获取产品id
        if($id){
            $where['id'] = $id;
            $productInfo = $productMod->relation(true)->where($where)->find(); //通过id获取要修改的产品信息
        }
        $this->assign('productInfo', $productInfo);
        $this->display();
    }

    public function del() {
        $id = $_REQUEST['id'];
        $productMod = D('Product');
        $sWhere['id'] = $id;
        $productMod->relation(true)->delete($id); //删除指定id的记录
        $this->assign('jumpUrl',U('Product/index'));//跳转到列表页
        $this->success('删除成功');//提示信息
    }

    private function getDictsAsTree() {
        //获取类型
        $dictType = 'product';

        $dictMod = D('Dict');
        $where['dictType'] = array('in',$dictType);
        $dicts = $dictMod->where($where)->select();//查询$type的所有分类
        import('@.ORG.Util.Tree');//引入层级类
        $Tree = new Tree('请选择');//实例化层级类
        foreach($dicts as $k=>$v){
            $Tree->setNode($v['id'],$v['pid'],$v['dictName']);
        }
        $category = $Tree->getChilds(); //获取子类
        $dicts = array();
        foreach ($category as $key => $id) { //遍历输出$type类型的分类（以层级结构的形式）
            $val = array();
            $val['id'] = $id;
            $val['val'] = $Tree->getLayer($id, '-') . $Tree->getValue($id);
            $dicts[] = $val;
        }

        return $dicts;
    }

}