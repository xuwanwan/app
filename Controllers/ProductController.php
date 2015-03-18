<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 下午4:43
 */

namespace Controllers;

use Product;
use ProductReviews;
use Weile\Repositories\ProductRepositoryInterface;

class ProductController extends BaseController {
    protected $products;

    public function __construct(ProductRepositoryInterface $products) {
        parent::__construct();
        $this->products = $products;
    }
    public function index() {
        $products = $this->products->findAllPaginated(3);
#        return $products;
        $this->view('products.index', compact('products'));
    }

    public function reviews($product_id){
        $reviews =Product::find($product_id)->reviews()->get()->toArray();
        $this->view('products.reviews', compact('reviews'));
        
    }

    public function postReviews($product_id)
    {
        /*
        $rules = [
            'rating' => 'required|digits:1',
            'title' => 'required|min:4',
            'author' => 'required|min:4',
            'content' => 'required|min:20'
        ];
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            $return['type'] = 0;
            $return['msg'] = $validator->messages();
            return $return;
        }
        */
        $member_id =\Auth::user()->id;
        //$member_id = 1;
        // 获取评论内容
        $rating = (int)\Input::get('rating');
        $title = trim(\Input::get('title'));
        $author = trim(\Input::get('author'));
        $content = e(\Input::get('content'));
        // 字数检查
        if(!$rating){
            return \Redirect::back()->withInput()->withErrors($this->messages->add('rating', '请给出您的评分。'));
        }
        if (mb_strlen($title) < 4) {
            return \Redirect::back()->withInput()->withErrors($this->messages->add('title', '标题不得少于4个字符。'));
        }
        if (mb_strlen($author) < 4) {
            return \Redirect::back()->withInput()->withErrors($this->messages->add('author', '昵称不得少于4个字符。'));
        }
        if (mb_strlen($content) < 3) {
            return \Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        }

        // 创建文章评论
        $comment = new ProductReviews;
        $comment->product_id    = $product_id;
        $comment->member_id    = $member_id;
        $comment->rating    = $rating;
        $comment->rating    = $rating;
        $comment->title =  $title;
        $comment->author    = $author;
        $comment->text    = $content;
        if ($comment->save()) {

            // 返回成功信息
            return \Redirect::back()->with('success', '评论成功。');
        } else {
            // 创建失败
            return \Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }
}