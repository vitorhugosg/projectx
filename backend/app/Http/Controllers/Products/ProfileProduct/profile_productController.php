<?php

namespace App\Http\Controllers\Products\ProfileProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile_Product;
use App\User;
use App\Models\Company;
use Auth;

class profile_productController extends Controller
{
    public function get(Request $request,$idCompany){
    	$user = $request->user();
    	if ($user->companyes()->find($idCompany)) {
    		return [
                'status'=> true,
                'profile_product' =>[
                    'active' => Profile_Product::where('company_id', $idCompany)->where('status', 1)->get(),
                    'desactive' => Profile_Product::where('company_id', $idCompany)->where('status', 0)->get()
                ],
            ];
    	}else{
    		return [
    			'status' => 'false',
    			'massage' => 'You are not part of this company'
    		];
    	}
    }

    public function add(Request $request){
    	$data = $request->all();
    	$user = $request->user();

        if(isset(Profile_Product::where('company_id',$data['idCompany'])->where('name', $data['name'])->get()[0])){
            return[
                'status' => false,
                'message' => 'An item with that name already exists.',
                'result' => Profile_Product::where('company_id',$data['idCompany'])->where('name', $data['name'])->get()
            ];
        }
    	if ($user->companyes()->find($data['idCompany'])) {
    		$insert = [
	    		'company_id' => $data['idCompany'],
	    		'name' => $data['name'],
	    		'status' => 1
	    	];
	    	if ($add = Profile_Product::create($insert)) {
	    		return [
	    			'status'=> true,
                    'profile_product' =>[
                        'active' => Profile_Product::where('company_id', $data['idCompany'])->where('status', 1)->get(),
                        'desactive' => Profile_Product::where('company_id', $data['idCompany'])->where('status', 0)->get()
                    ],
				];
	    	}else{
	    		return [
	    			'status' => false,
	    			'message' => 'Error inserting Material Type into system '
	    		];
	    	}
    	}else{
    		return [
    			'status' => false,
    			'massage' => 'You are not part of this company'
    		];
    	}
    }

    public function update(Request $request, $idCompany, $idMaterialType){
    	$data = $request->all();
    	$user = $request->user();
    	if ($user->companyes()->find($idCompany)) {
    		if ($updateResult = Profile_Product::find($idMaterialType)) {
                $updateResult->name = $data['name'];
                $updateResult->save();
    			return [
    				'status'=> true,
                    'profile_product' =>[
                        'active' => Profile_Product::where('company_id', $idCompany)->where('status', 1)->get(),
                        'desactive' => Profile_Product::where('company_id', $idCompany)->where('status', 0)->get()
                    ],
    			];
    		}else{
    			return [
    				'status' => false,
    				'message' => 'Error updating this item'
    			];
    		}
    	}else{
    		return [
    			'status' => 'false',
    			'massage' => 'You are not part of this company'
    		];
    	}
    }
    public function desactive(Request $request, $idCompany){
        $data = $request->all();
        $user = $request->user();
        if ($user->companyes()->find($idCompany)) {
            if ($updateResult = Profile_Product::find($data['idMaterialType'])) {
                $updateResult->status = 0;
                $updateResult->save();
                return [
                    'status'=> true,
                    'profile_product' =>[
                        'active' => Profile_Product::where('company_id', $idCompany)->where('status', 1)->get(),
                        'desactive' => Profile_Product::where('company_id', $idCompany)->where('status', 0)->get()
                    ],
                ];
            }else{
                return [
                    'status' => false,
                    'message' => 'Error updating this item'
                ];
            }
        }else{
            return [
                'status' => false,
                'massage' => 'You are not part of this company'
            ];
        }
    }
    public function activate(Request $request, $idCompany){
        $data = $request->all();
        $user = $request->user();
        if ($user->companyes()->find($idCompany)) {
            if ($updateResult = Profile_Product::find($data['idMaterialType'])) {
                $updateResult->status = 1;
                $updateResult->save();
                return [
                    'status'=> true,
                    'profile_product' =>[
                        'active' => Profile_Product::where('company_id', $idCompany)->where('status', 1)->get(),
                        'desactive' => Profile_Product::where('company_id', $idCompany)->where('status', 0)->get()
                    ],
                ];
            }else{
                return [
                    'status' => false,
                    'message' => 'Error updating this item'
                ];
            }
        }else{
            return [
                'status' => false,
                'massage' => 'You are not part of this company'
            ];
        }
    }
}
