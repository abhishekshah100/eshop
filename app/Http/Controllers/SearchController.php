<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class SearchController extends Controller
{
     public function palindrome(){
     	$output='';
     	return view('admin.test', compact('output'));
     }

     public function postpalindrome(Request $request){
     	$value=$request->value;
     	$reverse=strrev($value);
     	if($value==$reverse)
     	{
     		$output= "The number $value is Palindrome";
     	}
     	else
     	{
     		$output= "The number $value is not Palindrome";
     	}
     	return view('admin.test', compact('output'));

     }
     public function fizzybuzz(){
     	$new_value=array();
     	for($i=1; $i<=20; $i++)
     	{
     		if($i%15==0)
     		{
     			array_push($new_value, "FizzyBuzz");
     		}
     		else
     			if($i%3==0)
     			{
     			array_push($new_value, "Fizzy");
     			}
     		else
     			if($i%5==0)
     			{
     			array_push($new_value, "Buzz");
     			}
     			else
     			{
     			array_push($new_value, $i);
     			}
     	}
     	return $new_value;
 	}
}
