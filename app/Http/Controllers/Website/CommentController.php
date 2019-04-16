<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
	public function store(Request $request)
	{
		if (session()->has('check_comment_'.auth()->id())) {
			$timeCheck = session()->get('check_comment_'.auth()->id()); 
			// Nếu tgian chưa đủ 30 seconds
			if ($timeCheck > time()) {
				return ' - WAIT_MORE';
			} else {
				session()->forget('check_comment_'.auth()->id());
				return ' - FORGET';
			}
		} else {
			// nếu chưa có session
			// Tạo, Set giá trị cho session bằng time + 30 seconds
			session()->put('check_comment_'.auth()->id(), strtotime(now().' + 30 seconds')); 
			return ' - PUT';
		}

		return ' - OKE';

		$request->validate([
			'body'=>'required|min:30|max:250',
		]);

		$input = $request->all();
		$input['user_id'] = auth()->user()->id;

		$_this = Comment::create($input);
		$comment = Comment::with('user', 'product', 'replies')->find($_this->id);

		return view('website.product.comments', ['comment' => $comment, 'product_id' => $request->product_id, 'parent_id' => $request->parent_id]);
	}
}
