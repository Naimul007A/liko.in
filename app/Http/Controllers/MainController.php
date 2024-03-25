<?php

namespace App\Http\Controllers;

use App\City;
use App\Post;
use App\Block;
use App\State;
use App\School;
use Validator; 
use App\Pincode;
use App\District;
use App\Ukcounty;
use App\Ukschool;
use App\Usastate;
use App\Usacounty;

use App\Usaschool;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function autocomplete(Request $request)
	{
		$term = $request->term;
		$posts = Post::where('name','like',''.$term.'%')->limit(20)->get();
			if(!$posts->isEmpty())
			{
			foreach ($posts as $post)
				{
				$new_row['title']= $post->name;
				$new_row['url']= url('/'.$post->url.$post->slug);
				$row_set[] = $new_row; //build an array
				}
			}
		else
			{
				$new_row['title']= 'Nothing Found';
				$new_row['url']= url('/');
				$row_set[] = $new_row; //build an array
			}		
		echo json_encode($row_set); 
	}
	
	
	public function search(Request $request)
    {
			$q = Input::get('s');
            $posts = Post::where('name','like',''.$q.'%')->limit(50)->get();
            return view('search',compact('posts','q'));
    }	
	
	public function home()    {
        
		return view('welcome');
    }
    public function states()    	
    {
       	$items = State::get();
       	return view('states',compact('items'));
    }
	public function schools()    	
    {
       	$items = State::get();
       	return view('schools',compact('items'));
    }
	public function districts()    	
    {
       	$items = District::simplepaginate(200);
       	return view('districts',compact('items'));
    }
	public function blocks()    	
    {
       	$items = Block::simplepaginate(200);
       	return view('blocks',compact('items'));
    }
	
	public function states1($slug)    	
    {
       	$page = State::where('slug','=',$slug)->first();
       	if(empty($page)){
		App::abort(404); }
		$a1 = $page->id;					
       	$items = District::where('state_id','=',$a1)->get();
		$item1s = District::where('state_id','=',$a1)->get();
       	return view('states1',compact('page','items','item1s'));
	}
	public function districts1($slug)    	
    {
       	$page = District::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);         }
       	$items = Block::where('district_id','=',$page->id)->get();
       	return view('districts1',compact('page','items'));
	}
	public function cities1($slug)    	
    {
       	$page = City::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);         }
       	$items = Pincode::where('city_id','=',$page->id)->get();
       	return view('cities1',compact('page','items'));
	}
	public function pincodes1($slug)    	
    {
       	$page = Pincode::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);         }
		$a1 = $page->pin_code;	
       	$items = School::where('pincode','=',$a1)->orderBy('pincode','asc')->simplepaginate(50);
       	return view('pincodes1',compact('page','items'));
	}
	public function blocks1($slug)    	
    {
       	$page = Block::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);         }
		$a1 = $page->id;	
       	$items = School::where('block_id','=',$a1)->orderBy('pincode','asc')->simplepaginate(50);
       	return view('blocks1',compact('page','items'));
	}
		
	public function schools1($slug)    	
    {
       	$page = School::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);           }		
			$a = $page->id+1;
			$b = $page->id+3;
			$c = $page->id+6;
			$d = $page->id+9;
			$e = $page->id+12;
			$f = $page->id+15;
			$g = $page->id+18;
			$h = $page->id+21;
			$i = $page->id+24;
			$j = $page->id+27;
			$k = $page->id-1;
			$l = $page->id-3;
			$m = $page->id-6;
			$n = $page->id-9;
			$o = $page->id-12;
			$p = $page->id-15;			
		$relateds = School::whereIn('id', [$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p])->get();
		$blockid = Block::where('id','=',$page->block_id)->first();
		$items = Block::where('district_id','=',$blockid->district_id)->get();
       	return view('schools1',compact('page','relateds','items','blockid')); 
	}
	public function ukcounties()    	
    {
       	$items = Ukcounty::get();
       	return view('ukcounties',compact('items'));
    }
	public function ukcounties1($slug)    	
    {
       	$page = Ukcounty::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);         }			
       	$items = Ukschool::where('county_url','=',$slug)->simplepaginate(30);
       	return view('ukcounties1',compact('page','items'));
	}
    public function ukschools()    	
    {
       	$items = Ukcounty::get();
       	return view('ukschools',compact('items'));
    }
	public function ukschools1($slug)    	
    {
       	$page = Ukschool::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);           }		
			$a = $page->id+1;
			$b = $page->id+3;
			$c = $page->id+6;
			$d = $page->id+9;
			$e = $page->id+12;
			$f = $page->id+15;
			$g = $page->id+18;
			$h = $page->id+21;
			$i = $page->id+24;
			$j = $page->id+27;
			$k = $page->id-1;
			$l = $page->id-3;
			$m = $page->id-6;
			$n = $page->id-9;
			$o = $page->id-12;
			$p = $page->id-15;			
		$relateds = Ukschool::whereIn('id', [$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p])->get();
		
		$b2 = Ukcounty::where('slug','=',$page->county_url)->first();
		$a1 = $b2->id+1;
		$b1 = $b2->id+2;
		$c1 = $b2->id+3;
		$d1 = $b2->id+4;
		$e1 = $b2->id+5;
		$f1 = $b2->id+6;
		$g1 = $b2->id+7;
		$h1 = $b2->id+8;
		$i1 = $b2->id+9;
		$j1 = $b2->id+10;
		$k1= $b2->id-1;
		$l1= $b2->id-2;
		$m1= $b2->id-3;
		$n1= $b2->id-4;
		$o1= $b2->id-5;
		$p1= $b2->id-6;
		$q1= $b2->id-6;
		$r1= $b2->id-6;
		$s1= $b2->id-9;
		$t1= $b2->id-10;
		$items = Ukcounty::whereIn('id', [$a1,$b1,$c1,$d1,$e1,$f1,$g1,$h1,$i1,$j1,$k1,$l1,$m1,$n1,$o1,$p1,$q1,$r1,$s1,$t1])->get();		
       	return view('ukschools1',compact('page','relateds','items')); 
	}
	public function usastates()   	
    {
       	$items = Usastate::orderBy('id','ASC')->get();
       	return view('usastates',compact('items'));
    }
	public function usacounties()   	
    {
       	$item1s = Usastate::orderBy('id','ASC')->get();
		$items = Usacounty::orderBy('id','ASC')->simplepaginate(200);
       	return view('usacounties',compact('items','item1s'));
    }
	public function usaschools()   	
    {
       	$items = Usastate::orderBy('id','ASC')->get();
       	return view('usaschools',compact('items'));
    }
	public function usastates1($slug)    	
    {
       	$page = Usastate::where('slug','=',$slug)->first();
       	if(empty($page)){
		App::abort(404); }							
       	$items = Usacounty::where('state_url','=',$slug)->simplepaginate(200);
       	return view('usastates1',compact('page','items'));
	}
	public function usacounties1($slug)    	
    {
       	$page = Usacounty::where('slug','=',$slug)->first();
       	if(empty($page)){
		App::abort(404); }							
       	$items = Usaschool::where('county_id','=',$page->id)->simplepaginate(50);
       	return view('usacounties1',compact('page','items'));
	}
	public function usaschools1($slug)    	
    {
       	$page = Usaschool::where('slug','=',$slug)->first();
       	if(empty($page)){
            App::abort(404);           }		
			$a = $page->id+1;
			$b = $page->id+3;
			$c = $page->id+6;
			$d = $page->id+9;
			$e = $page->id+12;
			$f = $page->id+15;
			$g = $page->id+18;
			$h = $page->id+21;
			$i = $page->id+24;
			$j = $page->id+27;
			$k = $page->id-1;
			$l = $page->id-3;
			$m = $page->id-6;
			$n = $page->id-9;
			$o = $page->id-12;
			$p = $page->id-15;			
		$relateds = Usaschool::whereIn('id', [$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p])->get();
		$b2 = Usacounty::where('id','=',$page->county_id)->first();
		$a1 = $b2->id+1;
		$b1 = $b2->id+2;
		$c1 = $b2->id+3;
		$d1 = $b2->id+4;
		$e1 = $b2->id+5;
		$f1 = $b2->id+6;
		$g1 = $b2->id+7;
		$h1 = $b2->id+8;
		$i1 = $b2->id+9;
		$j1 = $b2->id+10;
		$k1= $b2->id-1;
		$l1= $b2->id-2;
		$m1= $b2->id-3;
		$n1= $b2->id-4;
		$o1= $b2->id-5;
		$p1= $b2->id-6;
		$q1= $b2->id-6;
		$r1= $b2->id-6;
		$s1= $b2->id-9;
		$t1= $b2->id-10;
		$items = Usacounty::whereIn('id', [$a1,$b1,$c1,$d1,$e1,$f1,$g1,$h1,$i1,$j1,$k1,$l1,$m1,$n1,$o1,$p1,$q1,$r1,$s1,$t1])->get();		
       	return view('usaschools1',compact('page','relateds','items','b2')); 
	}
}